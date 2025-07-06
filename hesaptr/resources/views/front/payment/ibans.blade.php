@extends('front.layouts.app')
@push('title', __('Banka Hesaplarımız'))
@section('content')
    <div class="container pt-1">
        <div class="row mb-3">
            <div class="col-12">
                <div class="bg-white p-3 text-center rounded-3 shadow-sm">
                    <h1 class="h3 fw-bolder d-flex align-items-center justify-content-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-bank text-muted" viewBox="0 0 16 16">
                            <path
                                d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z" />
                        </svg>
                        {{ __('Banka Hesaplarımız') }}
                    </h1>

                </div>
            </div>
        </div>
    </div>
    @if ($ibans)
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        @if ($isWallet = 0)
                            <strong>
                                {{ __('Açıklama kısmına sipariş numaranızı yazmayı unutmayın! Sipariş NO') }} :
                                <span class="fw-bolder">{{ $order_id }} </span>
                            </strong>
                        @endif
                        @if ($isWallet = 1)
                            <strong>
                                {{ __('Açıklama kısmına Sipariş numaranızı yazmayı unutmayın! Sipariş NO') }} : <span
                                    class="fw-bolder">{{ $order_id }} </span>
                            </strong>
                        @endif

                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($ibans as $key => $item)
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm">
                            <div
                                class="card-header bg-light border-0 rounded-2 m-1 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bolder mb-0">
                                    {{ $item['bank'] }}
                                </h5>
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal"
                                    data-bs-target="#notifyBank_{{ $key }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-bell mb-1" viewBox="0 0 16 16">
                                        <path
                                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                    </svg>
                                    {{ __('Ödeme Bildir') }}
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2">
                                    {!! $item['qrcode'] !!}
                                    <div class="d-flex flex-column gap-1 flex-fill">

                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light" id="basic-addon1">
                                                {{ __('Alıcı Adı') }}
                                            </span>
                                            <input type="text" class="form-control bg-light" value="{{ $item['name'] }}"
                                                readonly>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light" id="basic-addon1">
                                                {{ __('IBAN No') }}
                                            </span>
                                            <input type="text" class="form-control bg-light" value="{{ $item['iban'] }}"
                                                id="input_{{ $key }}" readonly>
                                            <button class="btn btn-outline-light text-dark border border-2"
                                                onclick="copyTxt('input_{{ $key }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                                    height="20">
                                                    <path fill="none" d="M0 0h24v24H0z" />
                                                    <path
                                                        d="M7 6V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1h-3v3c0 .552-.45 1-1.007 1H4.007A1.001 1.001 0 0 1 3 21l.003-14c0-.552.45-1 1.007-1H7zM5.003 8L5 20h10V8H5.003zM9 6h8v10h2V4H9v2z" />
                                                </svg>
                                                {{ __('Kopyala') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="notifyBank_{{ $key }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">
                                        {{ __('Ödeme Bildir') }}
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('bank.notify') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="bank_name" value="{{ $item['bank'] }}">
                                        <input type="hidden" name="order_id" value="{{ $order_id }}">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">
                                                {{ __('Ödeme Tutarı') }}
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    {{ config('app.currency_symbol') }}
                                                </span>
                                                <input type="number" class="form-control" id="amount" name="amount"
                                                    readonly min="1" step="0.01" value="{{ $amount }}"
                                                    disabled placeholder="{{ __('Ödeme Tutarı') }}" required>
                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <label for="date" class="form-label">
                                                {{ __('Ödeme Tarihi') }}
                                            </label>
                                            <input type="datetime-local" class="form-control" name="datetime"
                                                placeholder="{{ __('Ödeme Tarihi') }}" required
                                                value="{{ now() }}">
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Ödeme Bildir') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
@push('js')
    <script>
        function copyTxt(input_id) {
            var text = document.getElementById(input_id).select();
            document.execCommand('copy');

        }
    </script>
@endpush
