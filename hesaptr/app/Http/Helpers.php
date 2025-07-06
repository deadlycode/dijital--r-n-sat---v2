<?php
function money($amount)
{
    return number_format($amount, 2, ",", "."); // Output: 1,250.00
}
function array_zip_combine(array $keys, ...$arrs)
{
    return array_map(function (...$values) use ($keys) {
        return array_combine($keys, $values);
    }, ...$arrs);
}
function TCMB_Converter($from, $to, $val)
{
    // Sistemimizde Simplexml ve Curl fonksiyonları var mı kontrol ediyoruz.
    if (!function_exists('simplexml_load_string') || !function_exists('curl_init')) {
        return 'Simplexml extension missing.';
    }

    // Başlangıç için nereden/nereye değerlerini 1 yapıyoruz çünkü TRY'nin bir karşılığı yok.
    $CurrencyData = [
        'from' => 1,
        'to' => 1,
    ];

    // XML verisini curl ile alıyoruz, hata var mı yok mu diye try/catch bloklarına alıyoruz.
    try {
        $tcmbMirror = 'https://www.tcmb.gov.tr/kurlar/today.xml';
        $curl = curl_init($tcmbMirror);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $tcmbMirror);

        $dataFromtcmb = curl_exec($curl);
    } catch (Exception $e) {
        echo 'Unhandled exception, maybe from cURL' . $e->getMessage();
        return 0;
    }

    // XML verisini SimpleXML'e aktararak bir class haline getiriyoruz.
    $Currencies = simplexml_load_string($dataFromtcmb);

    // Bütün verileri foreach ile gezerek arıyoruz ve nereden/nereye değerlerimize eşitliyoruz.
    foreach ($Currencies->Currency as $Currency) {
        if ($from == $Currency['CurrencyCode']) {
            $CurrencyData['from'] = $Currency->BanknoteSelling;
        }

        if ($to == $Currency['CurrencyCode']) {
            $CurrencyData['to'] = $Currency->BanknoteSelling;
        }

    }

    // Hesaplama işlemini yaparak return ediyoruz.
    return round(($CurrencyData['from'] / $CurrencyData['to']) * $val, 2);
}

function telegram_bot_send_message($message)
{
    $token = Cache::get('telegram_bot_token');

    $parametre = array(
        'chat_id' => Cache::get('telegram_bot_chat_id'),
        'text' => $message,
    );
    $ch = curl_init();
    $url = "https://api.telegram.org/bot" . $token . "/sendmessage";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parametre);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    if (json_decode($result)->ok) {
        return true;
    } else {
        return false;
    }
}

function recaptchaCheck($request)
{
    if (Cache::get('google_recaptcha_sitekey') && Cache::get('google_recaptcha_secretkey')) {
        $request->validate([
            'g-recaptcha-response' => 'required',
        ]);
        $recaptcha = new \ReCaptcha\ReCaptcha(Cache::get('google_recaptcha_secretkey'));
        $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());
        if ($response->isSuccess()) {
            // Verified!
        } else {
            $errors = $response->getErrorCodes();
            return redirect()->back()->with('error', __('Please verify that you are not a robot.'));
        }
    }
}
