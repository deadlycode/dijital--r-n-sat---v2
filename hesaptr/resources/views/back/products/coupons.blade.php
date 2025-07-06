@extends('back.layouts.app')
@push('title', __('Coupons'))
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
@endpush
@section('content')
<div class="row mb-3">
    <div class="col-lg-8 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gift"
                    viewBox="0 0 16 16">
                    <path
                        d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
                </svg>
                {{ __('Coupons') }}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm align-middle table-bordered" id="myTable">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Discount') }}</th>
                                <th>{{ __('Min Price Limit') }}</th>
                                <th>{{ __('Used') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->id }}</td>
                                <td>
                                    {{ $coupon->code }}
                                </td>
                                <td>
                                    {{ config('app.currency_symbol') }}{{ money($coupon->discount) }}
                                </td>
                                <td>
                                    {{ config('app.currency_symbol') }}{{ money($coupon->min_price_limit) }}
                                </td>
                                <td>
                                    {{ $coupon->used }}
                                </td>
                                <td>
                                    {{ $coupon->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    <button onclick="destroy({{ $coupon->id }})"
                                        class="btn btn-sm btn-outline-danger border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
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
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gift"
                    viewBox="0 0 16 16">
                    <path
                        d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
                </svg>
                {{ __('Add Coupon') }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.coupons.store') }}" method="POST">
                    @csrf
                    <label>{{ __('Code') }}*</label>
                    <div class="input-group mb-3">
                        <input required type="text" class="form-control" name="code" max="255">
                    </div>
                    <label>{{ __('Max Usage Limit') }}*</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="number" name="max_used" value="1" min="1">
                    </div>
                    <label>{{ __('Discount Price') }}*</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white">
                            {{ config('app.currency_symbol') }}
                        </span>
                        <input class="form-control" type="number" name="discount" min="1" step="0.01" value="1">
                    </div>
                    <label>{{ __('Min Price Limit') }}*</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white">
                            {{ config('app.currency_symbol') }}
                        </span>
                        <input class="form-control" type="number" name="min_price_limit" min="1" step="0.01" value="1">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-cloud-arrow-up" viewBox="0 1 16 16">
                                <path fill-rule="evenodd"
                                    d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z" />
                                <path
                                    d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
                            </svg>
                            {{ __('Add Coupon') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.products.coupons.destroy') }}" id="admin_coupons_destroy">
    @csrf
    <input type="hidden" id="input_id" value="" name="id">
</form>
@endsection
@push('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let table = new DataTable('#myTable', {
            paging: false,
            fixedHeader: true,
            responsive: true,
            order : []
        });
});
</script>
<script>
    function destroy(id) {
            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                cancelButtonText: "{{ __('No, cancel!') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('input_id').value = id
                    document.getElementById('admin_coupons_destroy').submit()
                }
            })
        }
</script>
@endpush