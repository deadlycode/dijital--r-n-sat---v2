<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Cache;
use Illuminate\Http\Request;
use App\Models\ProductStock;
use App\Models\Product;
class StripeController extends Controller
{
    public function callback()
    {
        // This is your test secret API key.
        \Stripe\Stripe::setApiKey(Cache::get('stripe_api_secret'));
        function calculateOrderAmount(array $items): int
        {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // people from directly manipulating the amount on the client
        }

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            $order = Order::where('order_id', $jsonObj->items[0]->id)->first();
            // Create a PaymentIntent with amount and currency
            $user = collect(json_decode($order->billing_details));
            $product = collect(json_decode($order->product));
            $total = $order->total;
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $total * 100,
                'currency' => config('app.currency'),
                'payment_method_types' => ['card'],
                'automatic_payment_methods' => [
                    'enabled' => false,
                ],
                'metadata' => [
                    'order_id' => $order->order_id,
                    'user_id' => $order->user_id,
                    'user_name' => $user['name'],
                    'user_email' => $user['email'],
                    'user_phone' => $user['phone'],
                    'product_id' => $product['product_id'],
                    'product_name' => $product['name'],
                    'product_qty' => $product['qty'],
                    'product_price' => $product['price'],
                ],
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public function callbackOk(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            Cache::get('stripe_api_secret')
        );
        $payment_intent = $request->payment_intent;
        $result = $stripe->paymentIntents->retrieve(
            $payment_intent,
            []
        );
        
        if ($result['status'] == "succeeded") {
            $order_id = $result['metadata']['order_id'];
            $order = Order::where('order_id', $order_id)->first();
            if ($order) {
                if ($order->payment_status == 0) {
                    if ($order->wallet == 1) {
                        $user = User::where('id', $order->user_id)->first();
                        $user->wallet = $user->wallet + $order->total;
                        $user->save();

                        $order->payment_status = 1;
                        $order->save();

                        if (Cache::get('telegram_bot_active') == 1) {
                            $message = __('Balance has been added to wallet with Stripe.') . ' UserID : ' . $user->id . ' : ' . __('for ') . config('app.currency_symbol') . $order->total . ' Wallet Balance : ' . config('app.currency_symbol') . $user->wallet;
                            telegram_bot_send_message($message);
                        }
                    } else {
                        $product_id = json_decode($order->product)->product_id;
                        $qty = json_decode($order->product)->qty;
                        $get_stocks = ProductStock::where('product_id', $product_id)->take($qty)->get();

                        if ($get_stocks->count() > 0) {
                            $order->stocks = $get_stocks->pluck('content')->toJson();
                            ProductStock::whereIn('id', $get_stocks->pluck('id'))->delete();
                        }

                        $order->payment_method = Cache::get('stripe_name');
                        $order->payment_status = 1;
                        $order->save();

                        Product::where('id', $product_id)->increment('sales_count', $qty);
                        if($order->coupon_code){
                            $coupon = Coupon::where('code', $order->coupon_code)->increment('used', 1);
                        }
                        if (Cache::get('telegram_bot_active') == 1) {
                            $message = __('New order has been placed with Stripe.') . ' OrderID : ' . $order->order_id . ' : ' . __('for ') . config('app.currency_symbol') . $order->total;
                            telegram_bot_send_message($message);
                        }

                    }
                    if ($order->wallet == 1) {
                        return redirect()->route('profile.wallets')->with('success', __('Your payment has been completed successfully.'));
                    } else {
                        return redirect('/order-details?order_id=' . $order->order_id.'&email='.json_decode($order->billing_details)->email)->with('success', __('Your payment has been completed successfully.'));
                    }
                } else {
                    return redirect()->route('index')->with('error', __('Already paid'));
                }

            } else {
                dd('Order not found');
            }
        } else {
            dd(__('Payment failed'));
        }
    }
}
