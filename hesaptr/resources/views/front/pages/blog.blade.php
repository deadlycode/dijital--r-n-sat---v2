@extends('front.layouts.app')
@push('title', 'Blog')
@section('content')
<section class="py-4 bg-light blog">
    <div class="container">
        <div class="page-header mb-3 d-flex align-items-center justify-content-between">
            <h2 class="page-title h3 mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                    class="bi bi-pencil-square mb-1" viewBox="0 0 16 16">
                    <path
                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd"
                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                </svg>
                {{ __('Blog') }} 
            </h2>
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
                        <small> {{__('Blog')}} </small>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="row g-3 row-articles">
            @foreach ($articles as $article)
            <div class="col-md-4 d-flex align-items-stretch article-card ">
                <div class="card" style="background-image: url('{{ asset($article->img) }}'); background-size:cover;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('article', ['slug' => $article->slug]) }}">
                                {{ $article->name }}
                            </a>
                        </h5>
                        <p class="card-text">
                            {{ $article->descipription }}
                        </p>
                        <div class="read-more">
                            <a href="{{ route('article', ['slug' => $article->slug]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-right" viewBox="0 1 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                </svg>
                                {{ __('Read more') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $articles->links() }}
        </div>
    </div>
</section>
@endsection