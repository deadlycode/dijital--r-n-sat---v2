@extends('back.layouts.app')
@push('title', __('Contacts'))
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header  bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-envelope-check mb-1" viewBox="0 0 16 16">
                    <path
                        d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
                    <path
                        d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z" />
                </svg>
                {{ __('Contacts') }}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm align-middle table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Subject') }}</th>
                                <th scope="col">{{ __('Message') }}</th>
                                <th scope="col">{{ __('Date') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($contacts as $contact)
                            <tr data-id="{{$contact->id}}">
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>
                                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                </td>
                                <td>
                                    {{ $contact->subject }}
                                </td>
                                <td>
                                    {{ $contact->message }}
                                </td>
                                <td>
                                    {{ $contact->created_at }}
                                </td>
                                <td>
                                    <a onclick="delete_form({{ $contact->id }})"
                                        class="btn btn-outline-danger border-0 btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</div>
<form method="POST" action="{{ route('admin.page.contacts.delete') }}" id="admin_contacts_delete">
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
                title: "{{ __('Are you sure?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                cancelButtonText: "{{ __('No') }}",

            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('input_id').value = id
                    document.getElementById('admin_contacts_delete').submit()
                }
            })
        }
</script>
@endpush