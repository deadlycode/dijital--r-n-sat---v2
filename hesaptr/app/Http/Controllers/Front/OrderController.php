<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\PaytrController;
use App\Http\Controllers\Front\ShopierController;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\User;
use Auth;
use Cache;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\BankNotify;
class OrderController extends Controller
{

    public function coupon_check(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if ($coupon) {
            if ($coupon->used <= $coupon->max_used) {
                if ($coupon->min_price_limit <= $request->amount_paid) {
                    $coupon_code = $coupon->code;
                    $coupon_discount = '-' . config('app.currency_symbol') . $coupon->discount;
                    $amount_paid = config('app.currency_symbol') . money($request->amount_paid - $coupon->discount);
                    return response()->json(['status' => 'success', 'message' => __('Coupon applied successfully'), 'coupon_code' => $coupon_code, 'coupon_discount' => $coupon_discount, 'amount_paid' => $amount_paid]);
                } else {
                    return response()->json(['status' => 'error', 'message' => __('Minimum usage limit of coupon is :currency_symbol :min_price_limit', ['currency_symbol' => config('app.currency_symbol'), 'min_price_limit' => money($coupon->min_price_limit)])]);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => __('Coupon has been used maximum times')]);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => __('Coupon code does not exist.')]);
        }
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'qty' => 'required|integer',
        ]);
        $product = Product::where('id', $request->product_id)->firstOrFail();
        $qty = (int) $request->qty;

        if ($product->even_if_out_of_stock == null) {
            if ($qty > $product->stocks->count()) {
                return redirect()->back()->with('error', __('Out of stock'));
            }
        }
        $total = $qty * $product->price;
        if ($product->discount_more) {
            $discount_qty = explode(':', $product->discount_more)[0];
            $discount_rate = explode(':', $product->discount_more)[1];
            if ($qty > $discount_qty) {
                $total = $total - ($total * $discount_rate / 100);
            }
        } else {
            $total = $qty * $product->price;
        }

        return view('front.checkout', compact('product', 'qty', 'total'));

    }

    public function complete(Request $request)
    {
        recaptchaCheck($request);
        $request->validate([
            'product_id' => 'required|integer',
            'qty' => 'required|integer',
        ]);
        $product = Product::where('id', $request->product_id)->firstOrFail();
        $qty = (int) $request->qty;
        if ($qty < 1) {
            return redirect()->back()->with('error', __('Quantity must be greater than 0'));
        }

        if ($product->even_if_out_of_stock == null) {
            if ($qty > $product->stocks->count()) {
                return redirect()->back()->with('error', __('Out of stock'));
            }
        }
        $total = $qty * $product->price;
        if ($product->discount_more) {
            $discount_qty = explode(':', $product->discount_more)[0];
            $discount_rate = explode(':', $product->discount_more)[1];
            if ($qty > $discount_qty) {
                $total = $total - ($total * $discount_rate / 100);
            }
        }

        if (Auth::check()) {
            if (Auth::user()->phone == null) {
                Auth::user()->phone = $request->phone;
            }
            if (Auth::user()->surname == null) {
                Auth::user()->surname = $request->surname;
            }
            Auth::user()->save();
            $user_id = Auth::user()->id;
        } else {
            $user_id = null;
        }

        $order = new Order();
        $order->user_id = $user_id;
        $order->order_id = uniqid();

        $data_user['name'] = $request->name;
        $data_user['surname'] = $request->surname;
        $data_user['email'] = $request->email;
        $data_user['phone'] = $request->phone;
        $data_user['ip'] = $request->ip();

        $order->billing_details = json_encode($data_user, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);

        if ($request->customer_answers) {
            $customer_answers = $request->customer_answers;
            $customer_inputs = explode('::', $product->customer_inputs);
            $answers = array_zip_combine(['question', 'answer'], $customer_inputs, $customer_answers);
            $order->customer_answers = json_encode($answers, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
        }

        $data_product['product_id'] = $product->id;
        $data_product['name'] = $product->name;
        $data_product['price'] = $product->price;
        $data_product['qty'] = $qty;
        $data_product['total'] = $total;

        $order->product = json_encode($data_product, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);

        $order->file = $product->file;
        $order->file_url = $product->file_url;

        $order->note = $request->note;
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if ($coupon) {
            $order->coupon_code = $coupon->code;
            $total = $total - $coupon->discount;
        }
        $order->total = $total;

        $order->order_status = $product->order_status;

        $order->save();
        if ($request->payment_method == 'wallet') {
            if($total > Auth::user()->wallet || Auth::user()->wallet == 0 || Auth::user()->wallet < 0){
                return redirect()->back()->with('error', __('Insufficient wallet balance'));
            }
            $order->payment_method = 'Wallet';
            $order->payment_status = 1;
            $get_stocks = $product->stocks->take($qty);
            if ($get_stocks->count() > 0) {
                $order->stocks = $get_stocks->pluck('content')->toJson();
                ProductStock::whereIn('id', $product->stocks->take($qty)->pluck('id'))->delete();
            }
            $order->save();
            Auth::user()->wallet = Auth::user()->wallet - $total;
            Auth::user()->save();
            Product::where('id', $product->id)->increment('sales_count', $qty);
            if (Cache::get('telegram_bot_active') == 1) {
                $message = __('New order has been placed by ') . Auth::user()->name . ' ' . Auth::user()->surname . ' ' . __('with order id ') . $order->order_id . ' ' . __('and total amount ') . config('app.currency_symbol') . $order->total . ' ' . __('via wallet');
                telegram_bot_send_message($message);
            }
            return redirect()->route('profile.orders')->with('success', __('Order has been placed successfully'));
        }
        if ($request->payment_method == 'paytr') {
            $order->payment_method = Cache::get('paytr_name');
            $order->save();
            $order_id = $order->order_id;
            $paytrController = new PaytrController();
            $token = $paytrController->getToken($order_id);
            return view('front.payment.paytr', compact('token', 'order_id'));
        }
        if ($request->payment_method == 'stripe') {
            $order->payment_method = Cache::get('stripe_name');
            $order->save();
            $order_id = $order->order_id;
            $total = $order->total;
            return view('front.payment.stripe', compact('order_id', 'total'));
        }
        if ($request->payment_method == 'shopier') {
            $order->payment_method = Cache::get('shopier_name');
            $order->save();
            $order_id = $order->order_id;
            $shopierController = new ShopierController();
            $token = $shopierController->getShopier($order_id);
        }
        if ($request->payment_method == 'iban') {
            $order->payment_method = Cache::get('iban_name');
            $order->save();
            $order_id = $order->order_id;
            return redirect()->route('ibans', compact('order_id'));
        }
    }
    public function generateQRCode($text, $size = 100)
    {
        return QrCode::size($size)->generate($text);
    }
    public function wallet_store(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->order_id = uniqid();
        $order->total = $request->amount;
        $data_user['name'] = Auth::user()->name;
        $data_user['surname'] = Auth::user()->surname;
        $data_user['email'] = Auth::user()->email;
        $data_user['phone'] = Auth::user()->phone;
        $data_user['ip'] = $request->ip();

        $order->billing_details = json_encode($data_user, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);

        $data_product['product_id'] = 0;
        $data_product['name'] = 'Wallet';
        $data_product['price'] = $request->amount;
        $data_product['qty'] = 1;
        $data_product['total'] = $request->amount;

        $order->product = json_encode($data_product, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);

        $order->wallet = 1;
        $order->save();

        if ($request->payment_method == 'paytr') {
            $order->payment_method = Cache::get('paytr_name');
            $order->save();
            $order_id = $order->order_id;
            $paytrController = new PaytrController();
            $token = $paytrController->getToken($order_id);
            return view('front.payment.paytr', compact('token', 'order_id'));
        }
        if ($request->payment_method == 'stripe') {
            $order->payment_method = Cache::get('stripe_name');
            $order->save();
            $order_id = $order->order_id;
            $total = $order->total;
            return view('front.payment.stripe', compact('order_id', 'total'));
        }
        if ($request->payment_method == 'shopier') {
            $order->payment_method = Cache::get('shopier_name');
            $order->save();
            $order_id = $order->order_id;
            $shopierController = new ShopierController();
            $token = $shopierController->getShopier($order_id);
        }
        if ($request->payment_method == 'iban') {
            $order->payment_method = Cache::get('iban_name');
            $order->wallet = 1;
            $order->save();
            $order_id = $order->order_id;
            return redirect()->route('ibans', compact('order_id'));
        }
    }

    public function download(Request $request)
    {
        $order = Order::where('id', $request->order_id)->where('payment_status', 1)->first();
        if ($order) {
            if ($request->type == 'txt') {
                header("Content-type: text/plain");
                header("Content-Disposition: attachment; filename=" . $order->order_id . ".txt");
                header("Pragma: no-cache");
                header("Expires: 0");
                foreach (json_decode($order->stocks, true) as $stock) {
                    echo $stock . PHP_EOL;
                }
            } else {
                if ($order->file) {
                    if (!file_exists($order->file)) {
                        return redirect()->route('index')->with('error', __('File not found'));
                    }
                    return response()->download($order->file);
                } else if ($order->file_url) {
                    return redirect($order->file_url);
                }
            }
        }
    }

    public function order_details(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'email' => 'required|email',
        ]);

        $order_id = $request->order_id;
        $email = $request->email;
        $order = Order::where('order_id', $order_id)->where('billing_details->email', $email)->first();
        if ($order) {
            if ($order->payment_status == 1) {
                return view('front.order_details', compact('order'));
            } else {
                return redirect()->route('index')->with('error', __('Payment failed order canceled'));
            }
        } else {
            return redirect()->route('index')->with('error', __('Order not found'));
        }
    }

    public function ibans(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();
        if ($order) {
            $order_id = $order->order_id;
            if ($order->wallet == 1) {
                $isWallet = 1;
            } else {
                $isWallet = 0;
            }
            $amount = $order->total;
            $ibans = [];
            foreach (Cache::get('ibans') as $item) {
                $iban = [
                    'iban' => $item['iban'],
                    'bank' => $item['iban_bank'],
                    'name' => $item['iban_name'],
                    'qrcode' => $this->generateQRCode($item['iban']),
                ];
                array_push($ibans, $iban);
            }
            return view('front.payment.ibans', compact('ibans', 'order_id', 'isWallet','amount'));
        }else{
            return redirect()->route('index')->with('error', __('Silinmiş veya bulunamayan bir sipariş numarası girdiniz.'));
        }

    }

    public function bank_notify(Request $request)
    {
        $request->validate([
            'datetime' => 'required',
            'bank_name' => 'required',
            'order_id' => 'required',
        ]);
        $order = Order::where('order_id', $request->order_id)->first();
        if (!$order) {
            return redirect()->route('index')->with('error', __('Silinmiş veya bulunamayan bir sipariş numarası girdiniz.'));
        }
        $bank_notifys = new BankNotify;
        $bank_notifys->amount = $order->total;
        $bank_notifys->datetime = $request->datetime;
        $bank_notifys->bank_name = $request->bank_name;
        if ($order->wallet == 1) {
            $bank_notifys->description = __('Bakiye Yükleme');
        } else {
            $bank_notifys->description = __('Sipariş Ödemesi');
        }
        $bank_notifys->user_id = $order->user_id;
        $bank_notifys->order_id = $order->order_id;
        $bank_notifys->billing_details = $order->billing_details;
        $bank_notifys->save();
        if (Cache::get('telegram_bot_active') == 1) {
            $message = __('Banka bildirimi alındı. ') . $order->order_id . ' ' . __('sipariş numaralı ödeme için banka bildirimi alındı. Kontrol ediniz.' . PHP_EOL . 'Tutar: ') . config('app.currency_symbol') . $bank_notifys->amount . PHP_EOL . __('Banka: ') . $bank_notifys->bank_name . PHP_EOL . __('Tarih: ') . $bank_notifys->datetime;
            telegram_bot_send_message($message);
        }
        return redirect()->route('index')->with('success', __('Bildiriminiz alınmıştır. En kısa sürede incelenecektir.'));
    }


}
