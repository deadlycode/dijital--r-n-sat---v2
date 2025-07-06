@extends('back.layouts.app')
@push('title', __('All Orders'))
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white d-flex  align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag mb-1" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg>
                            {{ __('Orders') }}
                        </span>
                        <span class="badge bg-secondary">{{ $orders->count() }}</span>
                    </div>
                    <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-light ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-bag mb-1" viewBox="0 0 16 16">
                        <path
                            d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                    </svg>
                        {{__('All Orders')}}
                    </a>
                    <a href="{{ route('admin.orders',['wallet' => 1]) }}" class="btn btn-sm btn-light ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                            <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                          </svg>
                        {{__('Wallets')}}
                    </a>
                    <a class="btn btn-sm btn-outline-primary ms-auto" href="{{ route('admin.order.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-lg" viewBox="0 1 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                        {{ __('Add New Order') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm align-middle table-bordered" id="myTable">
                            <thead>
                                <tr class="">
                                    <th scope="col">#ID</th>
                                    <th scope="col">{{ __('Customer') }}</th>
                                    <th scope="col">{{ __('Product') }}</th>
                                    <th scope="col">{{ __('Quantity') }}</th>
                                    <th scope="col">{{ __('Total') }}</th>
                                    <th scope="col">{{ __('Note') }}</th>
                                    <th scope="col">{{ __('Payment') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Date') }}</th>
                                    <th scope="col">{{ __('Stock') }}</th>
                                    <th scope="col">{{ __('Answers') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr data-id="{{ $order->id }}">
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal"
                                                data-bs-target="#customer_info_{{ $order->id }}">
                                                {{ json_decode($order->billing_details)->email }}
                                            </button>
                                            <div class="modal fade" id="customer_info_{{ $order->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title d-flex align-items-center">
                                                                {{ __('Billing Details') }}
                                                                @if ($order->user_id)
                                                                    <a target="_blank" class="btn btn-sm btn-light ms-3"
                                                                        href="{{ route('admin.users.edit', ['id' => $order->user_id]) }}">
                                                                        {{ __('Edit') }}
                                                                    </a>
                                                                @else
                                                                    <span class="badge bg-secondary ms-3">
                                                                        {{ __('Guest') }}
                                                                    </span>
                                                                @endif
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row g-1">
                                                                <div class="col-6">
                                                                    <p>
                                                                        <strong>
                                                                            {{ __('Name') }}:
                                                                        </strong>
                                                                    </p>
                                                                    <p>
                                                                        <strong>
                                                                            {{ __('Surname') }}:
                                                                        </strong>
                                                                    </p>
                                                                    <p>
                                                                        <strong>
                                                                            {{ __('Phone') }}:
                                                                        </strong>
                                                                    </p>
                                                                    <p>
                                                                        <strong>
                                                                            {{ __('Email') }}:
                                                                        </strong>
                                                                    </p>
                                                                    <p>
                                                                        <strong>
                                                                            {{ __('IP Address') }}:
                                                                        </strong>
                                                                    </p>
                                                                    <p>
                                                                        <strong>
                                                                            {{ __('User ID') }}:
                                                                        </strong>
                                                                    </p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p>
                                                                        {{ json_decode($order->billing_details)->name }}
                                                                    </p>
                                                                    <p>
                                                                        {{ json_decode($order->billing_details)->surname }}
                                                                    </p>
                                                                    <p>
                                                                        <a title="{{ __('Whatsapp') }}"
                                                                            href="https://api.whatsapp.com/send?phone={{ json_decode($order->billing_details)->phone }}">
                                                                            {{ json_decode($order->billing_details)->phone }}
                                                                        </a>
                                                                    </p>
                                                                    <p>
                                                                        <a title="{{ __('Send Email') }}"
                                                                            href="mailto:{{ json_decode($order->billing_details)->email }}">
                                                                            {{ json_decode($order->billing_details)->email }}
                                                                        </a>
                                                                    </p>
                                                                    <p>
                                                                        {{ json_decode($order->billing_details)->ip }}
                                                                    </p>
                                                                    <p>
                                                                        {{ $order->user_id }}
                                                                    </p>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ json_decode($order->product)->name }}
                                        </td>
                                        <td>
                                            {{ json_decode($order->product)->qty }}
                                        </td>
                                        <td>
                                            {{ config('app.currency_symbol') }} {{ money($order->total) }}
                                        </td>
                                        <td>
                                            @if ($order->note)
                                                <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal"
                                                    data-bs-target="#note_modal_{{ $order->id }}">Detay</button>
                                            @else
                                                -
                                            @endif
                                            <div class="modal fade" id="note_modal_{{ $order->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                {{ __('Note') }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                {{ $order->note }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $order->payment_method }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $order->order_status }}
                                        </td>
                                        <td class="date">
                                            {{ $order->created_at->format('d.m.Y H:i') }}
                                        </td>
                                        <td>
                                            <div
                                                class="d-flex flex-column align-items-center justify-content-between gap-2">
                                                @if ($order->stocks)
                                                    <span class="badge bg-success d-flex align-items-center">
                                                        {{ count(json_decode($order->stocks, true)) }}
                                                        {{ __('in stock') }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('No Stock') }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if($order->customer_answers)
                                            <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal"
                                                data-bs-target="#customer_answers{{ $order->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M14.854 4.854a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H3.5A2.5 2.5 0 0 0 1 6.5v8a.5.5 0 0 0 1 0v-8A1.5 1.5 0 0 1 3.5 5h9.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4z"/>
                                                  </svg>
                                                {{ __('Customer Answers') }}
                                            </button>
                                            <div class="modal fade" id="customer_answers{{ $order->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title d-flex align-items-center">
                                                                {{ __('Customer Answers') }}
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
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                <a class="btn btn-outline-primary border-0"
                                                    href="{{ route('admin.order.edit', ['id' => $order->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </a>
                                                <button onclick="delete_form({{ $order->id }})"
                                                    class="btn btn-sm btn-outline-danger border-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="">
                                    <th scope="col">#ID</th>
                                    <th scope="col">{{ __('Customer') }}</th>
                                    <th scope="col">{{ __('Product') }}</th>
                                    <th scope="col">{{ __('Quantity') }}</th>
                                    <th scope="col">{{ __('Total') }}</th>
                                    <th scope="col">{{ __('Note') }}</th>
                                    <th scope="col">{{ __('Payment') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Date') }}</th>
                                    <th scope="col">{{ __('Stock') }}</th>
                                    <th scope="col">{{ __('Answers') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>

    </div>
    <form method="POST" action="{{ route('admin.order.cancel') }}" id="admin_order_cancel">
        @csrf
        <input type="hidden" id="input_id_cancel" name="id" value="">
    </form>
    <form method="POST" action="{{ route('admin.order.delete') }}" id="delete_form">
        @csrf
        <input type="hidden" id="input_id" name="id" value="">
    </form>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let table = new DataTable('#myTable', {
                paging: false,
                info: false,
                fixedHeader: true,
                responsive: true,
                order: []
            });
        });
    </script>

    <script>
        function delete_form(id) {
            Swal.fire({
                title: "{{ __('Are you sure ? stocks will be added to the product if any') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                cancelButtonText: "{{ __('No') }}",

            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('input_id').value = id
                    document.getElementById('delete_form').submit()
                }
            })
        }

        function cancel_form(id) {
            Swal.fire({
                title: 'Siparişi iptal etmek istediğinize misiniz? Stok varsa stoklar tekrar ürüne yüklenir! Bu işlem geri alınamaz!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eminim İptal Et!',
                cancelButtonText: 'Etme'

            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('input_id_cancel').value = id
                    document.getElementById('admin_order_cancel').submit()
                }
            })
        }
    </script>
@endpush
