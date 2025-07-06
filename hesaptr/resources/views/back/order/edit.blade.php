@extends('back.layouts.app')
@push('title', __('Edit Order'))
@section('content')
    <form action="{{ route('admin.order.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $order->id }}">
        <input type="hidden" name="product_id" value="{{ json_decode($order->product)->product_id }}">
        <input type="hidden" name="ip" value="{{ json_decode($order->billing_details)->ip }}">
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <span>
                            {{ __('Edit Order') }}
                        </span>
                    </div>
                    <div class="card-body pb-1">
                        <div class="row g-1">
                            <div class="col-lg-3 mb-3">
                                <label for="firstName" class="form-label">
                                    {{ __('Name') }}*
                                </label>
                                <input min="3" name="name" type="text" class="form-control" required
                                    value="{{ json_decode($order->billing_details)->name }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="lastName" class="form-label">{{ __('Surname') }}*</label>
                                <input min="3" name="surname" type="text" class="form-control"
                                    value="{{ json_decode($order->billing_details)->surname }}" required>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="email" class="form-label">{{ __('E-Mail') }}* </label>
                                <input min="3" name="email" type="email" class="form-control" required
                                    value="{{ json_decode($order->billing_details)->email }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="phone" class="form-label">
                                    {{ __('Mobile Phone') }}*
                                </label>
                                <input type="tel" name="phone" class="form-control" required
                                    value="{{ json_decode($order->billing_details)->phone }}">
                            </div>
                        </div>
                        <div class="mb-1">
                            <label>
                                {{ __('Note') }} ({{ __('Optional') }})
                            </label>
                            <textarea name="note" maxlength="300" class="form-control" rows="3">{{ $order->note }}</textarea>
                        </div>
                        <hr>
                        <div class="row g-1">
                            <div class="col-lg-6 mb-1">
                                <label class="form-label">
                                    {{ __('Product Name') }}*
                                </label>
                                <input type="text" name="product_name" class="form-control" required
                                    value="{{ json_decode($order->product)->name }}">
                            </div>
                            <div class="col-lg-2 mb-1">
                                <label class="form-label">
                                    {{ __('Product Quantity') }}*
                                </label>
                                <input type="number" name="product_qty" class="form-control"
                                    value="{{ json_decode($order->product)->qty }}" min="1" required>
                            </div>
                            <div class="col-lg-2 mb-1">
                                <label class="form-label">
                                    {{ __('Product Price') }}*
                                </label>
                                <input type="number" name="product_price" step="0.01" class="form-control"
                                    value="{{ json_decode($order->product)->price }}" min="1" required>
                            </div>
                            <div class="col-lg-2 mb-1">
                                <label class="form-label">
                                    {{ __('Total Price') }}*
                                </label>
                                <input type="number" name="total_price" step="0.01" class="form-control"
                                    value="{{ json_decode($order->product)->total }}" min="1" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-1">
                            <div class="col-lg-2 mb-1">
                                <label class="form-label">
                                    {{ __('Order Status') }}
                                </label>
                                <input type="text" name="order_status" class="form-control"
                                    value="{{ $order->order_status }}">
                            </div>
                            <div class="col-lg-2 mb-1">
                                <label class="form-label">
                                    {{ __('Payment Method') }}
                                </label>
                                <input type="text" name="payment_method" class="form-control"
                                    value="{{ $order->payment_method }}">
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">
                                    {{ __('File') }}
                                </label>

                                <div class="input-group">
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
                                @if ($order->file)
                                <div class="d-flex align-items-center small">
                                    <small class="me-3">
                                        {{ __('Current File :') }}
                                        {{ $order->file }}
                                    </small>
                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="flexCheckDefault" name="delete_file">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ __('Delete file from order') }}
                                        </label>
                                    </div>
                                </div>
                            @endif
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">
                                    {{ __('Or File Link') }}
                                </label>
                                <input type="text" class="form-control" name="file_url" max="255"
                                    @if ($order->file_url) value="{{ asset($order->file_url) }}" @endif>
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
                                        <span class="input-group-text bg-white"> {{ __('Add Import File') }} (.txt)</span>
                                        <input type="file" class="form-control" id="file" name="stocks_file"
                                            accept=".txt">
                                    </div>
                                </div>
                            </div>
                            @if ($order->stocks)
                                @php
                                    $array = json_decode($order->stocks, true);
                                    $textarea = '';
                                    foreach ($array as $element) {
                                        $textarea .= $element . "\n";
                                    }
                                @endphp
                                <textarea placeholder="ID:PASS:KEY ... &#10;ID:PASS:KEY ..." class="form-control" id="output" cols="30"
                                    rows="10" name="stocks">{{ $textarea }}</textarea>
                            @else
                                <textarea placeholder="ID:PASS:KEY ... &#10;ID:PASS:KEY ..." class="form-control" id="output" cols="30"
                                    rows="10" name="stocks"></textarea>
                            @endif
                            <span>
                                {{ __('Stocks Count') }}: <span id="lineCount">
                                    @if ($order->stocks)
                                        {{ count(json_decode($order->stocks, true)) }}
                                    @else
                                        0
                                    @endif
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mx-auto d-grid mb-3">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z" />
                        <path
                            d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
                    </svg>
                    {{ __('Update') }}
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
