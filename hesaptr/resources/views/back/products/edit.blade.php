@extends('back.layouts.app')
@push('title', $product->name)
@push('css')
    <link href="{{ asset('back/css/select2.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <form action="{{ route('admin.products.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="row g-2 mb-3">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                {{ __('Choose Category') }}*
                            </span>
                            <select class="form-select" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($product->category->id == $category->id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                {{ __('Name') }}*
                            </span>
                            <input type="text" class="form-control" name="name" max="255"
                                value="{{ $product->name }}"
                                onchange="document.getElementById('input_slug').value = slugify(this.value);" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                {{ __('Seo URL') }}*
                            </span>
                            <input id="input_slug" type="text" class="form-control" name="slug" max="255"
                                required value="{{ $product->slug }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                {{ __('Price') }}*
                            </span>
                            <span class="input-group-text bg-white">
                                {{ config('app.currency_symbol') }}
                            </span>
                            <input type="number" class="form-control" name="price" value="{{ $product->price }}"
                                step="0.01" min="1" required>
                        </div>
                        <div class="input-group mb-3" title="{{ __('(if there is a discount)') }}">
                            <span class="input-group-text bg-white">
                                {{ __('Old Price') }}
                            </span>
                            <span class="input-group-text bg-white">
                                {{ config('app.currency_symbol') }}
                            </span>
                            <input type="number" class="form-control" name="old_price" value="{{ $product->old_price }}"
                                step="0.01" min="1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                {{ __('Description') }}
                            </span>
                            <input type="text" class="form-control" name="description" max="255"
                                value="{{ $product->description }}">
                        </div>

                        <div class="input-group mt-3">
                            <span class="input-group-text bg-white">
                                {{ __('File') }} (ex: .zip)
                            </span>
                            <input type="file" class="form-control" name="file" id="input_file">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="document.getElementById('input_file').value = ''">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </button>
                        </div>
                        @if ($product->file)
                        <div class="d-flex align-items-center">
                            <small class="me-3">
                                {{ __('Current File :') }}
                                {{ $product->file }}
                            </small>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="delete_file">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('Delete File') }}
                                </label>
                            </div>
                        </div>
                        @endif
                        <div class="input-group mt-3">
                            <span class="input-group-text bg-white">
                                {{ __('Or File Link') }}
                            </span>
                            <input type="text" class="form-control" name="file_url" max="255"
                                value="{{ $product->file_url }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                {{ __('Featured Properties') }}
                            </span>
                            <select id="properties" class="form-control" name="properties[]" multiple
                                placeholder="{{ __('Select Properties') }}" autocomplete="off">
                                @foreach ($all_properties as $property)
                                    <option value="{{ $property->id }}" data-src="{{ asset($property->img) }}">
                                        {{ $property->name }}</option>
                                @endforeach
                                @if ($properties)
                                    @foreach ($properties as $property)
                                        <option value="{{ $property->id }}" data-src="{{ asset($property->img) }}"
                                            selected>{{ $property->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @php
                            $discount_piece = null;
                            $discount_rate = null;
                            if ($product->discount_more) {
                                $discount_more = explode(':', $product->discount_more);
                                $discount_piece = $discount_more[0];
                                $discount_rate = $discount_more[1];
                            }
                        @endphp
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                {{ __('Discount') }}
                            </span>
                            <input type="number" class="form-control" min="1" name="discount_piece"
                                placeholder="{{ __('Quantity') }}" value="{{ $discount_piece }}">
                            <span class="input-group-text bg-white">{{ __('Qty') }}(&gt;)</span>
                            <input type="number" class="form-control" placeholder="discount rate" min="1"
                                max="90" name="discount_rate" value="{{ $discount_rate }}">
                            <span class="input-group-text bg-white">%</span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                {{ __('Demo Url') }}
                            </span>
                            <input type="text" class="form-control" name="demo_url" max="255"
                                value="{{ $product->demo_url }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                {{ __('Admin Demo Url') }}
                            </span>
                            <input type="text" class="form-control" name="admin_demo_url" max="255"
                                value="{{ $product->admin_demo_url }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                {{ __('Whatsapp Phone') }}
                            </span>
                            <input type="text" class="form-control" name="whatsapp" max="255"
                                value="{{ $product->whatsapp }}" placeholder="{{ __('Whatsapp Phone Number') }}">
                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text bg-white">
                                {{ __('Image') }}
                            </span>
                            <input type="file" class="form-control" name="img" accept="image/*" id="input_img">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="document.getElementById('input_img').value = ''">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </button>
                        </div>
                        @if ($product->img)
                            <small>
                                <a href="{{ asset($product->img) }}" target="_blank">
                                    {{ __('Current Image') }}
                                </a>
                            </small>
                        @endif
                        <div class="input-group mt-3">
                            <span class="input-group-text bg-white">
                                {{ __('Sliders') }}
                            </span>
                            <input type="file" class="form-control" name="sliders[]" accept="image/*" multiple
                                id="sliders">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="document.getElementById('sliders').value = ''">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </button>
                        </div>
                        @if ($product->sliders)
                            <small>
                                {{ __('Total images') }}: {{ count(json_decode($product->sliders, true)) }}
                            </small>
                        @endif
                        <div class="mt-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="buy_button"
                                    id="buy_button" value="1" @if ($product->buy_button == 1) checked @endif>
                                <label class="form-check-label" for="buy_button">
                                    {{ __('Buy Now Button Active') }}
                                </label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="even_if_out_of_stock"
                                    name="even_if_out_of_stock" value="1"
                                    @if ($product->even_if_out_of_stock == 1) checked @endif>
                                <label class="form-check-label" for="even_if_out_of_stock">
                                    {{ __('Keep Selling Even If Out Of Stock') }}
                                </label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="draft"
                                    name="draft" value="1" @if ($product->draft == 1) checked @endif>
                                <label class="form-check-label" for="draft">
                                    {{ __('Save as Draft') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div id="customer_inputs">
                            @if ($product->customer_inputs)
                                @foreach (explode('::', $product->customer_inputs) as $key => $value)
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-white">
                                            {{ __('Customer Input') }}
                                        </span>
                                        <input type="text" class="form-control" name="customer_inputs[]"
                                            value="{{ $value }}">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="this.parentElement.remove()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" onclick="addInput()" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-lg" viewBox="0 1 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                            </svg>
                            {{ __('Add Customer Input') }}
                        </button>
                        <script>
                            /* <div class="input-group mb-3">
                                                                                                    <span class="input-group-text bg-white">
                                                                                                        {{ __('Customer Input') }}
                                                                                                    </span>
                                                                                                    <input type="text" class="form-control" name="customer_inputs[]" max="255"
                                                                                                        value="{{ old('customer_inputs[]') }}">
                                                                                                    <button type="button" class="btn btn-outline-secondary">
                                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                                                                            class="bi bi-trash" viewBox="0 0 16 16">
                                                                                                            <path
                                                                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                                                            <path fill-rule="evenodd"
                                                                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                                                                        </svg>
                                                                                                    </button>
                                                                                                </div>
                                                                                                */
                            function addInput() {
                                var container = document.getElementById("customer_inputs");
                                var div = document.createElement("div");
                                div.classList.add("input-group", "mb-3");
                                var span = document.createElement("span");
                                span.classList.add("input-group-text", "bg-white");
                                span.innerHTML = "{{ __('Customer Input') }}";
                                var input = document.createElement("input");
                                input.type = "text";
                                input.classList.add("form-control");
                                input.name = "customer_inputs[]";
                                input.max = "255";
                                input.value = "{{ old('customer_inputs[]') }}";
                                var button = document.createElement("button");
                                button.type = "button";
                                button.classList.add("btn", "btn-outline-danger");
                                button.innerHTML =
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>';

                                button.addEventListener("click", function() {
                                    container.removeChild(div);
                                });
                                div.appendChild(span);
                                div.appendChild(input);
                                div.appendChild(button);
                                container.appendChild(div);
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div id="faqs">
                            @if ($product->faqs)
                                @foreach (json_decode($product->faqs, true) as $faq)
                                    <div class="input-group mb-2"><span
                                            class="input-group-text bg-white">{{ __('Question') }}</span>
                                        <input type="text" class="form-control" name="questions[]" max="255"
                                            value="{{ $faq['question'] }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <textarea class="form-control" name="answers[]">{{ $faq['answer'] }}</textarea>
                                    </div>
                                    <button type="button" class="btn btn-outline-danger mb-3"
                                        onclick="this.parentElement.remove()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z">
                                            </path>
                                        </svg>
                                    </button>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" onclick="addFaq()" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-lg" viewBox="0 1 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                            </svg>
                            {{ __('Add FAQ') }}
                        </button>
                        <script>
                            function addFaq() {
                                // Yeni soru ve cevap girişlerini oluşturun
                                var container = document.getElementById("faqs");
                                var questionGroup = document.createElement("div");
                                questionGroup.classList.add("input-group", "mb-2");
                                var questionLabel = document.createElement("span");
                                questionLabel.classList.add("input-group-text", "bg-white");
                                questionLabel.innerHTML = "{{ __('Question') }}";
                                var questionInput = document.createElement("input");
                                questionInput.type = "text";
                                questionInput.classList.add("form-control");
                                questionInput.name = "questions[]";
                                var answerGroup = document.createElement("div");
                                answerGroup.classList.add("form-group", "mb-2");
                                var answerInput = document.createElement("textarea");
                                answerInput.classList.add("form-control");
                                answerInput.name = "answers[]";
                                // Silme butonu oluşturun
                                var removeButton = document.createElement("button");
                                removeButton.type = "button";
                                removeButton.classList.add("btn", "btn-outline-danger", "mb-3");
                                removeButton.innerHTML =
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>';
                                removeButton.addEventListener("click", function() {
                                    // Silme butonuna tıklandığında, soru ve cevap girişlerini "faqs" div'den kaldırın
                                    questionGroup.remove();
                                    answerGroup.remove();
                                    removeButton.remove();
                                });
                                // Soru ve cevap girişlerini "faqs" div'ine ekleyin
                                questionGroup.appendChild(questionLabel);
                                questionGroup.appendChild(questionInput);
                                answerGroup.appendChild(answerInput);
                                document.getElementById("faqs").appendChild(questionGroup);
                                document.getElementById("faqs").appendChild(answerGroup);
                                document.getElementById("faqs").appendChild(removeButton);
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-wrap mb-3">
                            <span>
                                {{ __('Stocks') }} ({{ __('Each row becomes a stock, one line is one stock') }})
                            </span>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white"> {{ __('Add Import File') }} (.txt)</span>
                                    <input type="file" class="form-control" id="file" name="stocks_file"
                                        accept=".txt">
                                </div>
                            </div>
                        </div>
                        <textarea placeholder="ID:PASS:KEY ... &#10;ID:PASS:KEY ..." class="form-control" id="output" cols="30"
                            rows="10" name="stocks" keyup="stock_count()">{{ $product->stocks->implode('content', "\n") }}</textarea>
                        <span>
                            {{ __('Stocks Count') }}: <span id="lineCount">0</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <textarea name="content" id="editor" cols="30" rows="10">{!! $product->content !!}</textarea>
            </div>
        </div>

        <div class="row justify-content-center py-3">
            <div class="col-lg-4 d-grid">
                <div class="d-flex justify-content-center py-2 d-none" id="spinner">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <button onclick="document.querySelector('#spinner').classList.remove('d-none');" type="submit"
                    class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                        class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z" />
                        <path
                            d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
                    </svg>
                    {{ __('Update Product') }}
                </button>
            </div>
            <div class="col-lg-3 d-grid">
                <div class="d-flex justify-content-center py-2 d-none" id="spinner">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <button name="new_product" value="1"
                    onclick="document.querySelector('#spinner').classList.remove('d-none');" type="submit"
                    class="btn btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 1 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg>
                    {{ __('Add As New Product') }}
                </button>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script src="{{ asset('back/js/select2.min.js') }}"></script>
    <script src="{{ asset('back/js/tinymce/tinymce.min.js') }}"></script>

    <script>
        const $output = document.getElementById('output')
        document.getElementById('file').onchange = function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(progressEvent) {
                // Entire file
                const text = this.result;
                // By lines
                $output.value = '';
                var lines = text.split('\n');
                for (var line = 0; line < lines.length; line++) {
                    $output.value += lines[line] + '\n';
                }
            };
            reader.readAsText(file);
        };

        function removeEmptyLines() {
            const textarea = document.getElementById("output");
            textarea.value = textarea.value.replace(/^\s*\n/gm, "");
        }

        const x = document.getElementById("output");
        x.addEventListener("input", removeEmptyLines);

        function updateLineCount() {
            const textarea = document.getElementById("output");
            const span = document.getElementById("lineCount");

            let lineCount = textarea.value.split("\n").length;
            if (!textarea.value) {
                span.textContent = "0";
                return;
            }
            span.textContent = lineCount;
        }

        const textarea = document.getElementById("output");
        textarea.addEventListener("input", updateLineCount);
        textarea.addEventListener("change", updateLineCount);
    </script>
    <script>
        tinymce.init({
            selector: '#editor',
            height: 400,
            verify_html: false,
            images_upload_url: '{{ route('admin.tinymce.upload') }}',
            menubar: false,
            relative_urls: false,
            advlist_number_styles: "default",
            advlist_bullet_styles: "default",
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            toolbar: 'h1 h2 h3 bold italic blockquote strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor hr | link image media | table emoticons codesample | ltr rtl |  removeformat help fullscreen preview code',
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote forecolor backcolor quickimage quicktable',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            automatic_uploads: true,
            image_title: true,
            paste_auto_cleanup_on_paste: true,
            paste_remove_styles: true,
            paste_remove_styles_if_webkit: true,
            paste_strip_class_attributes: true,
            paste_postprocess: function(plugin, args) {
                var allElements = args.node.getElementsByTagName("img");
                for (i = 0; i < allElements.length; ++i) {
                    allElements[i].className = "img-fluid";
                }
            },

            file_picker_types: 'image',
            image_class_list: [{
                title: 'Responsive',
                value: 'img-fluid'
            }],

            /* and here's our custom image picker*/
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                // Provide image and alt text for the image dialog

                /*
                Note: In modern browsers input[type="file"] is functional without
                even adding it to the DOM, but that might not be the case in some older
                or quirky browsers like IE, so you might want to add it to the DOM
                just in case, and visually hide it. And do not forget do remove it
                once you do not need it anymore.
                */

                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function() {
                        /*
                        Note: Now we need to register the blob in TinyMCEs image blob
                        registry. In the next release this part hopefully won't be
                        necessary, as we are looking to handle it internally.
                        */
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }

        });
    </script>
    <script>
        new TomSelect('#properties', {
            plugins: ['remove_button'],
            render: {
                option: function(data, escape) {
                    return `<div><img class="me-2" src="${data.src}">${data.text}</div>`;
                },
                item: function(item, escape) {
                    return `<div><img class="me-2" src="${item.src}">${item.text}</div>`;
                }
            }
        });
    </script>
@endpush
