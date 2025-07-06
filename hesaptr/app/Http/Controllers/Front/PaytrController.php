<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Cache;
use App\Models\ProductStock;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
class PaytrController extends Controller
{
    public function getToken($order_id)
    {
        ## 1. ADIM için örnek kodlar ##
        $order = Order::where('order_id', $order_id)->first();

        ####################### DÜZENLEMESİ ZORUNLU ALANLAR #######################
        #
        ## API Entegrasyon Bilgileri - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
        $merchant_id = Cache::get('paytr_merchant_id'); // Mağaza numarası
        $merchant_key = Cache::get('paytr_merchant_key'); // Mağaza anahtarı
        $merchant_salt = Cache::get('paytr_merchant_salt'); // Mağaza salt değeri
        #
        ## Müşterinizin sitenizde kayıtlı veya form vasıtasıyla aldığınız eposta adresi
        $email = json_decode($order->billing_details)->email;
        #
        ## Tahsil edilecek tutar.
        $total = $order->total;

        if (Cache::get('convert_to_exchange_rate_paytr') == 1) {
            $total = TCMB_Converter(config('app.currency'), Cache::get('to_exchange_paytr'), $total);
            $currency = Cache::get('to_exchange_paytr');
        } else {
            $currency = config('app.currency');
        }

        $payment_amount = $total * 100; //9.99 için 9.99 * 100 = 999 gönderilmelidir.

        ## Sipariş numarası: Her işlemde benzersiz olmalıdır!! Bu bilgi bildirim sayfanıza yapılacak bildirimde geri gönderilir.
        $merchant_oid = $order->order_id;

        ## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız ad ve soyad bilgisi
        $user_name = json_decode($order->billing_details)->name . ' ' . json_decode($order->billing_details)->surname;
        #
        ## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız adres bilgisi
        $user_address = "Bilinmiyor";
        #
        ## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız telefon bilgisi
        $user_phone = json_decode($order->billing_details)->phone;
        #
        ## Başarılı ödeme sonrası müşterinizin yönlendirileceği sayfa
        ## !!! Bu sayfa siparişi onaylayacağınız sayfa değildir! Yalnızca müşterinizi bilgilendireceğiniz sayfadır!
        ## !!! Siparişi onaylayacağız sayfa "Bildirim URL" sayfasıdır (Bakınız: 2.ADIM Klasörü).
        $merchant_ok_url = route('paytr.callback.ok', ['order_id' => $order->order_id]);
        #
        ## Ödeme sürecinde beklenmedik bir hata oluşması durumunda müşterinizin yönlendirileceği sayfa
        ## !!! Bu sayfa siparişi iptal edeceğiniz sayfa değildir! Yalnızca müşterinizi bilgilendireceğiniz sayfadır!
        ## !!! Siparişi iptal edeceğiniz sayfa "Bildirim URL" sayfasıdır (Bakınız: 2.ADIM Klasörü).
        $merchant_fail_url = route('paytr.callback.fail');
        #
        ## Müşterinin sepet/sipariş içeriği

        $user_basket = base64_encode(json_encode(array(
            array(json_decode($order->product)->name, $total, json_decode($order->product)->qty),
        )));

        #
        /* ÖRNEK $user_basket oluşturma - Ürün adedine göre array'leri çoğaltabilirsiniz
        $user_basket = base64_encode(json_encode(array(
        array("Örnek ürün 1", "18.00", 1), // 1. ürün (Ürün Ad - Birim Fiyat - Adet )
        array("Örnek ürün 2", "33.25", 2), // 2. ürün (Ürün Ad - Birim Fiyat - Adet )
        array("Örnek ürün 3", "45.42", 1)  // 3. ürün (Ürün Ad - Birim Fiyat - Adet )
        )));
         */
        ############################################################################################

        ## Kullanıcının IP adresi
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        ## !!! Eğer bu örnek kodu sunucuda değil local makinanızda çalıştırıyorsanız
        ## buraya dış ip adresinizi (https://www.whatismyip.com/) yazmalısınız. Aksi halde geçersiz paytr_token hatası alırsınız.
        $user_ip = request()->ip();
        ##

        ## İşlem zaman aşımı süresi - dakika cinsinden
        $timeout_limit = "30";

        ## Hata mesajlarının ekrana basılması için entegrasyon ve test sürecinde 1 olarak bırakın. Daha sonra 0 yapabilirsiniz.
        $debug_on = 1;

        ## Mağaza canlı modda iken test işlem yapmak için 1 olarak gönderilebilir.
        $test_mode = 0;

        $no_installment = 0; // Taksit yapılmasını istemiyorsanız, sadece tek çekim sunacaksanız 1 yapın

        ## Sayfada görüntülenecek taksit adedini sınırlamak istiyorsanız uygun şekilde değiştirin.
        ## Sıfır (0) gönderilmesi durumunda yürürlükteki en fazla izin verilen taksit geçerli olur.
        $max_installment = 0;

        ####### Bu kısımda herhangi bir değişiklik yapmanıza gerek yoktur. #######
        $hash_str = $merchant_id . $user_ip . $merchant_oid . $email . $payment_amount . $user_basket . $no_installment . $max_installment . $currency . $test_mode;
        $paytr_token = base64_encode(hash_hmac('sha256', $hash_str . $merchant_salt, $merchant_key, true));
        $post_vals = array(
            'merchant_id' => $merchant_id,
            'user_ip' => $user_ip,
            'merchant_oid' => $merchant_oid,
            'email' => $email,
            'payment_amount' => $payment_amount,
            'paytr_token' => $paytr_token,
            'user_basket' => $user_basket,
            'debug_on' => $debug_on,
            'no_installment' => $no_installment,
            'max_installment' => $max_installment,
            'user_name' => $user_name,
            'user_address' => $user_address,
            'user_phone' => $user_phone,
            'merchant_ok_url' => $merchant_ok_url,
            'merchant_fail_url' => $merchant_fail_url,
            'timeout_limit' => $timeout_limit,
            'currency' => $currency,
            'test_mode' => $test_mode,
            'lang' => config('app.locale'),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        // XXX: DİKKAT: lokal makinanızda "SSL certificate problem: unable to get local issuer certificate" uyarısı alırsanız eğer
        // aşağıdaki kodu açıp deneyebilirsiniz. ANCAK, güvenlik nedeniyle sunucunuzda (gerçek ortamınızda) bu kodun kapalı kalması çok önemlidir!
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = @curl_exec($ch);

        if (curl_errno($ch)) {
            die("PAYTR IFRAME connection error. err:" . curl_error($ch));
        }

        curl_close($ch);

        $result = json_decode($result, 1);

        if ($result['status'] == 'success') {
            $token = $result['token'];
        } else {
            $order->delete();
            die("PAYTR IFRAME failed. reason:" . $result['reason']);
        }
        return $token;
    }
    public function callback()
    {
        ## 2. ADIM için örnek kodlar ##

        ## ÖNEMLİ UYARILAR ##
        ## 1) Bu sayfaya oturum (SESSION) ile veri taşıyamazsınız. Çünkü bu sayfa müşterilerin yönlendirildiği bir sayfa değildir.
        ## 2) Entegrasyonun 1. ADIM'ında gönderdiğniz merchant_oid değeri bu sayfaya POST ile gelir. Bu değeri kullanarak
        ## veri tabanınızdan ilgili siparişi tespit edip onaylamalı veya iptal etmelisiniz.
        ## 3) Aynı sipariş için birden fazla bildirim ulaşabilir (Ağ bağlantı sorunları vb. nedeniyle). Bu nedenle öncelikle
        ## siparişin durumunu veri tabanınızdan kontrol edin, eğer onaylandıysa tekrar işlem yapmayın. Örneği aşağıda bulunmaktadır.

        $post = $_POST;

        ####################### DÜZENLEMESİ ZORUNLU ALANLAR #######################
        #
        ## API Entegrasyon Bilgileri - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
        $merchant_key = Cache::get('paytr_merchant_key'); // Mağaza anahtarı
        $merchant_salt = Cache::get('paytr_merchant_salt'); // Mağaza salt değeri
        ###########################################################################

        ####### Bu kısımda herhangi bir değişiklik yapmanıza gerek yoktur. #######
        #
        ## POST değerleri ile hash oluştur.
        $hash = base64_encode(hash_hmac('sha256', $post['merchant_oid'] . $merchant_salt . $post['status'] . $post['total_amount'], $merchant_key, true));
        #
        ## Oluşturulan hash'i, paytr'dan gelen post içindeki hash ile karşılaştır (isteğin paytr'dan geldiğine ve değişmediğine emin olmak için)
        ## Bu işlemi yapmazsanız maddi zarara uğramanız olasıdır.
        if ($hash != $post['hash']) {
            die('PAYTR notification failed: bad hash');
        }

        ###########################################################################

        ## BURADA YAPILMASI GEREKENLER
        ## 1) Siparişin durumunu $post['merchant_oid'] değerini kullanarak veri tabanınızdan sorgulayın.
        ## 2) Eğer sipariş zaten daha önceden onaylandıysa veya iptal edildiyse  echo "OK"; exit; yaparak sonlandırın.

        // Sipariş durum sorgulama örnek
        $order = Order::where('order_id', $post['merchant_oid'])->first(); // sipariş durumunu veri tabanınızdan sorgulayın

        if ($order->payment_status == 1 || $order->payment_status == 2) {
            echo "OK";
            exit;
        }

        if ($post['status'] == 'success') { ## Ödeme Onaylandı

            ## BURADA YAPILMASI GEREKENLER
            ## 1) Siparişi onaylayın.
            ## 2) Eğer müşterinize mesaj / SMS / e-posta gibi bilgilendirme yapacaksanız bu aşamada yapmalısınız.
            ## 3) 1. ADIM'da gönderilen payment_amount sipariş tutarı taksitli alışveriş yapılması durumunda
            ## değişebilir. Güncel tutarı $post['total_amount'] değerinden alarak muhasebe işlemlerinizde kullanabilirsiniz.
            if ($order->payment_status == 0) {
                if ($order->wallet == 1) {
                    $user = User::where('id', $order->user_id)->first();
                    $user->wallet = $user->wallet + $order->total;
                    $user->save();
                    $order->payment_method = Cache::get('paytr_name');
                    $order->payment_status = 1;
                    $order->save();

                    if (Cache::get('telegram_bot_active') == 1) {
                        $message = __('Balance has been added to wallet with PayTR.') . ' UserID : ' . $user->id . ' : ' . __('for ') . config('app.currency_symbol') . $order->total . ' Wallet Balance : ' . config('app.currency_symbol') . $user->wallet;
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
                    $order->payment_method = Cache::get('paytr_name');
                    $order->payment_status = 1;
                    $order->save();
                    Product::where('id', $product_id)->increment('sales_count', $qty);
                    if($order->coupon_code){
                        $coupon = Coupon::where('code', $order->coupon_code)->increment('used', 1);
                    }
                    if (Cache::get('telegram_bot_active') == 1) {
                        $message = __('Order') . ' # ' . $order->order_id . ' ' . __('has been paid with PayTR') . ' : ' . json_decode($order->product)->name . ' x ' . json_decode($order->product)->qty . ' ' . __('for ') . config('app.currency_symbol') . $order->total;
                        telegram_bot_send_message($message);
                    }
                }
            }
        } else { ## Ödemeye Onay Verilmedi

            ## BURADA YAPILMASI GEREKENLER
            ## 1) Siparişi iptal edin.
            ## 2) Eğer ödemenin onaylanmama sebebini kayıt edecekseniz aşağıdaki değerleri kullanabilirsiniz.
            ## $post['failed_reason_code'] - başarısız hata kodu
            ## $post['failed_reason_msg'] - başarısız hata mesajı
            $order->delete();

        }

        ## Bildirimin alındığını PayTR sistemine bildir.
        echo "OK";
        exit;
    }
    public function callbackOk(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();
        if ($order) {
            if ($order->wallet == 1) {
                if($order->payment_status == 1)
                return redirect()->route('profile.wallets')->with('success', __('Your payment has been completed successfully.'));
                else
                return redirect()->route('profile.wallets')->with('error', __('Payment failed'));
            } else {
                return redirect('/order-details?order_id=' . $order->order_id.'&email='.json_decode($order->billing_details)->email)->with('success', __('Your payment has been completed successfully.'));
            }
        }
    }
    public function callbackFail(Request $request)
    {
        return redirect()->route('index')->with('error', __('Payment failed'));
    }

}
