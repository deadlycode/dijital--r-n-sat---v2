@extends('front.layouts.app')
@push('title', '404')
@push('description', '404')
@section('content')
<div class="container">
    <div class="px-4 pt-5 my-5 text-center border-bottom">
        <h1 class="display-4 fw-bold">404 - Sayfa Bulunamadı</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">
                {{ __('Page not found')}}
            </p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                <a href="{{route('index')}}" class="btn btn-primary btn-lg px-4 me-sm-3">
                    {{ __('Go to home page')}}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
