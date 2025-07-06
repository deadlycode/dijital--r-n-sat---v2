@extends('front.layouts.app')
@push('title', __('My Orders'))
@section('content')
@include('front.profile.header')
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if ($orders->count() > 0)
                @foreach ($orders as $order)
                <div class="card border-0 shadow-sm mb-3 rounded-4">
                    <div class="card-header bg-white m-1 p-1">
                        <div class="d-flex align-items-center">
                            #{{__('OrderID')}}: {{ $order->order_id }}
                            @if($order->order_status)
                            <span class="badge bg-primary ms-2">
                                {{ $order->order_status }}
                            </span>
                            @endif
                            @if($order->payment_status == 1)
                            <form method="POST" action="{{ route('download') }}" class="ms-auto">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                @if ($order->file)
                                <button type="submit" name="file" name="type" value="zip"
                                    class="btn btn-sm btn-outline-light text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-download mb-1" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                    </svg>
                                    {{ __('Download File') }}
                                </button>
                                @endif
                                @if ($order->file_url)
                                    <a target="_blank" href="{{$order->file_url}}" class="btn btn-sm btn-outline-light text-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-download mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                            <path
                                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                        </svg>
                                        {{ __('Download File') }}
                                    </a>
                                @endif
                                @if ($order->stocks)
                                <button type="submit" name="type" value="txt"
                                    class="btn btn-sm btn-outline-light text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-download mb-1" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                    </svg>
                                    {{ __('Download(.txt)') }}
                                </button>
                                @endif
                            </form>
                            @endif
                        </div>
                    </div>
                    @if($order->payment_status == 1)
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between">
                                <strong>
                                    {{ json_decode($order->product)->qty }} x {{ json_decode($order->product)->name }}
                                    ({{config('app.currency_symbol')}}{{$order->total}})
                                    @if($order->customer_answers)
                                    <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal"
                                        data-bs-target="#customer_answers{{ $order->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M14.854 4.854a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H3.5A2.5 2.5 0 0 0 1 6.5v8a.5.5 0 0 0 1 0v-8A1.5 1.5 0 0 1 3.5 5h9.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4z"/>
                                          </svg>
                                        {{ __('Answers') }}
                                    </button>
                                    <div class="modal fade" id="customer_answers{{ $order->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title d-flex align-items-center">
                                                        {{ __('Answers') }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-1">
                                                        <div class="col-6">
                                                            @foreach(json_decode($order->customer_answers, true) as $item)
                                                                <p>
                                                                    <strong>
                                                                        {{ $item['question'] }} :
                                                                    </strong>
                                                                </p>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-6">
                                                            @foreach(json_decode($order->customer_answers, true) as $item)
                                                                <p>
                                                                        {{ $item['answer'] }}
                                                                </p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </strong>
                                <small>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-clock-history mb-1" viewBox="0 0 16 16">
                                        <path
                                            d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                        <path
                                            d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div class="row g-1">
                                @if ($order->stocks)
                                @foreach (json_decode($order->stocks) as $key => $stock)
                                <div class="col-lg-3">
                                    <div class="input-group input-group-sm mt-2">
                                        <input type="text" class="form-control bg-light" value="{{ $stock }}" readonly id="input_{{$key}}">
                                        <button class="btn btn-outline-light text-dark border border-2" onclick="copyTxt('input_{{ $key }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                                height="20">
                                                <path fill="none" d="M0 0h24v24H0z" />
                                                <path
                                                    d="M7 6V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1h-3v3c0 .552-.45 1-1.007 1H4.007A1.001 1.001 0 0 1 3 21l.003-14c0-.552.45-1 1.007-1H7zM5.003 8L5 20h10V8H5.003zM9 6h8v10h2V4H9v2z" />
                                            </svg>
                                            {{__('Copy')}}
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
                {{ $orders->links() }}
                @else
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <strong class="mb-3">
                                    {{ __('No orders yet.') }}
                                </strong>
                                <a class="btn btn-outline-light btn-lg text-dark rounded-3 col-lg-3" href="/">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-shop mb-1" viewBox="0 0 16 16">
                                        <path
                                            d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                                    </svg>
                                    {{ __('Go to shop') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
</section>
@endsection
@push('js')
<script>
    function copyTxt(input_id) {
            var text = document.getElementById(input_id).select();
            document.execCommand('copy');

        }
</script>
@endpush
