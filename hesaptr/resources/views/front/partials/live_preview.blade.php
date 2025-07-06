<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $button_name }} | {{ $product_name }}</title>
    <meta name="robots" content="noindex, nofollow">
    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box
        }

        body,
        html {
            height: 100%
        }

        body {
            margin: 0;
            overflow: hidden;
            position: relative;
            background: rgb(63, 63, 63)  0 0 repeat;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"
        }

        #header {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 32px;
            background: #13252f;
            display: flex;
            align-items: center
        }

        .logo {
            padding-left: 10px
        }

        .logo img {
            height: 25px
        }

        .logo a {
            display: flex
        }

        .logo strong {
            margin-left: 6px;
            text-transform: uppercase
        }

        .logo strong span {
            color: #00a6eb
        }

        @media (max-width:768px) {
            .logo {
                display: none
            }
        }

        .preview-devices {
            margin-top: 2px
        }

        .preview-devices ul {
            margin: 0 0 0 20px;
            padding: 0;
            list-style: none;
            list-style-type: none;
            display: flex;
            align-items: center
        }

        .preview-devices a {
            transition: .3s;
            color: rgba(255, 255, 255, .5);
            display: inline-block;
            padding: 5px 5px
        }

        .preview-devices a .icon {
            width: 22px;
            height: 22px
        }

        .preview-devices a:hover {
            color: #fff
        }

        .preview-devices .preview-devices-active a {
            color: #fff
        }

        @media (max-width:1024px) {
            .preview-devices {
                display: none
            }
        }

        .navigate {
            display: flex;
            margin-left: auto;
            align-items: center
        }

        .navigate .icon {
            width: 22px;
            height: 22px
        }

        .navigate a {
            transition: .3s;
            color: rgba(255, 255, 255, .6);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none
        }

        .navigate a:hover {
            color: #fff
        }

        .navigate .buy {
            background: #801f1f;
            color: #fff;
            font-size: 13px;
            padding: 0 16px;
            height: 32px;
            font-weight: 700;
            text-transform: uppercase;
            margin-left: 15px;
            white-space: nowrap;
            width: 200px;
        }

        .navigate .buy .icon {
            width: 20px;
            height: 20px
        }

        .navigate .buy span {
            padding-left: 6px
        }

        .navigate .buy:hover {
            background: #ff0000
        }

        @media (max-width:768px) {
            .navigate .buy {
                padding: 0 10px;
                font-size: 12px;
                margin-left: 10px
            }

            .navigate .buy .icon {
                display: none
            }
        }

        .current-template {
            margin-top: -2px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-left: 10px
        }

        @media (min-width:768px) {
            .current-template {
                padding-left: 0;
                margin-left: auto;
            }
        }

        .current-template .icon {
            width: 24px;
            height: 24px
        }

        .current-template a {
            transition: .3s;
            color: rgba(255, 255, 255, .6);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none
        }

        .current-template a:hover {
            color: rgb(168, 168, 168)
        }

        .current-template .template-home {
            font-size: 16px;
            padding: 0;
            font-weight: 700;
            color: rgb(255, 255, 255);
            margin: -2px 10px 0 10px;
            line-height: 0;
            text-decoration: none
        }

        #preview {
            position: absolute;
            left: 0;
            right: 0;
            top: 32px;
            bottom: 0;
            transition: all .2s
        }

        #preview-frame {
            border: 0;
            position: absolute
        }

        .preview-desktop {
            left: 0;
            width: 100%;
            height: 100%
        }

        .preview-tablet {
            width: 768px;
            height: 100%;
            left: calc(50% - 384px)
        }

        .preview-mobile {
            width: 380px;
            height: 680px;
            left: calc(50% - 190px);
            top: 0;
            margin-top: 20px
        }
    </style>
</head>

<body>
    <header id="header">
        <div class="logo">
            <a href="{{route('index')}}" rel="home" title="{{ config('app.name')}}">
                <img alt="{{ config('app.name')}}" src="{{asset('uploads/logo.webp')}}">
            </a>
        </div>
        <div class="preview-devices">
            <ul>
                <li class="preview-test preview-devices-active" id="preview-test-desktop"
                    title="{{ __('Desktop preview of the') }}">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-display" viewBox="0 0 16 16">
                            <path
                                d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z" />
                        </svg>
                    </a>
                </li>
                <li class="preview-test" id="preview-test-tablet"
                    title="{{ __('Tablet preview of the') }}">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-tablet" viewBox="0 0 16 16">
                            <path
                                d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z" />
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                    </a>
                </li>
                <li class="preview-test" id="preview-test-mobile"
                    title="{{ __('Mobile preview of the') }}">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-phone" viewBox="0 0 16 16">
                            <path
                                d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z" />
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>

        <div class="current-template">
            <a class="template-home"
                href="{{ route('product', ['slug' => $product_slug]) }}"
                title="{{ $product_name }}">
                {{ $product_name }}
            </a>

        </div>

        <div class="navigate">
            <a href="{{$url}}" target="_top" title="{{__('Hide demo bar') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z" />
                    <path fill-rule="evenodd"
                        d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z" />
                </svg>
            </a>
            <a class="buy"
                href="{{ route('product', ['slug' => $product_slug]) }}"
                title="{{__('Buy Now the') }} {{$product_name}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3"
                    viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <span>
                    {{ __('Buy Now') }}
                </span>

            </a>
        </div>

    </header>


    <div id="preview">
        <iframe id="preview-frame" class="preview-desktop" src="{{ $url }}" frameborder="0"></iframe>
    </div>

    <script>
        (()=>{function n(t){for(var e=t+"=",s=document.cookie.split(";"),r=0;r<s.length;r++){for(var i=s[r];i.charAt(0)===" ";)i=i.substring(1);if(i.indexOf(e)===0)return i.substring(e.length,i.length)}return""}function o(t,e,s){var r=new Date;r.setTime(r.getTime()+s*24*60*60*1e3);var i="expires="+r.toUTCString();document.cookie=t+"="+e+";"+i+";path=/"}if(!n("sitevisitor")){let t=new Object,e=new Date(Date().toLocaleString("de-DE",{timeZone:"Europe/Sofia"}));t.referer=document.referrer,t.request=location.pathname.substring(1),t.time=e.getFullYear()+"-"+("0"+(e.getMonth()+1)).slice(-2)+"-"+e.getDate()+" "+e.getHours()+":"+e.getMinutes()+":"+("0"+e.getSeconds()).slice(-2),o("sitevisitor",btoa(JSON.stringify(t)),365)}document.addEventListener("DOMContentLoaded",()=>{"use strict";document.querySelectorAll(".preview-test").forEach(e=>{e.addEventListener("click",function(s){s.preventDefault(),document.querySelector(".preview-devices-active").classList.remove("preview-devices-active"),this.classList.add("preview-devices-active"),document.querySelector("#preview-frame").className=this.id.replace("-test","")})})});})();
    </script>
</body>

</html>