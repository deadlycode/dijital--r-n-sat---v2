@extends('back.layouts.app')
@push('title', __('Footer Menu'))
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between bg-white">
                {{ __('Footer Menu') }}
                <a class="btn btn-outline-secondary btn-sm" href="{{route('admin.settings.footer_menu.add')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg mb-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg>
                    {{ __('Add Footer Menu Item') }}
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.footer_menu_column_update') }}" method="post">
                    @csrf
                    <div class="row g-1">
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="footer_menu_column1" placeholder="Column 1 Name" value="{{ Cache::get('footer_menu_column1') }}">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="footer_menu_column2" placeholder="Column 2 Name" value="{{ Cache::get('footer_menu_column2') }}">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="footer_menu_column3" placeholder="Column 3 Name" value="{{ Cache::get('footer_menu_column3') }}">
                        </div>
                        <div class="col-lg-2">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z" />
                                        <path
                                            d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
                                    </svg>
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>
                                    {{ __('Column') }}
                                </th>
                                <th>
                                    {{ __('Name') }}
                                </th>
                                <th>
                                    {{ __('Url') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($footer_menu as $footer_menu_item)
                            <tr>
                                <td>{{ $footer_menu_item->id }}</td>
                                <td>{{ $footer_menu_item->column }}</td>
                                <td>{{ $footer_menu_item->name }}</td>
                                <td>{{ $footer_menu_item->url }}</td>
                                <td>
                                    <button onclick="delete_form({{$footer_menu_item->id}})"
                                        class="btn btn-sm btn-outline-danger border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
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
</div>
<form action="{{ route('admin.settings.footer_menu.delete') }}" id="admin_footer_menu_delete" method="POST">
    @csrf
    <input type="hidden" id="input_id" name="footer_menu_id" value="">
</form>
@endsection
@push('js')
<script>
    function delete_form(id) {
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
                    document.getElementById('admin_footer_menu_delete').submit()
                }
            })
        }
</script>
@endpush