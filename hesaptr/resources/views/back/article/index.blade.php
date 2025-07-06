@extends('back.layouts.app')
@push('title', __('Articles'))
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header d-flex align-items-center justify-content-between bg-white">
                <span>
                    {{ __('Articles') }}
                </span>
                <a href="{{ route('admin.article.create') }}" class="btn btn-outline-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg mb-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg>
                    {{ __('Add New Article') }}
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm align-middle table-bordered" id="myTable">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Description') }}</th>
                                <th scope="col">{{ __('Seo URL') }}</th>
                                <th scope="col">{{ __('Updated At') }}</th>
                                <th>
                                    {{ __('Action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                            <tr>
                                <td>
                                    {{ $article->id }}
                                </td>
                                <td>
                                    {{ $article->name }}
                                </td>
                                <td>
                                    {{ $article->description }}
                                </td>
                                <td>
                                    <a target="_blank" href="{{ route('article',['slug' => $article->slug]) }}">
                                        {{ route('article',['slug' => $article->slug]) }}
                                    </a>
                                </td>
                                <td>
                                    {{ $article->updated_at }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.article.edit', $article->id) }}"
                                        class="btn btn-sm btn-outline-primary border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger border-0"
                                        onclick="delete_form({{ $article->id }})">
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
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
<form method="POST" action="{{ route('admin.article.delete') }}" id="admin_article_delete">
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
            info: false,
            responsive: true,
            order : []
        });
});
</script>
<script>
    function delete_form(id) {
            Swal.fire({
                title: '{{ __('Are you sure?') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                cancelButtonText: "{{ __('No') }}",

            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('input_id').value = id
                    document.getElementById('admin_article_delete').submit()
                }
            })
        }
</script>
@endpush
