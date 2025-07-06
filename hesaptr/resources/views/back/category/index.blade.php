@extends('back.layouts.app')
@push('title', __('Categories'))
@section('content')
<div class="row mb-3">
    <div class="col-lg-7 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list"
                    viewBox="0 1 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
                {{ __('Category List') }}
            </div>
            <div class="card-body m-1 p-1">
                @foreach ($categories as $category)
                <div class=" p-1 rounded-3 mb-2 d-flex align-items-center">
                    <img width="36" src="{{ asset($category['img']) }}" class="img-fluid me-2">
                    #{{ $category['id'] }} <strong class="ms-1">{{ $category['name'] }}</strong>
                    @if($category['description'])
                    <span class="ms-2 text-muted" data-bs-title="{{$category['description'] }}" data-bs-toggle="tooltip">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </svg>
                    </span>
                    @endif
                    <div class="ms-auto">
                        <a target="_blank" class="btn btn-sm btn-outline-secondary border-0" href="{{route('category',['slug'=>$category->slug])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-eye" viewBox="0 0 16 16">
                                <path
                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                <path
                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                            </svg>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="modal"
                            data-bs-target="#edit_modal" data-bs-id="{{ $category['id'] }}"
                            data-bs-name="{{ $category['name'] }}" data-bs-slug="{{ $category['slug'] }}"
                            data-bs-description="{{ $category['description'] }}"
                            data-bs-keywords="{{ $category['meta_keywords'] }}"
                            data-bs-img="{{ asset($category['img']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>
                        <button class="btn btn-sm btn-outline-danger border-0"
                            onclick="delete_form({{ $category['id'] }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd"
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-lg mb-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                </svg>
                {{ __('Add Category') }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>{{ __('Name') }}*</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" max="255"
                            onchange="document.getElementById('input_slug').value = slugify(this.value);"
                            required>
                    </div>
                    <label>{{ __('Seo URL') }}*</label>
                    <div class="input-group mb-3">
                        <input id="input_slug" type="text" class="form-control" name="slug" max="300" required
                            placeholder="{{ __('If left blank, it will be created automatically.') }}">
                    </div>
                    <label>{{ __('Description') }}</label>
                    <div class="input-group mb-3">
                        <input class="form-control" name="description" max="255">
                    </div>
                    <label>{{ __('Icon Image') }}* ({{ __('Auto Resize') }}: 100x100)</label>
                    <input class="form-control"
                        onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])"
                        name="img" type="file" id="formFile" accept=".png, .jpg, .jpeg, .webp, .gif, .bmp" required>
                    <img id="img" width="50" class="img-fluid mb-1  " src="">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-lg mb-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                            </svg>
                            {{ __('Add Category') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ __('Edit Category') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.categories.update') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <label>{{ __('Name') }}*</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" max="255"
                            onchange="document.getElementById('input_slug2').value = slugify(this.value);"
                            required>
                    </div>
                    <label>{{ __('Seo URL') }}*</label>
                    <div class="input-group mb-3">
                        <input id="input_slug2" type="text" class="form-control" name="slug" max="300" required
                            placeholder="{{ __('If left blank, it will be created automatically.') }}">
                    </div>
                    <label>{{ __('Description') }}</label>
                    <div class="input-group mb-3">
                        <input class="form-control" name="description" max="255">
                    </div>
                    <label>{{ __('Icon Image') }} ({{ __('Auto Resize') }}: 100x100)</label>
                    <input class="form-control"
                        onchange="document.getElementById('img2').src = window.URL.createObjectURL(this.files[0])"
                        name="img" type="file" id="formFile" accept=".png, .jpg, .jpeg, .webp, .gif, .bmp">
                    <img id="img2" width="40" class="img-fluid mb-" src="">

                    <div class="col">
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
        </div>
    </div>
</div>
<form method="POST" action="{{ route('admin.categories.destroy') }}" id="admin_category_destroy">
    @csrf
    <input type="hidden" id="input_id" value="" name="id">
</form>
@endsection
@push('js')
<script>
    const edit_modal = document.getElementById('edit_modal')
        edit_modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget
            const id = button.getAttribute('data-bs-id')
            const name = button.getAttribute('data-bs-name')
            const slug = button.getAttribute('data-bs-slug')
            const description = button.getAttribute('data-bs-description')
            const img = button.getAttribute('data-bs-img')

            edit_modal.querySelector('.modal-body input[name="id"]').value = id
            edit_modal.querySelector('.modal-body input[name="name"]').value = name
            edit_modal.querySelector('.modal-body input[name="slug"]').value = slug
            edit_modal.querySelector('.modal-body input[name="description"]').value = description

            edit_modal.querySelector('.modal-body #img2').src = img
        });

        function delete_form(id) {
            Swal.fire({
                title: "{{ __('Are you sure? Products related to the category will be deleted.') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                cancelButtonText: "{{ __('No, cancel!') }}",

            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('input_id').value = id
                    document.getElementById('admin_category_destroy').submit()
                }
            })
        }
</script>
@endpush
