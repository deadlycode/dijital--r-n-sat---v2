<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Cache;
use Illuminate\Http\Request;
use Shopier\Enums\ProductType;
use Shopier\Enums\WebsiteIndex;
use Shopier\Exceptions\NotRendererClassException;
use Shopier\Exceptions\RendererClassNotFoundException;
use Shopier\Exceptions\RequiredParameterException;
use Shopier\Models\Address;
use Shopier\Models\Buyer;
use Shopier\Renderers\AutoSubmitFormRenderer;
use Shopier\Shopier;
use App\Models\ProductStock;
use App\Models\Product;
use Shopier\Models\ShopierResponse;
use App\Models\User;
class ShopierController extends Controller
{
    public function getShopier($order_id)
    {
        $shopier = new Shopier(Cache::get('shopier_api_username'), Cache::get('shopier_api_secret'));
        $order = Order::where('order_id', $order_id)->first();
        $user = collect(json_decode($order->billing_details, true));

        // Satın alan kişi bilgileri
        $buyer = new Buyer([
            'id' => $order->user_id,
            'name' => $user['name'],
            'surname' => $user['surname'],
            'email' => $user['email'],
            'phone' => $user['phone'],
        ]);

        // Fatura ve kargo adresi birlikte tanımlama
        // Ayrı ayrı da tanımlanabilir
        $address = new Address([
            'address' => 'Bilinmiyor',
            'city' => 'Bilinmiyor',
            'country' => 'Bilinmiyor',
            'postcode' => '00000',
        ]);

        // shopier parametrelerini al
        $params = $shopier->getParams();
        $total = $order->total;
        if (Cache::get('convert_to_exchange_rate_shopier') == 1) {
            $total = TCMB_Converter(config('app.currency'), Cache::get('to_exchange_shopier'), $total);
            $currency = Cache::get('to_exchange_shopier');
        } else {
            $currency = config('app.currency');
        }
        switch ($currency) {
            case 'TRY':
                $currency = 0;
                break;
            case 'USD':
                $currency = 1;
                break;
            case 'EUR':
                $currency = 2;
                break;
            default:
                $currency = 0;
                break;
        }
        $params->setCurrency($currency); // 0=TL, 1=USD, 2=EUR

        switch (config('app.locale')) {
            case 'tr':
                $lang = 0;
                break;
            case 'en':
                $lang = 1;
                break;
            default:
                $lang = 0;
                break;
        }
        $params->setCurrentLanguage($lang); // 0=TR, 1=EN

        // Geri dönüş sitesini ayarla
        $params->setWebsiteIndex(WebsiteIndex::SITE_1);

        // Satın alan kişi bilgisini ekle
        $params->setBuyer($buyer);

        // Fatura ve kargo adresini aynı şekilde ekle
        $params->setAddress($address);

        // Sipariş numarası ve sipariş tutarını ekle

        $params->setOrderData($order_id, $total);

        // Sipariş edilen ürünü ekle
        $product_name = json_decode($order->product)->name;
        $params->setProductData($product_name, ProductType::DOWNLOADABLE_VIRTUAL);

        try {
            /**
             * Otomatik ödeme sayfasına yönlendiren renderer
             */
            $renderer = new AutoSubmitFormRenderer($shopier);
            $shopier->goWith($renderer);

        } catch (RequiredParameterException $e) {
            // Zorunlu parametrelerden bir ve daha fazlası eksik
            echo $e->getMessage();
        } catch (NotRendererClassException $e) {
            // $shopier->createRenderer(...) metodunda verilen class adı AbstractRenderer sınıfından türetilmemiş !
            echo $e->getMessage();
        } catch (RendererClassNotFoundException $e) {
            // $shopier->createRenderer(...) metodunda verilen class bulunamadı !
            echo $e->getMessage();
        }
    }
    public function callback(Request $request)
    {
        // $_POST içerisinde aşağıdaki şekilde veriler gelir
        //[
        //    'platform_order_id' => '10002',
        //    'API_key' => '*****',
        //    'status' => 'success',
        //    'installment' => '0',
        //    'payment_id' => '954344654',
        //    'random_nr' => '123456',
        //    'signature' => 'f3EjDlXoPICsKssHT9iv/5ddCXIwk1ZcItlYXDqyYHrNso=',
        //];
        $status = $_POST["status"];
        $order_id = $_POST["platform_order_id"];
        $payment_id = $_POST["payment_id"];
        $signature = $_POST["signature"];
        $shopierResponse = ShopierResponse::fromPostData();
        if (!$shopierResponse->hasValidSignature(Cache::get('shopier_api_secret'))) {
            //TODO: Ödeme başarılı değil, hata mesajı göster
            die('Ödemeniz alınamadı');
        }

        /*
         *
         * Ödeme başarıyla gerçekleşti. Ödeme sonrası işlemleri uygula
         *
         */

        $order = Order::where('order_id', $order_id)->first();
        if ($order) {
            if ($order->payment_status == 0) {
                if ($order->wallet == 1) {
                    $user = User::where('id', $order->user_id)->first();
                    $user->wallet = $user->wallet + $order->total;
                    $user->save();
                    $order->payment_method = Cache::get('shopier_name');
                    $order->payment_status = 1;
                    $order->save();

                    if (Cache::get('telegram_bot_active') == 1) {
                        $message = __('Balance has been added to wallet with Shopier.') . ' UserID : ' . $user->id . ' : ' . __('for ') . config('app.currency_symbol') . $order->total . ' Wallet Balance : ' . config('app.currency_symbol') . $user->wallet;
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
                    $order->payment_method = Cache::get('shopier_name');
                    $order->payment_status = 1;
                    $order->save();
                    Product::where('id', $product_id)->increment('sales_count', $qty);
                    if($order->coupon_code){
                        $coupon = Coupon::where('code', $order->coupon_code)->increment('used', 1);
                    }
                    if (Cache::get('telegram_bot_active') == 1) {
                        $message = __('Order') . ' # ' . $order->order_id . ' ' . __('has been paid with Shopier') . ' : ' . json_decode($order->product)->name . ' x ' . json_decode($order->product)->qty . ' ' . __('for ') . config('app.currency_symbol') . $order->total;
                        telegram_bot_send_message($message);
                    }
                }
                if ($order->wallet == 1) {
                    return redirect()->route('profile.wallets')->with('success', __('Your payment has been completed successfully.'));
                } else {
                    return redirect('/order-details?order_id=' . $order->order_id.'&email='.json_decode($order->billing_details)->email)->with('success', __('Your payment has been completed successfully.'));
                }
            }
        }
    }
}
