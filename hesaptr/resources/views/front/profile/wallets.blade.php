@extends('front.layouts.app')
@push('title', __('Wallet History'))
@section('content')
@include('front.profile.header')
<section class="py-2 bg-light">
    <div class="container">
        @if ($wallet->count() > 0)
        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-borderless align-middle">
                        <thead class="table-light align-middle text-center">
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">
                                    {{ __('Amount Paid') }}
                                </th>
                                <th scope="col">
                                    {{ __('Payment Method') }}
                                </th>
                                <th scope="col">
                                    {{ __('Date') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="align-middle text-center">
                            @foreach ($wallet as $key => $item)
                            <tr>
                                <th scope="row">
                                    {{ $item->order_id }}
                                </th>
                                <td>
                                    {{config('app.currency_symbol')}}{{ money($item->total) }}
                                </td>
                                <td>
                                    {{ $item->payment_method ?? __('-') }}
                                </td>
                                <td>
                                    {{ $item->created_at->format('d M, Y H:i') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                {{ $wallet->links() }}
            </div>
        </div>
        @else
        <div class="row mb-3 ">
            <div class="col-lg-12">
                <div class="bg-white rounded-3 p-3 shadow-sm py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <strong class="mb-3">
                            {{ __('No wallet history found.') }}
                        </strong>
                        <a class="btn btn-outline-light btn-lg text-dark rounded-3 col-lg-3" data-bs-toggle="modal"
                            data-bs-target="#balanceModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-database-fill-add mb-1" viewBox="0 0 16 16">
                                <path
                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0ZM8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1Z" />
                                <path
                                    d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12.31 12.31 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7Zm6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.552 4.552 0 0 1 .23-2.002Zm-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.507 4.507 0 0 1-1.3-1.905Z" />
                            </svg>
                            {{ __('Add Money') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
