<!doctype html>
<html lang="{{ App::getLocale() }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@stack('title') | {{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('uploads/favicon.ico') }}" />

     <!-- @bykodhan - admin@filadmin.com  -->
    <meta name="description" content="@stack('description')" />
    <meta property="og:image" content="@stack('og_image', asset('uploads/logo.webp'))" />
    <meta property="og:title" content="@stack('title')" />
    <meta property="og:description" content="@stack('description')" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@stack('title')">
    <meta name="twitter:description" content="@stack('description')">
    <meta name="twitter:image" content="@stack('og_image', asset('uploads/logo.webp'))">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap');
    </style>
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    {!! Cache::get('extra_header') !!}
    @stack('css')
</head>

<body class="bg-light d-flex flex-column h-100">

    @include('front.layouts.header')
    @include('front.layouts.header-mobile')

    @if ($errors->any())
        <div class="container pt-3">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissible fade show mb-2" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @yield('content')

    @include('front.layouts.footer')

    @include('front.layouts.mobile-menu')
    @include('front.modals.categories')
    @include('front.modals.favorites')
    @include('front.modals.wallet')
    @include('front.modals.login')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    @if (Cache::get('popup_active') == 1)
        <!-- Popup Modal -->
        <div class="modal fade" tabindex="-1" id="popupModal">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                class="bi bi-megaphone mb-1" viewBox="0 0 16 16">
                                <path
                                    d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z" />
                            </svg>
                            {{ Cache::get('popup_title') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {!! Cache::get('popup_content') !!}
                    </div>
                    @if (Cache::get('popup_button_name') != null)
                        <div class="p-3 d-grid">
                            <a href="{{ Cache::get('popup_button_link') }}" class="btn btn-primary">
                                {{ Cache::get('popup_button_name') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Popup Modal -->
        <script>
            let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                'popupModal')) // Returns a Bootstrap modal instance
            if (localStorage.getItem('popupModal') != "{{ Cache::get('popup_title') }}") {
                modal.show();
                localStorage.setItem('popupModal', "{{ Cache::get('popup_title') }}");
            }
        </script>
    @endif
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
    <script src="https://unpkg.com/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const autoCompleteJS = new autoComplete({
            placeHolder: "{{ __('Search...') }}",
            selector: "#search-input",
            trigger: false,
            data: {
                src: async (query) => {
                    try {
                        // Fetch Data from external Source
                        const source = await fetch(
                            `/search?q=${query}`
                        );
                        // Data is array of `Objects` | `Strings`
                        const data = await source.json();
                        return data;
                    } catch (error) {
                        console.log(error);
                        return error;
                    }
                },
                // Data 'Object' key to be searched
                keys: ["name"],
            },
            resultsList: {
                element: (list, data) => {
                    const info = document.createElement("div");
                    info.classList.add("m-1");
                    if (data.results.length) {
                        info.classList.remove("m-1");
                    } else {
                        info.innerHTML =
                            `<strong>"${data.query}"</strong> {{ __('not found') }}`;
                    }
                    list.prepend(info);
                },
                noResults: true,
                maxResults: 10,
                tabSelect: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        window.location.href = "/p/" + selection.slug;
                    }
                }
            }
        });
        const autoCompleteJS2 = new autoComplete({
            placeHolder: "{{ __('Search...') }}",
            selector: "#search-input2",
            trigger: false,
            data: {
                src: async (query) => {
                    try {
                        // Fetch Data from external Source
                        const source = await fetch(
                            `/search?q=${query}`
                        );
                        // Data is array of `Objects` | `Strings`
                        const data = await source.json();
                        return data;
                    } catch (error) {
                        console.log(error);
                        return error;
                    }
                },
                // Data 'Object' key to be searched
                keys: ["name"],
            },
            resultsList: {
                element: (list, data) => {
                    const info = document.createElement("div");
                    info.classList.add("m-1");
                    if (data.results.length) {
                        info.classList.remove("m-1");
                    } else {
                        info.innerHTML =
                            `<strong>"${data.query}"</strong> {{ __('not found') }}`;
                    }
                    list.prepend(info);
                },
                noResults: true,
                maxResults: 10,
                tabSelect: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        window.location.href = "/p/" + selection.slug;
                    }
                }
            }
        });
    </script>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ Session::get('success') }}',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ Session::get('error') }}',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
    {!! Cache::get('extra_footer') !!}
    @stack('js')
</body>
</html>
<!-- @bykodhan - admin@filadmin.com  -->
