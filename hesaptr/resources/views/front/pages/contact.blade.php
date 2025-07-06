@extends('front.layouts.app')
@push('title', Cache::get('contact_meta_title', 'Contact Us'))
@push('meta_description', Cache::get('contact_meta_description', 'Contact Us'))
@section('content')
<section id="contact" class="contact bg-light py-3">
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                    class="bi bi-envelope-heart mb-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l3.235 1.94a2.76 2.76 0 0 0-.233 1.027L1 5.384v5.721l3.453-2.124c.146.277.329.556.55.835l-3.97 2.443A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741l-3.968-2.442c.22-.28.403-.56.55-.836L15 11.105V5.383l-3.002 1.801a2.76 2.76 0 0 0-.233-1.026L15 4.217V4a1 1 0 0 0-1-1H2Zm6 2.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" />
                </svg>
                {{ Cache::get('contact_meta_title', 'Contact Us') }}
            </h3>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="col-lg-12">
                <div class="info-wrap bg-white">
                    <div class="row">
                        <div class="col-lg-4 info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-geo-alt" viewBox="0 0 16 16">
                                <path
                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            <h4>{{__('Address')}}:</h4>
                            <p>{{ Cache::get('contact_address') }}</p>
                        </div>
                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-envelope-at" viewBox="0 0 16 16">
                                <path
                                    d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
                                <path
                                    d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
                            </svg>
                            <h4>{{__('Email')}}:</h4>
                            <p><a target="_blank" href="mailto:{{ Cache::get('contact_email') }}">{{
                                    Cache::get('contact_email') }}</a></p>
                        </div>
                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-phone" viewBox="0 0 16 16">
                                <path
                                    d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z" />
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            </svg>
                            <h4>{{__('Phone')}}:</h4>
                            <p>
                                <a target="_blank" href="{{ Cache::get('contact_phone') }}">
                                    {{Cache::get('contact_phone') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="col-lg-12">

                <form action="{{ route('page.contact.send') }}" method="post" role="form" class="php-email-form"
                    id="contact-form">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="{{__('Name')}}*"
                                required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="{{__('Email')}}" required>
                        </div>
                    </div>
                    <div class="form-group ">
                        <input type="text" class="form-control" name="subject" id="subject"
                            placeholder="{{__('Subject')}}" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" placeholder="{{__('Message')}}" required
                            minlength="10"></textarea>
                    </div>
                   
                    @if(Cache::get('google_recaptcha_sitekey') && Cache::get('google_recaptcha_secretkey'))
                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                    <script
                        src="https://www.google.com/recaptcha/api.js?render={{Cache::get('google_recaptcha_sitekey')}}">
                    </script>
                    <script>
                        grecaptcha.ready(function() {
                        grecaptcha.execute('{{Cache::get('google_recaptcha_sitekey')}}', {action: 'contact'}).then(function(token) {
                            document.getElementById('g-recaptcha-response').value = token;
                        });
                    });
                    </script>
                    @endif
                    <div class="text-center">
                        <button class="btn btn-primary col-lg-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-send-fill" viewBox="0 0 16 16">
                                <path
                                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                            </svg>
                            {{__('Send Message')}}
                        </button>
                    </div>
                </form>
                <script src="https://www.google.com/recaptcha/api.js"></script>
            </div>
        </div>
    </div>
</section>
@endsection