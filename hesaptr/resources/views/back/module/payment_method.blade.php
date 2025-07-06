@extends('back.layouts.app')
@push('title', __('Payment Methods'))
@section('content')
    <div class="row g-2">
        <h5 class="text-center ">
            {{ __('Payment Methods') }}
        </h5>
        <div class="col-lg-4">
            <div class="card shadow-sm rounded-3 border-0">
                <div class="card-header text-center d-flex align-items-center justify-content-between m-1 border-0 rounded">
                    PAYTR
                    <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#paytr">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>
                <div class="collapse" id="paytr">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.module.payment_method.update') }}">
                            @csrf
                            <input type="hidden" name="module_name" value="paytr">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input value="1" class="form-check-input" type="checkbox" role="switch"
                                        id="paytr_active" name="paytr_active"
                                        @if (Cache::get('paytr_active') == 1) checked @endif>
                                    <label class="form-check-label" for="paytr_active">
                                        {{ __('PAYTR Active') }}
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Name') }}
                                </label>
                                <input type="text" class="form-control" name="paytr_name"
                                    value="{{ Cache::get('paytr_name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Mağaza No (merchant_id)
                                </label>
                                <input type="text" class="form-control" name="paytr_merchant_id"
                                    value="{{ Cache::get('paytr_merchant_id') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Mağaza Anahtar (merchant_key)
                                </label>
                                <input type="text" class="form-control" name="paytr_merchant_key"
                                    value="{{ Cache::get('paytr_merchant_key') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Mağaza Gizli Anahtar (merchant_salt)
                                </label>
                                <input type="text" class="form-control" name="paytr_merchant_salt"
                                    value="{{ Cache::get('paytr_merchant_salt') }}">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                        name="convert_to_exchange_rate_paytr" value="1"
                                        @if (Cache::get('convert_to_exchange_rate_paytr') == 1) checked @endif
                                        onchange="let element = document.getElementById('exchange_settings_paytr'); if(this.checked) element.classList.remove('d-none'); else element.classList.add('d-none');">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ __('Automatic currency conversion on the payment screen') }} <a
                                            href="https://www.tcmb.gov.tr/kurlar/today.xml" target="_blank">
                                            TCMB Kurlar Sayfası
                                        </a>
                                    </label>
                                </div>
                                <div class="d-flex align-items-center @if (Cache::get('convert_to_exchange_rate_paytr') != 1) d-none @endif"
                                    id="exchange_settings_paytr">
                                    <select class="form-select form-select-sm" name="to_exchange_paytr">
                                        <option value="USD" @if (Cache::get('to_exchange_paytr') == 'USD') selected @endif>USD
                                            -
                                            $</option>
                                        <option value="TRY" @if (Cache::get('to_exchange_paytr') == 'TRY') selected @endif>TRY
                                            -
                                            ₺</option>
                                        <option value="EUR" @if (Cache::get('to_exchange_paytr') == 'EUR') selected @endif>EUR
                                            -
                                            €</option>
                                        <option value="GBP" @if (Cache::get('to_exchange_paytr') == 'GBP') selected @endif>GBP
                                            -
                                            £</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Bildirim URL (Callback URL)
                                </label>
                                <input type="text" class="form-control" value="{{ route('paytr.callback') }}" disabled>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="module_name" value="paytr">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
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
                    STRIPE
                    <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#stripe">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>
                <div class="collapse" id="stripe">
                    <div class="card-body ">
                        <form method="POST" action="{{ route('admin.module.payment_method.update') }}">
                            @csrf
                            <input type="text" name="module_name" value="stripe" hidden="">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="stripe_active"
                                        name="stripe_active" value="1"
                                        @if (Cache::get('stripe_active') == 1) checked @endif>
                                    <label class="form-check-label" for="stripe_active">
                                        {{ __('STRIPE Active') }}
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Name') }}
                                </label>
                                <input type="text" class="form-control" name="stripe_name"
                                    value="{{ Cache::get('stripe_name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Publishable Key') }}
                                </label>
                                <input type="text" class="form-control" name="stripe_api_key"
                                    value="{{ Cache::get('stripe_api_key') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Secret Key') }}
                                </label>
                                <input type="text" class="form-control" name="stripe_api_secret"
                                    value="{{ Cache::get('stripe_api_secret') }}">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
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
                    SHOPIER
                    <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#shopier">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>
                <div class="collapse" id="shopier">
                    <div class="card-body ">
                        <form method="POST" action="{{ route('admin.module.payment_method.update') }}">
                            @csrf
                            <input type="text" name="module_name" value="shopier" hidden="">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="shopier_active"
                                        name="shopier_active" value="1"
                                        @if (Cache::get('shopier_active') == 1) checked @endif>
                                    <label class="form-check-label" for="shopier_active">
                                        {{ __('SHOPIER Active') }}
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Name') }}
                                </label>
                                <input type="text" class="form-control" name="shopier_name"
                                    value="{{ Cache::get('shopier_name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Api Username') }}
                                </label>
                                <input type="text" class="form-control" name="shopier_api_username"
                                    value="{{ Cache::get('shopier_api_username') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Secret Key') }}
                                </label>
                                <input type="text" class="form-control" name="shopier_api_secret"
                                    value="{{ Cache::get('shopier_api_secret') }}">
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault2"
                                        name="convert_to_exchange_rate_shopier" value="1"
                                        @if (Cache::get('convert_to_exchange_rate_shopier') == 1) checked @endif
                                        onchange="let element = document.getElementById('exchange_settings_shopier'); if(this.checked) element.classList.remove('d-none'); else element.classList.add('d-none');">
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        {{ __('Automatic currency conversion on the payment screen') }} <a
                                            href="https://www.tcmb.gov.tr/kurlar/today.xml" target="_blank">
                                            TCMB Kurlar Sayfası
                                        </a>
                                    </label>
                                </div>
                                <div class="d-flex align-items-center @if (Cache::get('convert_to_exchange_rate_shopier') != 1) d-none @endif"
                                    id="exchange_settings_shopier">
                                    <select class="form-select form-select-sm" name="to_exchange_shopier">
                                        <option value="USD" @if (Cache::get('to_exchange_shopier') == 'USD') selected @endif>USD
                                            -
                                            $</option>
                                        <option value="TRY" @if (Cache::get('to_exchange_shopier') == 'TRY') selected @endif>TRY
                                            -
                                            ₺</option>
                                        <option value="EUR" @if (Cache::get('to_exchange_shopier') == 'EUR') selected @endif>EUR
                                            -
                                            €</option>
                                        <option value="GBP" @if (Cache::get('to_exchange_shopier') == 'GBP') selected @endif>GBP
                                            -
                                            £</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
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
                    {{ __('HAVALE/EFT') }}
                    <button class="btn btn-sm btn-primary px-3" data-bs-toggle="collapse" data-bs-target="#iban">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>
                <div class="collapse" id="iban">
                    <div class="card-body ">

                        <form method="POST" action="{{ route('admin.module.payment_method.update') }}">
                            @csrf
                            <input type="hidden" name="module_name" value="iban">
                            <div class="form-check form-switch mb-2">
                                <input @if (Cache::get('iban_active') == 1) checked @endif value="1"
                                    class="form-check-input" type="checkbox" role="switch" id="iban_active"
                                    name="iban_active">
                                <label class="form-check-label" for="iban_active">
                                    {{ __('HAVALE/EFT Ödeme Alma Aktif') }}
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Name') }}
                                </label>
                                <input type="text" class="form-control" name="iban_name"
                                    value="{{ Cache::get('iban_name') }}">
                            </div>
                            <div x-data="handler2()">
                                <template x-for="(field, index) in fields2" :key="index">
                                    <div class="p-2 border rounded mb-3">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('IBAN') }}</label>
                                            <input type="text" class="form-control" name="ibans[]"
                                                x-model="field.ibans" placeholder="TR 00 0000 0000 0000 0000 0000 00">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Banka Adı') }}</label>
                                            <input type="text" class="form-control" name="iban_banks[]"
                                                x-model="field.iban_banks">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Alıcı Adı') }}</label>
                                            <input type="text" class="form-control" name="iban_names[]"
                                                x-model="field.iban_names">
                                        </div>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary clear-input" type="button"
                                                @click="removeField2(index)">
                                                <i class="bi bi-trash"></i> {{ __('Sil') }}
                                            </button>
                                        </div>
                                    </div>
                                </template>
                                <button type="button" class="btn btn-primary" @click="addNewField2()">
                                    <i class="bi bi-plus"></i> {{ __('Banka Ekle') }}
                                </button>
                            </div>

                            <script>
                                function handler2() {
                                    return {
                                        fields2: [
                                            @if (Cache::get('ibans'))
                                                @foreach (Cache::get('ibans') as $item)
                                                    {
                                                        ibans: '{!! $item['iban'] !!}',
                                                        iban_banks: '{!! $item['iban_bank'] !!}',
                                                        iban_names: '{!! $item['iban_name'] !!}'
                                                    },
                                                @endforeach
                                            @endif
                                        ],
                                        addNewField2() {
                                            this.fields2.push({
                                                ibans: '',
                                                iban_bank: '',
                                                iban_name: ''
                                            });
                                        },
                                        removeField2(index) {
                                            this.fields2.splice(index, 1);
                                        }
                                    }
                                }
                            </script>
                            <div class="d-grid mt-3 col-lg-8 mx-auto">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i>
                                    {{ __('Kaydet') }}
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
@endpush
