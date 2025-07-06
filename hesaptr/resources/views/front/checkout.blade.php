@extends('front.layouts.app')
@push('title', __('Checkout'))
@section('content')
    <section class="py-2 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-1">
                    <div class="bg-white rounded-4 p-3 shadow-sm">
                        <div class="page-header">
                            <h2 class="page-title h4 mb-0 d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-credit-card-2-front" viewBox="0 0 16 16">
                                    <path
                                        d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                </svg>
                                {{ __('Checkout Form') }}
                                @guest
                                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#loginModal">
                                        {{ __('Are you a member?') }}
                                    </button>
                                @endguest
                            </h2>
                            <small>
                                @auth {{ __('Welcome') }}: {{ Auth::user()->name }} @endauth
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <form id="form" class="form-inline-block" method="POST" action="{{ route('order.complete') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="qty" value="{{ $qty }}">
                @if(request()->customer_answers)
                @foreach(request()->customer_answers as $customer_answer)
                    <input type="hidden" name="customer_answers[]" value="{{ $customer_answer }}">
                @endforeach
                @endif
                <div class="row g-2">
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm rounded-4 mb-2">
                            <div class="card-header m-1 text-center rounded-3 border-0">
                                <h5 class="card-title mb-0 ">
                                    {{ __('Billing Details') }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-1">
                                    <div class="col-sm-6 mb-3">
                                        <label for="firstName" class="form-label">
                                            {{ __('Name') }}*
                                        </label>
                                        <input min="3" name="name" type="text" class="form-control" required
                                            autofocus
                                            @auth value="{{ Auth::user()->name }}" @else value="{{ old('name') }}" @endauth>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="lastName" class="form-label">{{ __('Surname') }}*</label>
                                        <input min="3" name="surname" type="text" class="form-control"
                                            @auth value="{{ Auth::user()->surname }}" @else value="{{ old('surname') }}" @endauth
                                            required>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="email" class="form-label">{{ __('E-Mail') }}* </label>
                                        <input min="3" name="email" type="email" class="form-control" required
                                            @auth value="{{ Auth::user()->email }}" @else value="{{ old('email') }}" @endauth>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="phone" class="form-label">
                                            {{ __('Mobile Phone') }}*
                                        </label>
                                        <input type="tel" name="phone" class="form-control"
                                            @auth value="{{ Auth::user()->phone }}" @else value="{{ old('phone') }}" @endauth
                                            required>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label>
                                        {{ __('Note') }} ({{ __('Optional') }})
                                    </label>
                                    <textarea name="note" maxlength="300" class="form-control" rows="3"
                                        placeholder="{{ Cache::get('checkout_message') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm rounded-4 mb-2">
                            <div class="card-header m-1 text-center rounded-3 border-0">
                                <h5 class="card-title mb-0 ">
                                    {{ __('Order Summary') }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column justify-content-between">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <strong>{{ $qty }} x "{{ $product->name }}"</strong>
                                        <small>
                                            {{ $qty }}x{{ config('app.currency_symbol') }}{{ money($product->price) }}
                                        </small>
                                    </div>
                                </div>
                                <hr>
                                <div class="input-group input-group-sm p-1 border rounded-3 mb-3">
                                    <input type="text" id="coupon_code_input" class="form-control border-0"
                                        placeholder="{{ __('Do you have a coupon code ? Coupon Code') }}">
                                    <button onclick="submitCoupon()" class="btn btn-primary ms-1 rounded" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-gift-fill mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zm6 4v7.5a1.5 1.5 0 0 1-1.5 1.5H9V7h6zM2.5 16A1.5 1.5 0 0 1 1 14.5V7h6v9H2.5z" />
                                        </svg>
                                        {{ __('Apply') }}
                                    </button>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="mb-0">
                                        {{ __('Subtotal') }}:
                                    </small>
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0">
                                            {{ config('app.currency_symbol') }}{{ money($product->price * $qty) }}
                                        </h6>
                                    </div>
                                </div>
                                @if ($product->discount_more)
                                    @if ($qty > explode(':', $product->discount_more)[0])
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="mb-0">
                                                {{ __('Discount') }}(%{{ explode(':', $product->discount_more)[1] }}):
                                            </small>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">
                                                    -{{ config('app.currency_symbol') }}{{ money($product->price * $qty - $total) }}
                                                </h6>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div id="coupon_div" class="d-none">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="mb-0">
                                            {{ __('Coupon Code') }}
                                        </small>
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0" id="coupon_code_input2">
                                            </h6>
                                        </div>
                                    </div>
                                    <input type="hidden" name="coupon_code" id="coupon_code_input3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="mb-0">
                                            {{ __('Coupon Discount') }}
                                        </small>
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0" id="coupon_discount_html">
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 text-danger">
                                        {{ __('Total') }}:
                                    </h6>
                                    <div class="d-flex align-items-center">
                                        <h5 id="amount_paid_html" class="fw-bold text-danger mb-0">
                                            {{ config('app.currency_symbol') }}{{ money($total) }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <select class="form-select" name="payment_method" id="payment_method">
                                        @auth
                                            @if (Auth::user()->wallet >= $total)
                                                <option value="wallet">{{ __('Pay with wallet balance') }}</option>
                                            @endif
                                        @endauth
                                        @if (Cache::get('paytr_active') == 1)
                                            <option value="paytr">
                                                {{ Cache::get('paytr_name') }}
                                            </option>
                                        @endif
                                        @if (Cache::get('stripe_active') == 1)
                                            <option value="stripe">
                                                {{ Cache::get('stripe_name') }}
                                            </option>
                                        @endif
                                        @if (Cache::get('shopier_active') == 1)
                                            <option value="shopier">
                                                {{ Cache::get('shopier_name') }}
                                            </option>
                                        @endif
                                        @if (Cache::get('papara_active') == 1)
                                            <option value="papara">
                                                {{ Cache::get('papara_name') }}
                                            </option>
                                        @endif
                                        @if (Cache::get('iban_active') == 1)
                                            <option value="iban">
                                                {{ Cache::get('iban_name') }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                <div class="text-break">
                                    {!! Cache::get('agree_message') !!}
                                </div>
                                @if (Cache::get('google_recaptcha_sitekey') && Cache::get('google_recaptcha_secretkey'))
                                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                    <script src="https://www.google.com/recaptcha/api.js?render={{ Cache::get('google_recaptcha_sitekey') }}"></script>
                                    <script>
                                        grecaptcha.ready(function() {
                                            grecaptcha.execute('{{ Cache::get('google_recaptcha_sitekey') }}', {
                                                action: 'contact'
                                            }).then(function(token) {
                                                document.getElementById('g-recaptcha-response').value = token;
                                            });
                                        });
                                    </script>
                                @endif
                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-credit-card-fill mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1z" />
                                        </svg>
                                        {{ __('Pay Securely') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('js')
    <script>
        function submitCoupon() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('order.coupon.check') }}');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status == "success") {
                        document.querySelector('#coupon_div').classList.remove('d-none');
                        document.querySelector('#coupon_code_input2').innerText = response.coupon_code;
                        document.querySelector('#coupon_code_input3').value = response.coupon_code;
                        document.querySelector('#coupon_discount_html').innerHTML = response.coupon_discount;
                        document.querySelector('#amount_paid_html').innerHTML = response.amount_paid;
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    } else {
                        alert(response.message)
                    }
                } else {
                    alert(response.error)
                }
            };
            xhr.send(encodeURI('product_id={{ request()->product_id }}&coupon_code=' + document.getElementById(
                    'coupon_code_input').value +
                '&qty={{ request()->qty }}&amount_paid={{ $total }}&_token={{ csrf_token() }}'));
        }
    </script>
@endpush
