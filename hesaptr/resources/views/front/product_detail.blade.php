@extends('front.layouts.app')
@push('title', $product->name)
@push('description', $product->description)
@if ($product->img)
    @push('og_image', asset($product->img))
@else
    @push('og_image', asset($product->category->img))
@endif
@section('content')
    <div class="icon-bar d-none d-md-block  bg-white">
        @include('front.partials.share')
    </div>
    <section class="py-3">
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
                                    <li class="breadcrumb-item small">
                                        <a href="{{ route('category', ['slug' => $product->category->slug]) }}"
                                            class="link-secondary">
                                            {{ $product->category->name }}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item small active" aria-current="page">
                                        {{ $product->name }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 d-flex align-items-center mb-3">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="card border-0 shadow-sm rounded-4 ">
                        @if ($product->sliders)
                            @push('css')
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
                            @endpush
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper mb-3">
                                    @foreach (json_decode($product->sliders, true) as $slider)
                                        <div class="swiper-slide">
                                            <img class="img-fluid rounded-3 mb-2" loading="lazy" src="{{ asset($slider) }}"
                                                alt="{{ $product->name }}" title="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            @push('js')
                                <!-- Swiper JS -->
                                <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
                                <script>
                                    var swiper2 = new Swiper(".mySwiper", {
                                        spaceBetween: 1,
                                        slidesPerView: 1,
                                        loop: true,
                                        pagination: {
                                            el: ".swiper-pagination",
                                            clickable: true,
                                            dynamicBullets: true,
                                        },
                                        navigation: {
                                            nextEl: ".swiper-button-next",
                                            prevEl: ".swiper-button-prev",
                                        },
                                    });
                                </script>
                            @endpush
                        @elseif($product->img)
                            <div class="px-2 py-3">
                                <img src="{{ asset($product->img) }}" class="card-img-top rounded-4"
                                    alt="{{ $product->name }}">
                            </div>
                        @else
                            <div class="p-3 mx-auto">
                                <img style="width: 100px; height:100px" src="{{ asset($product->category->img) }}"
                                    class="card-img-top rounded-4" alt="{{ $product->name }}">
                            </div>
                        @endif
                        @if ($product->isPopular())
                            <span class="badge text-bg-primary rounded-1 border-0 mx-auto position-absolute ms-3 mt-3">
                                {{ __('Popular') }}
                            </span>
                        @endif
                        @if ($product->isBestSeller())
                            <span class="badge text-bg-danger rounded-1 border-0 mx-auto position-absolute ms-3 mt-3">
                                {{ __('Best Seller') }}
                            </span>
                        @endif
                        @if ($product->isNew())
                            <span class="badge text-bg-success rounded-1 border-0 mx-auto position-absolute ms-3 mt-3">
                                {{ __('Newest') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1">
                    <div class="card border-0 shadow-sm rounded-4 mb-2 text-center">
                        @if ($product->discount_rate)
                            <span class="rounded-4 border-0 card-center-badge badge text-bg-danger">
                                %{{ $product->discount_rate }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor"
                                    class="bi bi-gift mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
                                </svg>
                                {{ config('app.currency_symbol') }}{{ money($product->old_price - $product->price) }}
                            </span>
                        @endif
                        <div class="card-body">
                            <h2 class="mb-1 h3">
                                {{ $product->name }}
                                @if ($product->stocks->count() > 0)
                                    <h6 class="text-success">
                                        {{ __('In Stock') }} : {{ $product->stocks->count() }}
                                    </h6>
                                @endif
                            </h2>
                            @if ($product->get_properties($product->properties)->count() > 0)
                                <div class="div" style="overflow: auto;">
                                    <div class="d-flex align-items-center gap-1"
                                        style="width: max-content; -webkit-overflow-scrolling:touch">
                                        @foreach ($product->get_properties($product->properties) as $property)
                                            <span class="badge bg-light text-muted px-3">
                                                <img class="rounded-circle" style="width: 30px; height:30px; opacity: 90%"
                                                    loading="lazy" src="{{ asset($property->img) }}"
                                                    alt="{{ $property->name }}">
                                                <small class="mx-auto">
                                                    {{ $property->name }}
                                                </small>
                                                @if ($property->description)
                                                    <i class="text-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ $property->description }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                        </svg>
                                                    </i>
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center mb-3" style="cursor: default;">
                                @if ($product->old_price)
                                    <del>
                                        {{ config('app.currency_symbol') }}{{ money($product->old_price) }}
                                    </del>
                                @endif
                                <span class="h3 m-0 text-danger">
                                    {{ config('app.currency_symbol') }}{{ money($product->price) }}
                                </span>
                                <button onclick="addFavorite({{ $product->id }})"
                                    class="ms-auto btn btn-sm btn-outline-danger border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg>
                                    {{ __('Add to favorites') }}
                                </button>
                                <button id="share_btn"
                                    class="btn btn-sm btn-outline-primary border-0 ms-1 d-md-none d-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="currentColor" class="bi bi-share mb-1" viewBox="0 0 16 16">
                                        <path
                                            d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
                                    </svg>
                                    {{ __('Share') }}
                                </button>
                            </div>
                            @if ($product->description)
                                <p>
                                    {{ $product->description }}
                                </p>
                            @endif
                            <form action="{{ route('checkout') }}" method="get">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                @if ($product->customer_inputs)
                                    @foreach (explode('::', $product->customer_inputs) as $input)
                                        <div class="mb-2">
                                            <input name="customer_answers[]" type="text" class="form-control bg-light"
                                                placeholder="{{ $input }}" required>
                                        </div>
                                    @endforeach
                                @endif
                                @if($product->buy_button == 1)
                                <div class="d-flex align-items-center gap-1 mt-3">
                                    <div class="col-5">
                                        <div class="input-group border rounded-3">
                                            <button class="btn btn-light border-0" type="button" onclick="decrement()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-dash-lg mb-1" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <input type="text" class="form-control text-center border-0"
                                                name="qty" value="1" id="input_qty" required>
                                            <button class="btn btn-light text-dark border-0" type="button"
                                                id="button-increment" onclick="increment()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-plus-lg mb-1" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                     @if($product->even_if_out_of_stock == 1 || $product->stocks->count() > 0)
                                    <div class="col-7">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-danger border-0 rounded-1"
                                                id="buy_now_button">
                                                <svg class="text-white mb-1" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16"
                                                    height="16">
                                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                                    <path
                                                        d="M4 16V4H2V2h3a1 1 0 0 1 1 1v12h12.438l2-8H8V5h13.72a1 1 0 0 1 .97 1.243l-2.5 10a1 1 0 0 1-.97.757H5a1 1 0 0 1-1-1zm2 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm12 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z">
                                                    </path>
                                                </svg>
                                                <span id="buy_now_button_text">
                                                    {{ __('Buy now') }}
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-7">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-danger border-0 rounded-1" disabled>
                                                <span>
                                                    {{ __('Out of stock') }}
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </form>
                            @if ($product->whatsapp)
                                <div class="d-grid gap-2 px-2 mt-3">
                                    <a href="https://wa.me//{{ $product->whatsapp }}?text={{ route('product', $product->slug) }}"
                                        target="_blank" rel="noopener noreferrer" class="btn btn-success border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-whatsapp mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
                                            </path>
                                        </svg>
                                        <span>
                                            {{ __('Buy with Whatsapp') }}
                                        </span>
                                    </a>
                                </div>
                            @endif
                            @if ($product->demo_url || $product->admin_demo_url)
                                <hr>
                                <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                                    @if ($product->demo_url)
                                        <div class="d-grid w-100">
                                            <a class="btn btn-light" target="_blank"
                                                href="{{ route('live_preview', ['slug' => $product->slug, 'type' => 'demo']) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-display" viewBox="0 1 16 16">
                                                    <path
                                                        d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z" />
                                                </svg>
                                                {{ __('Live Preview') }}
                                            </a>
                                        </div>
                                    @endif
                                    @if ($product->admin_demo_url)
                                        <div class="d-grid w-100">
                                            <a class="btn btn-light" target="_blank"
                                                href="{{$product->admin_demo_url}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person-workspace"
                                                    viewBox="0 1 16 16">
                                                    <path
                                                        d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                    <path
                                                        d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z" />
                                                </svg>
                                                {{ __('Admin Live Preview') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <hr>
                            <div class="row g-0">
                                <div class="col-6 py-1 text-center">
                                    <div
                                        class="count d-flex flex-column d-flex align-items-center justify-content-center text-muted">
                                        <span class="fs-3">
                                            {{ $product->views_count }}
                                        </span>
                                    </div>
                                    <span class="small text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-eye" viewBox="0 1 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z">
                                            </path>
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z">
                                            </path>
                                        </svg>
                                        {{ __('Views') }}
                                    </span>
                                </div>
                                <div class="border-start col-6 py-1 text-center">
                                    <div
                                        class="count d-flex flex-column d-flex align-items-center justify-content-center text-muted">
                                        <span class="fs-3">
                                            {{ $product->sales_count }}
                                        </span>
                                    </div>
                                    <span class="small text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-bag-heart mb-1" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5Zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0ZM14 14V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1ZM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z">
                                            </path>
                                        </svg>
                                        {{ __('Sales') }}
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <nav class="mb-3">
                                <div class="nav nav-pills nav-fill p-1 border rounded-5 " id="nav-tab" role="tablist">
                                    <button class="nav-link active rounded-5 border-0" id="nav-home-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                                        aria-controls="nav-home" aria-selected="true">
                                        {{ __('Description') }}
                                    </button>
                                    @if ($product->faqs)
                                        <button class="nav-link rounded-5 border-0" id="nav-profile-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
                                            role="tab" aria-controls="nav-profile" aria-selected="false">
                                            {{ __('Frequently Asked Questions') }}
                                        </button>
                                    @endif
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab" tabindex="0">
                                    {!! $product->content !!}
                                </div>
                                @if ($product->faqs)
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab" tabindex="0">
                                        <div class="accordion accordion-flush" id="accordionFaq">
                                            @foreach (json_decode($product->faqs, true) as $faq)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-heading{{ $loop->index }}">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#flush-{{ $loop->index }}"
                                                            aria-expanded="false"
                                                            aria-controls="flush-{{ $loop->index }}">
                                                            {{ $faq['question'] }}
                                                        </button>
                                                    </h2>
                                                    <div id="flush-{{ $loop->index }}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="flush-heading{{ $loop->index }}"
                                                        data-bs-parent="#accordionFaq">
                                                        <div class="accordion-body">
                                                            {{ $faq['answer'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                    aria-labelledby="nav-contact-tab" tabindex="0">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        const share_btn = document.getElementById("share_btn");

        // function for web share api
        function webShareAPI(header, description, link) {
            navigator
                .share({
                    title: header,
                    text: description,
                    url: link
                })
                .then(() => console.log("Successful share"))
                .catch((error) => console.log("Error sharing", error));
        }

        if (navigator.share) {
            // Show button if it supports webShareAPI
            share_btn.style.display = "block";
            share_btn.addEventListener("click", () =>
                webShareAPI("{{ $product->name }}", "{{ $product->description }}",
                    "{{ route('product', ['slug' => $product->slug]) }}")
            );
        } else {
            // Hide button if it supports webShareAPI
            share_btn.remove();
            console.error("Your Browser doesn't support Web Share API");
        }

        @if ($product->buy_button)
            let quantity = document.getElementById('input_qty');

            function increment() {
                quantity.value = parseInt(quantity.value) + 1;
            }

            function decrement() {
                if (quantity.value > 1) {
                    quantity.value = parseInt(quantity.value) - 1;
                }
            }
        @endif


        function addFavorite(product_id) {
            axios.post("{{ route('favorites.store') }}", {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id
                })
                .then(function(response) {
                    if (response.data.status == 'success') {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        document.querySelector('#favorite_count').innerText = parseInt(document.querySelector(
                            '#favorite_count').innerText) + 1;
                        document.querySelector('#favorite_count1').innerText = parseInt(document.querySelector(
                            '#favorite_count1').innerText) + 1;


                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                })
                .catch(function(error) {

                    console.log(error);
                });
        }

        if (localStorage.getItem('product_slug') != '{{ $product->slug }}') {
            localStorage.setItem('product_slug', '{{ $product->slug }}');
            axios.post("{{ route('product.view') }}", {
                _token: '{{ csrf_token() }}',
                product_slug: "{{ $product->slug }}"
            }).then(function(response) {
                console.log(response);
            }).catch(function(error) {
                console.log(error);
            });
        }
    </script>
@endpush
