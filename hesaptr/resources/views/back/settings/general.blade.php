@extends('back.layouts.app')
@push('title', __('General Settings'))
@section('content')
<div class="row g-2">
    <h5 class="text-center ">
        {{ __('General Settings') }}
    </h5>
    <div class="col-lg-4">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0 rounded">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-house mb-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                        <path fill-rule="evenodd"
                            d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                    </svg>
                    {{ __('SITE') }}

                </span>
                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#site">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="site">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <input type="hidden" name="settings_name" value="site">
                        <div class="row g-1">
                            <div class="mb-3 col-lg-6">
                                <label class="form-label">
                                    {{ __('Site Name') }}
                                </label>
                                <input type="text" class="form-control" name="site_name"
                                    value="{{ Cache::get('site_name') }}">
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label class="form-label">
                                    {{ __('Language') }} (ex: en,tr)
                                </label>
                                <input type="text" class="form-control" name="language"
                                    value="{{ Cache::get('language') }}">
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">
                                    {{ __('Currency') }}
                                </label>
                                <select name="currency" class="form-control">
                                    <option value="USD" @if (Cache::get('currency')=='USD' ) selected @endif>USD - $
                                    </option>
                                    <option value="TRY" @if (Cache::get('currency')=='TRY' ) selected @endif>TRY - ₺
                                    </option>
                                    <option value="EUR" @if (Cache::get('currency')=='EUR' ) selected @endif>EUR - €
                                    </option>
                                    <option value="GBP" @if (Cache::get('currency')=='GBP' ) selected @endif>GBP - £
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">
                                    {{__('Products column count')}}

                                </label>
                                <br>
                                <small>
                                    {{__('Small,Medium,Large Screen Sizes')}} (1,2,3)
                                </small>
                                <input type="text" class="form-control" name="product_columns_count" value="{{ Cache::get('product_columns_count') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                {{__('Checkout Page: Note Message Placeholder')}}
                            </label>
                            <textarea class="form-control" name="checkout_message">{{ Cache::Get('checkout_message') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{__('Payment form contract page confirmation message')}}
                            </label>
                            <textarea class="form-control" name="agree_message"
                                id="editor2">{!! Cache::get('agree_message') !!}</textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-envelope" viewBox="0 1 16 16">
                        <path
                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                    </svg>
                    {{ __('SMTP E-Mail Settings') }}
                </span>

                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#smtp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="smtp">
                <div class="card-body ">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <input type="hidden" name="settings_name" value="smtp">
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Host') }}
                            </label>
                            <input type="text" class="form-control" name="smtp_host"
                                value="{{ Cache::get('smtp_host') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Port') }}
                            </label>
                            <input type="text" class="form-control" name="smtp_port"
                                value="{{ Cache::get('smtp_port') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Username') }}
                            </label>
                            <input type="text" class="form-control" name="smtp_username"
                                value="{{ Cache::get('smtp_username') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Password') }}
                            </label>
                            <input type="text" class="form-control" name="smtp_password"
                                value="{{ Cache::get('smtp_password') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('From Address') }}
                            </label>
                            <input type="text" class="form-control" name="smtp_from_address"
                                value="{{ Cache::get('smtp_from_address') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Encryption') }} (tls, ssl, null)
                            </label>
                            <input type="text" class="form-control" name="smtp_encryption"
                                value="{{ Cache::get('smtp_encryption') }}">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-images" viewBox="0 1 16 16">
                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                        <path
                            d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                    </svg>
                    {{ __('LOGO&FAVICON') }}

                </span>
                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#logo_favicon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="logo_favicon">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input hidden type="text" name="settings_name" value="logo_favicon">
                        <div class="mb-3 text-center d-flex flex-column align-items-center">
                            <img width="100" id="img_src" class="img-fluid mb-3" src="{{ asset('uploads/logo.webp') }}">
                            <input type="file" name="logo_img" hidden
                                onchange="document.getElementById('img_src').src = window.URL.createObjectURL(this.files[0])"
                                accept=".png, .jpg, .jpeg, .gif, .webp, .bmp" id="input_file">
                            <button onclick="document.getElementById('input_file').click()" type="button"
                                class="btn btn-sm btn-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-camera-fill mb-1 text-muted" viewBox="0 0 16 16">
                                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
                                </svg>
                                {{ __('Logo Upload') }}
                            </button>
                        </div>
                        <div class="mb-3 text-center d-flex flex-column align-items-center">
                            <img width="24" id="img_src2" class="img-fluid mb-3"
                                src="{{ asset('uploads/favicon.ico') }}">
                            <input type="file" name="favicon_img" hidden
                                onchange="document.getElementById('img_src2').src = window.URL.createObjectURL(this.files[0])"
                                accept=".ico" id="input_file2">
                            <button onclick="document.getElementById('input_file2').click()" type="button"
                                class="btn btn-sm btn-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-camera-fill text-muted" viewBox="0 1 16 16">
                                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
                                </svg>
                                {{ __('Favicon Upload') }} (.ico)
                            </button>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-share mb-1" viewBox="0 0 16 16">
                        <path
                            d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
                    </svg>
                    {{ __('SOCIAL MEDIA') }}
                </span>
                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#social_media">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="social_media">
                <div class="card-body ">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <input type="hidden" name="settings_name" value="social_media">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-whatsapp" viewBox="0 0 16 16">
                                        <path
                                            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                    </svg>
                                    WP
                                </span>
                                <input type="text" class="form-control" name="wp" value="{{ Cache::Get('wp') }}"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-skype" viewBox="0 0 16 16">
                                        <path
                                            d="M4.671 0c.88 0 1.733.247 2.468.702a7.423 7.423 0 0 1 6.02 2.118 7.372 7.372 0 0 1 2.167 5.215c0 .344-.024.687-.072 1.026a4.662 4.662 0 0 1 .6 2.281 4.645 4.645 0 0 1-1.37 3.294A4.673 4.673 0 0 1 11.18 16c-.84 0-1.658-.226-2.37-.644a7.423 7.423 0 0 1-6.114-2.107A7.374 7.374 0 0 1 .529 8.035c0-.363.026-.724.08-1.081a4.644 4.644 0 0 1 .76-5.59A4.68 4.68 0 0 1 4.67 0zm.447 7.01c.18.309.43.572.729.769a7.07 7.07 0 0 0 1.257.653c.492.205.873.38 1.145.523.229.112.437.264.615.448.135.142.21.331.21.528a.872.872 0 0 1-.335.723c-.291.196-.64.289-.99.264a2.618 2.618 0 0 1-1.048-.206 11.44 11.44 0 0 1-.532-.253 1.284 1.284 0 0 0-.587-.15.717.717 0 0 0-.501.176.63.63 0 0 0-.195.491.796.796 0 0 0 .148.482 1.2 1.2 0 0 0 .456.354 5.113 5.113 0 0 0 2.212.419 4.554 4.554 0 0 0 1.624-.265 2.296 2.296 0 0 0 1.08-.801c.267-.39.402-.855.386-1.327a2.09 2.09 0 0 0-.279-1.101 2.53 2.53 0 0 0-.772-.792A7.198 7.198 0 0 0 8.486 7.3a1.05 1.05 0 0 0-.145-.058 18.182 18.182 0 0 1-1.013-.447 1.827 1.827 0 0 1-.54-.387.727.727 0 0 1-.2-.508.805.805 0 0 1 .385-.723 1.76 1.76 0 0 1 .968-.247c.26-.003.52.03.772.096.274.079.542.177.802.293.105.049.22.075.336.076a.6.6 0 0 0 .453-.19.69.69 0 0 0 .18-.496.717.717 0 0 0-.17-.476 1.374 1.374 0 0 0-.556-.354 3.69 3.69 0 0 0-.708-.183 5.963 5.963 0 0 0-1.022-.078 4.53 4.53 0 0 0-1.536.258 2.71 2.71 0 0 0-1.174.784 1.91 1.91 0 0 0-.45 1.287c-.01.37.076.736.25 1.063z" />
                                    </svg>
                                    SK
                                </span>
                                <input type="text" class="form-control" name="sk" value="{{ Cache::Get('sk') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                    </svg>
                                    FB
                                </span>
                                <input type="text" class="form-control" name="fb" value="{{ Cache::Get('fb') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                    </svg>
                                    IG
                                </span>
                                <input type="text" class="form-control" name="ig" value="{{ Cache::Get('ig') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                    </svg>
                                    TW
                                </span>
                                <input type="text" class="form-control" name="tw" value="{{ Cache::Get('tw') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-youtube" viewBox="0 0 16 16">
                                        <path
                                            d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                                    </svg>
                                    YT
                                </span>
                                <input type="text" class="form-control" name="yt" value="{{ Cache::Get('yt') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pinterest" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0z" />
                                    </svg>
                                    PIN
                                </span>
                                <input type="text" class="form-control" name="pin" value="{{ Cache::Get('pin') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-linkedin" viewBox="0 0 16 16">
                                        <path
                                            d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                    </svg>
                                    IN
                                </span>
                                <input type="text" class="form-control" name="in" value="{{ Cache::Get('in') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-github" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                                    </svg>
                                    GH
                                </span>
                                <input type="text" class="form-control" name="git" value="{{ Cache::Get('git') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-telegram" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
                                    </svg>
                                    TG
                                </span>
                                <input type="text" class="form-control" name="tg" value="{{ Cache::Get('tg') }}">
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0 rounded">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-house mb-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                        <path fill-rule="evenodd"
                            d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                    </svg>
                    {{ __('HOME PAGE') }}

                </span>
                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#homepagex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="homepagex">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <input type="hidden" name="settings_name" value="homepage">
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Meta Title') }}
                            </label>
                            <input type="text" class="form-control" name="homepage_meta_title"
                                value="{{ Cache::get('homepage_meta_title') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Meta Description') }}
                            </label>
                            <input type="text" class="form-control" name="homepage_meta_description"
                                value="{{ Cache::get('homepage_meta_description') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Meta Keywords') }} <small>{{ __('Ex: keyword1,keyword2,keyword3') }}</small>
                            </label>
                            <input type="text" class="form-control" name="homepage_meta_keywords"
                                value="{{ Cache::get('homepage_meta_keywords') }}">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0 rounded">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google mb-1" viewBox="0 0 16 16">
                        <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                      </svg>
                    {{ __('GOOGLE reCAPTCHA,Login') }}
                </span>

                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse"
                    data-bs-target="#google_recaptcha">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="google_recaptcha">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <input type="hidden" name="settings_name" value="google">
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('reCAPTCHA Site Key') }}
                            </label>
                            <input type="text" class="form-control" name="google_recaptcha_sitekey"
                                value="{{ Cache::get('google_recaptcha_sitekey') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('reCAPTCHA Secret Key') }}
                            </label>
                            <input type="text" class="form-control" name="google_recaptcha_secretkey"
                                value="{{ Cache::get('google_recaptcha_secretkey') }}">
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('OAuth Client ID') }}
                            </label>
                            <input type="text" class="form-control" name="google_oauth_client_id"
                                value="{{ Cache::get('google_oauth_client_id') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('OAuth Client Secret Key') }}
                            </label>
                            <input type="text" class="form-control" name="google_oauth_client_secret"
                                value="{{ Cache::get('google_oauth_client_secret') }}">
                        </div>
                        <div class="mb-3">
                            <label>
                                {{ __('OAuth Redirect URI') }}
                            </label>
                            <div class="input-group">
                                <input type="text" value="{{ route('login.google.callback') }}" class="form-control bg-light"
                                    readonly>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0 rounded">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-headset" viewBox="0 0 16 16">
                        <path
                            d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z" />
                    </svg>
                    {{ __('CONTACT PAGE') }}

                </span>
                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#contact">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="contact">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <input type="hidden" name="settings_name" value="contact">
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Address') }}
                            </label>
                            <input type="text" class="form-control" name="contact_address"
                                value="{{ Cache::get('contact_address') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('E-Mail') }}
                            </label>
                            <input type="text" class="form-control" name="contact_email"
                                value="{{ Cache::get('contact_email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Phone') }}
                            </label>
                            <input type="text" class="form-control" name="contact_phone"
                                value="{{ Cache::get('contact_phone') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Title') }}
                            </label>
                            <input type="text" class="form-control" name="contact_meta_title"
                                value="{{ Cache::get('contact_meta_title') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Descripton') }}
                            </label>
                            <input type="text" class="form-control" name="contact_meta_description"
                                value="{{ Cache::get('contact_meta_description') }}">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0 rounded">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        class="mb-1 text-muted" fill="currentColor">
                        <path
                            d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z">
                        </path>
                    </svg>
                    {{ __('TELEGRAM BOT NOTIFICATION') }}
                </span>
                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#telegram_bot">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="telegram_bot">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <span>
                            {{ __('Order Notification')}}
                        </span>
                        <input type="hidden" name="settings_name" value="telegram_bot">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="telegram_bot_active"
                                    name="telegram_bot_active" value="1" @if(Cache::get('telegram_bot_active')==1)
                                    checked @endif>
                                <label class="form-check-label" for="telegram_bot_active">
                                    {{ __('Telegram Bot Notification Active') }}
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Bot Token') }}
                            </label>
                            <input type="text" class="form-control" name="telegram_bot_token"
                                value="{{ Cache::get('telegram_bot_token') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Chat ID') }}
                            </label>
                            <input type="text" class="form-control" name="telegram_bot_chat_id"
                                value="{{ Cache::get('telegram_bot_chat_id') }}">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('admin.settings.test.telegram') }}">
                        @csrf
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                {{__('Test Notification')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-window mb-1" viewBox="0 0 16 16">
                        <path
                            d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        <path
                            d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm13 2v2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zM2 14a1 1 0 0 1-1-1V6h14v7a1 1 0 0 1-1 1H2z" />
                    </svg>
                    {{ __('POPUP') }}
                </span>
                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#popup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="popup">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <input hidden type="text" name="settings_name" value="popup">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="popup_active"
                                    name="popup_active" value="1" @if (Cache::get('popup_active')==1) checked @endif>
                                <label class="form-check-label" for="popup_active">
                                    {{ __('Popup Active')}}
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Popup Title') }}*
                            </label>
                            <div class="input-group">

                                <input type="text" class="form-control" name="popup_title"
                                    value="{{ Cache::get('popup_title') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Popup Content') }}*
                            </label>
                            <textarea class="form-control" name="popup_content" cols="15" id="popup_content"
                                rows="5">{!! Cache::get('popup_content') !!}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="form-label">
                                {{ __('Popup Button Name')}}
                            </label>
                            <div class="input-group">

                                <input type="text" class="form-control" name="popup_button_name"
                                    value="{{ Cache::get('popup_button_name') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="form-label">
                                {{ __('Popup Button Link')}}
                            </label>
                            <div class="input-group">

                                <input type="text" class="form-control" name="popup_button_link"
                                    value="{{ Cache::get('popup_button_link') }}">
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-12">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-code-slash" viewBox="0 1 16 16">
                        <path
                            d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z" />
                    </svg>
                    {{ __('ROBOTS.txt') }}

                </span>
                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#robots_txt">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="robots_txt">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <input type="hidden" name="settings_name" value="robots_txt">
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Content') }}
                            </label>
                            <textarea class="form-control" name="robots_txt" rows="10">{{ $robots_txt }}</textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-code-slash" viewBox="0 1 16 16">
                        <path
                            d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z" />
                    </svg>
                    {{ __('EXTRA HEADER&FOOTER CODE') }}

                </span>
                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#extra_code">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="collapse" id="extra_code">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <input type="hidden" name="settings_name" value="extra_code">
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Extra Header Code') }} <small class="text-muted">(&lt;head&gt;
                                    {{ __('Here code') }} &lt;/head&gt;)</small>
                            </label>
                            <textarea class="form-control" name="extra_header"
                                rows="10">{{ Cache::get('extra_header') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Extra Footer Code') }} <small class="text-muted">(&lt;body&gt;
                                    {{ __('Here code') }} &lt;/body&gt;)</small>
                            </label>
                            <textarea class="form-control" name="extra_footer"
                                rows="10">{{ Cache::get('extra_footer') }}</textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('back/js/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#editor2',
        height: 200,
        menubar: false,
        relative_urls: false,
        advlist_number_styles: "default",
        advlist_bullet_styles: "default",
        plugins: 'link emoticons code autolink code',
        toolbar: 'numlist bullist | forecolor backcolor | hr | link emoticons | code',
    });

    tinymce.init({
            selector: '#popup_content',
            images_upload_url: '{{ route('admin.tinymce.upload') }}',
            menubar: false,
            relative_urls: false,
            advlist_number_styles: "default",
            advlist_bullet_styles: "default",
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            toolbar: 'h1 h2 h3 bold italic blockquote strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor hr | link image media | table emoticons codesample | ltr rtl |  removeformat help fullscreen preview code',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            automatic_uploads: true,
            image_title: true,
            paste_auto_cleanup_on_paste: true,
            paste_remove_styles: true,
            paste_remove_styles_if_webkit: true,
            paste_strip_class_attributes: true,
            paste_postprocess: function(plugin, args) {
                var allElements = args.node.getElementsByTagName("img");
                for (i = 0; i < allElements.length; ++i) {
                    allElements[i].className = "img-fluid";
                }
            },

            file_picker_types: 'image',
            image_class_list: [{
                title: 'Responsive',
                value: 'img-fluid'
            }],

            /* and here's our custom image picker*/
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                // Provide image and alt text for the image dialog

                /*
                Note: In modern browsers input[type="file"] is functional without
                even adding it to the DOM, but that might not be the case in some older
                or quirky browsers like IE, so you might want to add it to the DOM
                just in case, and visually hide it. And do not forget do remove it
                once you do not need it anymore.
                */

                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function() {
                        /*
                        Note: Now we need to register the blob in TinyMCEs image blob
                        registry. In the next release this part hopefully won't be
                        necessary, as we are looking to handle it internally.
                        */
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }

        });
</script>
<script>
    top_slider_html = `
    <div class="mb-3" id="inputFormRow">
        <div class="row g-1">
            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Slider Text') }}*
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="top_slider_text[]" value="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Slider Url') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="top_slider_url[]" value="">
                                </div>
                            </div>
            <div class="col-lg-4">
                <div class="d-grid">
                    <button id="removeRow" type="button" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash mb-1" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd"
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                        {{ __('Delete') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    `;
    $("#add_top_slider").click(function() {
        $('#top_slider_div').append(top_slider_html);
    });
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
    });
</script>
@endpush
