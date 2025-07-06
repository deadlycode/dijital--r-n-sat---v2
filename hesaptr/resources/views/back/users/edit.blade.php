@extends('back.layouts.app')
@push('title', $user->name)
@section('content')
<form action="{{ route('admin.users.update') }}" method="POST" autocomplete="off">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}">
    <div class="row g-3">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <span>
                        {{ __('Edit User') }} "{{ __($user->name) }}"
                    </span>
                </div>
                <div class="card-body pb-1">
                    <div class="row g-1">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label>{{ __('Name') }}*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" max="255" required
                                        value="{{$user->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label>{{ __('Email') }}*</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" max="255" required
                                        value="{{$user->email}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label>{{ __('Password') }}*</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" max="255"
                                        value="" autocomplete="new-password" >
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label>{{ __('Role') }}*</label>
                                <div class="input-group">
                                    <select name="role" class="form-control">
                                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label>{{ __('Status') }}*</label>
                                <div class="input-group">
                                    <select name="ban" class="form-control">
                                        <option value="0" {{ $user->ban == 0 ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ $user->ban == 1 ? 'selected' : '' }}>Banned</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label>{{ __('Wallet') }}*</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        {{ config('app.currency_symbol') }}
                                    </span>
                                    <input type="number" class="form-control" name="wallet" step="0.01" required value="{{$user->wallet}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-center">
                        <div class="d-grid col-lg-3">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cloud-arrow-up" viewBox="0 1 16 16">
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
            </div>
        </div>
    </div>
</form>
@endsection
