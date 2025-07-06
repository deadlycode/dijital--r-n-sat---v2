@extends('back.layouts.app')
@push('title', __('Ödeme Bildirimleri'))
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@endpush
@section('content')
    <div class="row">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between">
                {{ __('Ödeme Bildirimleri') }}
                <button class="btn btn-sm btn-danger text-white" onclick="deleteFormAll()">
                    <i class="bi bi-trash"></i>
                    {{ __('Tüm Bildirimleri Sil') }}
                </button>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>
                                #ID
                            </th>
                            <th>
                                {{ __('Sipariş NO') }}
                            </th>
                            <th>
                                {{ __('Kullanıcı ID') }}
                            </th>
                            <th>
                                {{ __('Açıklama') }}
                            </th>

                            <th>
                                {{ __('Tutar') }}
                            </th>
                            <th>
                                {{ __('Banka') }}
                            </th>
                            <th>
                                {{ __('Ödeme Tarihi') }}
                            </th>
                            <th>
                                {{ __('İşlem') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payment_notifications as $item)
                            <tr class="align-middle">
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->order_id }}
                                </td>
                                <td>
                                    @if ($item->user_id)
                                        {{ $item->user_id }}
                                    @else
                                        {{ __('Misafir') }}
                                    @endif
                                    <br>
                                    @php
                                        $order_url = url('/order-details?order_id=' . $item->order_id . '&email=' . json_decode($item->billing_details)->email);
                                    @endphp

                                    <a class="btn btn-sm btn-success text-white" target="_blank"
                                        href="https://api.whatsapp.com/send?phone=9{{ json_decode($item->billing_details)->phone }}&text={{ urlencode($order_url) }}">
                                        {{ __('WhatsApp Bildirim Gönder') }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item->description }}
                                </td>


                                <td>
                                    {{ config('app.currency_symbol') }} {{ money($item->amount) }}
                                </td>
                                <td>
                                    {{ $item->bank_name }}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success text-white"
                                        onclick="confirmForm({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                            <path
                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                                        </svg>
                                    </button>
                                    <button class="btn btn-sm btn-danger text-white"
                                        onclick="deleteForm({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.payment_notifications_deleteAll') }}" method="POST" id="deleteFormAll">
        @csrf

    </form>
    <form action="{{ route('admin.payment_notifications_confirm') }}" method="POST" id="confirmForm">
        @csrf
        <input type="hidden" name="id" id="id">
    </form>
    <form action="{{ route('admin.payment_notifications_delete') }}" method="POST" id="deleteForm">
        @csrf
        <input type="hidden" name="id" id="id">
    </form>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
        integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    <script>
        let table = new DataTable('#myTable', {
            responsive: true,
            paging: false,
            order: [],
            scrollY: '50vh',
            scrollCollapse: true,
        });
    </script>
    <script>
        function deleteFormAll() {
            Swal.fire({
                title: "{{ __('Tüm bildirimleri silmek istediğinize emin misiniz ?') }}",
                text: "{{ __('Bu işlem geri alınamaz!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Evet, Sil') }}",
                cancelButtonText: "{{ __('Hayır, İptal') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    form = document.getElementById('deleteFormAll');
                    form.submit();
                }
            })
        }

        function deleteForm(id) {
            Swal.fire({
                title: "{{ __('Silmek istediğinize emin misiniz ?') }}",
                text: "{{ __('Bu işlem geri alınamaz!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Evet, Sil') }}",
                cancelButtonText: "{{ __('Hayır, İptal') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    form = document.getElementById('deleteForm');
                    form.querySelector('input[name="id"]').value = id;
                    form.submit();
                }
            })
        }

        function confirmForm(id) {
            Swal.fire({
                title: "{{ __('Onaylamak istediğinize emin misiniz ?') }}",
                text: "{{ __('Bu işlem geri alınamaz!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Evet, Onayla') }}",
                cancelButtonText: "{{ __('Hayır, İptal') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    form = document.getElementById('confirmForm');
                    form.querySelector('input[name="id"]').value = id;
                    form.submit();
                }
            })
        }
    </script>
@endpush
