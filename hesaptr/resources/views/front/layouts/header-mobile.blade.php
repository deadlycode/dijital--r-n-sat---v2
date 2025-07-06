<section class="bg-white shadow py-2 d-md-none d-block">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <a href="/">
                <img class="img-fluid" src="{{ asset('uploads/logo.webp') }}"
                    alt="Logo" loading="lazy">
            </a>
            <div class="d-flex align-items-center gap-1">
                <button class="btn btn-sm btn-outline-light text-dark px-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#searchCollapse" aria-expanded="false" aria-controls="searchCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
                @auth
                <button type="button" class="btn btn-sm btn-outline-light text-dark" title="{{__('Your Wallet')}}"
                    data-bs-toggle="modal" data-bs-target="#balanceModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-wallet2" viewBox="0 1 16 16">
                        <path
                            d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z">
                        </path>
                    </svg>
                    <span class="badge text-bg-secondary">
                        <span>
                            {{ Auth::user()->wallet }}
                        </span>
                    </span>
                </button>
                @endauth
                @guest
                <a class="btn btn-sm btn-outline-light text-dark" title="{{__('Login')}}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-wallet2" viewBox="0 1 16 16">
                        <path
                            d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z">
                        </path>
                    </svg>
                    <span class="badge text-bg-secondary">
                        <span>
                            {{config('app.currency_symbol')}}0.00
                        </span>
                    </span>
                </a>
                @endguest
            </div>
        </div>
        <div class="row pt-1">
            <div class="collapse" id="searchCollapse">
                <div class="input-group p-1 border bg-light rounded-4 ">
                    <input lass="form-control bg-light border-0 rounded-4 w-100" id="search-input2" type="search"
                        dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">
                </div>
            </div>
        </div>
    </div>
</section>
