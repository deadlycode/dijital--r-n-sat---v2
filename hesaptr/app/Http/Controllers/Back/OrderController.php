<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\BankNotify;
use App\Models\Order;
use App\Models\ProductStock;
use Auth;
use File;
use Illuminate\Http\Request;
use App\Models\User;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wallet == 1) {
            $orders = Order::where('payment_status', 1)->where('wallet', 1)->orderByDesc('id')->paginate(100);
        } else {
            $orders = Order::where('payment_status', 1)->where('wallet', null)->orderByDesc('id')->paginate(100);
        }

        return view('back.order.index', compact('orders'));
    }
    public function ok(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        if ($order) {
            $order->payment_status = 1;
            $order->save();
            return redirect()->back()->with('success', __('Updated'));
        }
    }
    public function change_payment(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        if ($order) {
            if ($request->checked == true) {
                $order->payment_status = 1;
                $order->save();
                return response()->json(['status' => 'success', 'payment' => 1, 'message' => __('Payment status changed to Completed')]);
            } else {
                $order->payment_status = 0;
                $order->save();
                return response()->json(['status' => 'success', 'payment' => 0, 'message' => __('Payment status changed to Pending')]);
            }
        }
    }
    public function cancel(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        if ($order) {
            $order->payment_status = 2;
            $order->save();
            return response()->json(['status' => 'success', 'message' => __('Order status changed to Canceled')]);
        }
    }
    public function delete(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        if ($order) {
            if ($order->stocks) {
                $data = [];
                foreach (json_decode($order->stocks, true) as $stock) {
                    $item = [
                        'product_id' => json_decode($order->product)->product_id,
                        'content' => $stock,
                        'user_id' => Auth::user()->id,
                    ];
                    array_push($data, $item);
                }
                ProductStock::insert($data);
                $order->delete();
                return redirect()->back()->with('success', __('Deleted'));
            } else {
                $order->delete();
                return redirect()->back()->with('success', __('Deleted'));
            }
        } else {
            return redirect()->back()->with('error', __('Order not found'));
        }
    }

    public function unpaid_destroy()
    {
        $orders = Order::where('payment_status', 0)->delete();
        return redirect()->back()->with('success', __('Unpaid orders deleted'));
    }

    public function create()
    {
        return view('back.order.create');
    }

    public function store(Request $request)
    {
        $order = new Order;
        $order->order_id = uniqid();
        $order->user_id = null;
        $order->billing_details = json_encode([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'ip' => null,
        ]);
        $order->product = json_encode([
            'product_id' => null,
            'name' => $request->product_name,
            'price' => $request->product_price,
            'qty' => $request->product_qty,
            'total' => $request->total_price,
        ]);
        $order->payment_method = $request->payment_method;
        $order->order_status = $request->order_status;
        $order->payment_status = 1;
        $order->total = $request->total_price;
        $order->note = $request->note;
        if ($request->file) {
            $path = 'uploads/files/product_#' . time() . '.' . $request->file->getClientOriginalExtension();
            move_uploaded_file($request->file, $path);
            $product->file = $path;
        }
        if ($request->stocks) {
            $data = [];
            foreach (preg_split('/\r\n|[\r\n]/', $request->stocks) as $stock) {
                if ($stock != '') {
                    array_push($data, $stock);
                }
            }
            $order->stocks = json_encode($data, JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        }
        $order->save();
        return redirect()->route('admin.orders')->with('success', __('Added'));
    }

    public function edit($id)
    {
        $order = Order::where('id', $id)->first();
        return view('back.order.edit', compact('order'));
    }

    public function update(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $order->billing_details = json_encode([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'ip' => $order->ip,
        ]);
        $order->product = json_encode([
            'product_id' => $request->product_id,
            'name' => $request->product_name,
            'price' => $request->product_price,
            'qty' => $request->product_qty,
            'total' => $request->total_price,
        ]);
        $order->payment_method = $request->payment_method;
        $order->order_status = $request->order_status;
        $order->payment_status = 1;
        $order->total = $request->total_price;
        $order->note = $request->note;
        if ($request->file) {
            File::delete($order->file);
            $path = 'uploads/files/product_#' . time() . '.' . $request->file->getClientOriginalExtension();
            move_uploaded_file($request->file, $path);
            $order->file = $path;
        } else {
            $order->file = $request->file_url;
        }
        if ($request->delete_file == 1) {
            $order->file = null;
        }
        if ($request->stocks) {
            $data = [];
            foreach (preg_split('/\r\n|[\r\n]/', $request->stocks) as $stock) {
                if ($stock != '') {
                    array_push($data, $stock);
                }
            }
            $order->stocks = json_encode($data, JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        }
        $order->updated_at = now();
        $order->save();

        return redirect()->route('admin.orders')->with('success', __('Updated'));
    }

    public function payment_notifications()
    {
        $payment_notifications = BankNotify::orderBy('id', 'desc')->paginate(20);
        return view('back.payment_notifications', compact('payment_notifications'));
    }
    public function payment_notifications_delete(Request $request)
    {
        $notify = BankNotify::where('id', $request->id)->first();
        $notify->delete();
        return redirect()->back()->with('success', __('Bildirim silindi'));
    }
    public function payment_notifications_deleteAll(Request $request)
    {

        BankNotify::truncate();
        return redirect()->back()->with('success', __('Tüm bildirimler silindi'));
    }
    public function payment_notifications_confirm(Request $request)
    {
        $notify = BankNotify::where('id', $request->id)->first();
        if ($notify) {
            $order = Order::where('order_id', $notify->order_id)->first();
            if ($order->wallet == 1) {
                $user = User::findOrfail($notify->user_id);
                $user->wallet = $user->wallet + $notify->amount;
                $user->save();
                $order->payment_status = 1;
                $order->save();
            }else{
                $product_id = json_decode($order->product)->product_id;
                $qty = json_decode($order->product)->qty;
                $get_stocks = ProductStock::where('product_id', $product_id)->take($qty)->get();

                if ($get_stocks->count() > 0) {
                    $order->stocks = $get_stocks->pluck('content')->toJson();
                    ProductStock::whereIn('id', $get_stocks->pluck('id'))->delete();
                }
                $order->payment_status = 1;
                $order->save();
            }
            $notify->delete();
            return redirect()->back()->with('success', __('Bildirim onaylandı'));
        }
    }
}
