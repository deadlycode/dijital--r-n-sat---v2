<!DOCTYPE html>
<html lang="{{config('app.locale')}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{Cache::get('paytr_name')}}</title>
</head>

<body>
    <!-- Ödeme formunun açılması için gereken HTML kodlar / Başlangıç -->
    <script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
    <iframe src="https://www.paytr.com/odeme/guvenli/<?php echo $token;?>" id="paytriframe" frameborder="0"
        scrolling="no" style="width: 100%;"></iframe>
    <script>
        iFrameResize({},'#paytriframe');
    </script>
    <!-- Ödeme formunun açılması için gereken HTML kodlar / Bitiş -->
</body>

</html>