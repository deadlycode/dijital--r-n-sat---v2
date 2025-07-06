@extends('front.layouts.app')
@push('title', $page->name)
@push('meta_description', $page->description)
@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-1">
                <div class="page-header d-flex align-items-center justify-content-between flex-wrap mb-3">
                    <div class="d-flex flex-column">
                        <h1 class="h3 page-title mb-0">
                            {{ $page->name }}
                        </h1>
                    </div>
                    <nav aria-label="breadcrumb" style="overflow: auto;">
                        <ol class="breadcrumb my-1" style="width: max-content; -webkit-overflow-scrolling:touch">
                            <li class="breadcrumb-item small">
                                <a href="/" class="link-secondary small">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-house-fill " viewBox="0 1 16 16">
                                        <path fill-rule="evenodd"
                                            d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                        <path fill-rule="evenodd"
                                            d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <small>{{$page->name}}</small>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
           
            <div class="col-lg-12">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</section>
@endsection