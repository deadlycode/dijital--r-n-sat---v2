<section id="header" class="bg-white shadow-sm py-3 d-md-block d-none sticky-top">
    <div class="container">
        <div class="d-flex align-items-center gap-1">
            <a href="/">
                <img class="img-fluid" src="{{ asset('uploads/logo.webp') }}" alt="{{ config('app.name') }}"
                    loading="lazy">
            </a>
            <div class="mx-auto flex-grow-1 px-5 ">
                <div class="input-group input-group-sm p-1 border bg-light rounded-4">
                    <input class="form-control bg-light border-0 rounded-4 w-100" id="search-input" type="search"
                        dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">
                </div>
            </div>
            <div class="ms-auto">
                <div class="d-flex align-items-center justify-content-center gap-1">
                    <a class="btn btn-sm btn-outline-light text-dark rounded"
                        @auth href="{{ route('profile') }}" @endauth
                        @guest data-bs-toggle="modal" data-bs-target="#loginModal" @endguest>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person mb-1" viewBox="0 0 16 16">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        </svg>
                        @auth
                            <span>
                                {{ Auth::user()->name }}
                            </span>
                        @else
                            <span>
                                {{ __('Login') }}
                            </span>
                        @endauth
                    </a>
                    @guest
                        <a class="btn btn-sm btn-outline-light text-dark rounded" data-bs-toggle="modal"
                            data-bs-target="#loginModal" title="{{ __('Your Wallet') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-wallet2" viewBox="0 0 16 16">
                                <path
                                    d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                            </svg>
                            <span class="badge text-bg-secondary">
                                <span>{{ config('app.currency_symbol') }} 0.00</span>
                            </span>
                        </a>
                    @endguest
                    @auth
                        <button type="button" class="btn btn-sm btn-outline-light text-dark"
                            title="{{ __('Your Wallet') }}" data-bs-toggle="modal" data-bs-target="#balanceModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-wallet2" viewBox="0 0 16 16">
                                <path
                                    d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                            </svg>
                            <span class="badge text-bg-secondary d-lg-inline-block d-none">
                                <span>{{ config('app.currency_symbol') }} {{ money(Auth::user()->wallet) }}</span>
                            </span>
                        </button>
                    @endauth
                    <button type="button" class="btn btn-sm btn-outline-light text-dark position-relative"
                        title="{{ __('Favorites') }}" data-bs-toggle="offcanvas" data-bs-target="#miniFavoriteModal"
                        aria-controls="miniFavoriteModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-heart" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z">
                            </path>
                        </svg>
                        <span id="favorite_count"
                            class="position-absolute start-75 translate-middle badge rounded-pill bg-danger"
                            style="font-size:10px; top:10px;">
                            @auth
                                {{ Auth::user()->favorites()->count() }}
                            @endauth
                            @guest
                                {{ is_array(session()->get('favorite')) ? count(session()->get('favorite')) : 0 }}
                            @endguest
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="d-flex justify-content-center category-level-1">
                <ul class="navbar-list p-0 m-0">
                    @foreach ($app_categories as $header_category)
                        <li class="navbar-item">
                            <a class="navbar-link" href="{{ route('category', $header_category->slug) }}">
                                <img style="width: 30px; height: 30px;" class="me-1 rounded-circle" loading="lazy"
                                    src="{{ asset($header_category->img) }}" alt="{{ $header_category->name }}">
                                {{ $header_category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        var typed1 = new Typed('#search-input', {
            strings: @json($app_products->pluck('name')->toArray()),
            typeSpeed: 0,
            backSpeed: 0,
            attr: 'placeholder',
            bindInputFocusEvents: true,
            loop: true,
            shuffle: true,
            typeSpeed: 50,
            backSpeed: 50,
        });
        var typed2 = new Typed('#search-input2', {
            strings: @json($app_products->pluck('name')->toArray()),
            typeSpeed: 0,
            backSpeed: 0,
            attr: 'placeholder',
            bindInputFocusEvents: true,
            loop: true,
            shuffle: true,
            typeSpeed: 50,
            backSpeed: 50,
        });
    </script>
@endpush
