@extends('back.layouts.app')
@push('title', __('Add New Order'))
@section('content')
    <form action="{{ route('admin.order.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <span>
                            {{ __('Add New Order') }}
                        </span>
                    </div>
                    <div class="card-body pb-1">
                        <div class="row g-1">
                            <div class="col-lg-3 mb-3">
                                <label for="firstName" class="form-label">
                                    {{ __('Name') }}*
                                </label>
                                <input min="3" name="name" type="text" class="form-control" required autofocus value="{{ old('name') }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="lastName" class="form-label">{{ __('Surname') }}*</label>
                                <input min="3" name="surname" type="text" class="form-control" value="{{ old('surname') }}" required>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="email" class="form-label">{{ __('E-Mail') }}* </label>
                                <input min="3" name="email" type="email" class="form-control" required value="{{ old('email') }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="phone" class="form-label">
                                    {{ __('Mobile Phone') }}*
                                </label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label>
                                {{ __('Note') }} ({{ __('Optional') }})
                            </label>
                            <textarea name="note" maxlength="300" class="form-control" rows="3" placeholder="{{ Cache::get('checkout_message') }}"></textarea>
                        </div>
                        <hr>
                        <div class="row g-1">
                            <div class="col-lg-6 mb-1">
                                <label class="form-label">
                                    {{ __('Product Name') }}*
                                </label>
                                <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" required>
                            </div>
                            <div class="col-lg-2 mb-1">
                                <label class="form-label">
                                    {{ __('Product Quantity') }}*
                                </label>
                                <input type="number" name="product_qty" class="form-control"
                                    value="{{ old('product_qty') }}" min="1" required>
                            </div>
                            <div class="col-lg-2 mb-1">
                                <label class="form-label">
                                    {{ __('Product Price') }}*
                                </label>
                                <input type="number" name="product_price" step="0.01" class="form-control"
                                    value="{{ old('product_price') }}" min="1" required>
                            </div>
                            <div class="col-lg-2 mb-1">
                                <label class="form-label">
                                    {{ __('Total Price') }}*
                                </label>
                                <input type="number" name="total_price" step="0.01" class="form-control"
                                    value="{{ old('total_price') }}" min="1" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-1">
                            <div class="col-lg-2 mb-1">
                                <label class="form-label">
                                    {{ __('Order Status') }}
                                </label>
                                <input type="text" name="order_status" class="form-control"
                                    value="{{ old('order_status') }}">
                            </div>
                            <div class="col-lg-2 mb-1">
                                <label class="form-label">
                                    {{ __('Payment Method') }}
                                </label>
                                <input type="text" name="payment_method" class="form-control"
                                    value="{{ old('payment_method') }}">
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">
                                    {{ __('File (.zip)') }}
                                </label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="file" accept=".zip"
                                        id="input_file">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="document.getElementById('input_file').value = ''">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">
                                    {{ __('Or File Link') }}
                                </label>
                                <input type="text" class="form-control" name="file_url" max="255" value="{{ old('file_url') }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-between flex-wrap mb-3">
                                <span>
                                    {{ __('Stocks') }} ({{ __('Each row becomes a stock, one line is one stock') }})
                                </span>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"> {{__('Add Import File') }} (.txt)</span>
                                        <input type="file" class="form-control" id="file" name="stocks_file" accept=".txt">
                                    </div>
                                </div>
                            </div>
                            <textarea placeholder="ID:PASS:KEY ... &#10;ID:PASS:KEY ..." class="form-control" id="output"
                                cols="30" rows="10" name="stocks"
                                keyup="stock_count()"></textarea>
                            <span>
                                {{ __('Stocks Count') }}: <span id="lineCount">0</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mx-auto d-grid mb-3">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg mb-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg>
                    {{ __('Add New Order') }}
                </button>
            </div>
        </div>
    </form>
@endsection
@push('js')
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
@endpush
