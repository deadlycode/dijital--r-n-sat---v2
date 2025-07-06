@extends('front.layouts.app')
@push('title', $category->name)
@section('content')
<section class="py-2 bg-light">
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center mb-1 scrollable-x">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-1 text-muted d-flex align-items-center scrollable-x"
                                style="width: max-content; -webkit-overflow-scrolling:touch">
                                <li class="breadcrumb-item small">
                                    <a href="/" class="link-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-house-fill mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                                            <path
                                                d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                                        </svg>
                                        {{ __('Homepage') }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item small active" aria-current="page">
                                    {{ $category->name }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="bg-white rounded-4 p-3 shadow-sm">
                    <div class="page-title d-flex align-items-center flex-wrap mb-1 ">
                        <img loading="lazy" class="rounded-circle me-2" src="{{ asset($category->img) }}"
                            alt="{{ $category->name }}" style="width: 32px; height: 32px;">
                        <h1 class="fw-bold mb-0 h3">
                            {{ $category->name }}
                        </h1>
                    </div>
                    <span class="text-muted small text-opacity-75">
                        {{ $category->description }}
                    </span>
                    <div class="d-flex  justify-content-between align-items-center page-header p-0 m-0">
                        <small>
                            {{ __('Total Products:') }} {{ $total_products }}
                        </small>
                        <div class="mb-1" style="max-width:60%;">
                            <select class="form-select" onchange="window.location.href = '{{ route('category',['slug'=>$category->slug]) }}'+'/'+this.value">
                                <option value="">{{__('Short By')}}</option>
                                <option @if(request()->short == 'discount') selected @endif value="discount">{{__('Discount Rate')}}</option>
                                <option @if(request()->short == 'price-asc') selected @endif value="price-asc">{{__('Price: Low to High')}}</option>
                                <option @if(request()->short == 'price-desc') selected @endif value="price-desc">{{__('Price: High to Low')}}</option>
                                <option @if(request()->short == 'best-sellers') selected @endif value="best-sellers">{{__('Best Sellers') }}</option>
                                <option @if(request()->short == 'most-viewed') selected @endif value="most-viewed">{{__('Most Viewed') }}</option>
                         </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($products->count() > 0)
        @include('front.partials.product')


        {{ $products->links() }}
        @else
        <div class="row mb-3 ">
            <div class="col-lg-12">
                <div class="bg-white rounded-3 p-3 shadow-sm py-5">
                    <h1 class="page-title text-center">
                        {{ __('No product') }}...
                    </h1>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
