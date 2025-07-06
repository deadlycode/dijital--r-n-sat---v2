@php
$columns = explode(',', Cache::Get('product_columns_count','2,3,3'));
@endphp
<div class="row row-cols-{{$columns[0]}} row-cols-md-{{$columns[1]}} row-cols-lg-{{$columns[2]}} g-2">
    @foreach ($products as $product)
    <div class="col">
        <div class="card h-100 shadow-sm rounded-4 product-card ">
            @if($product->discount_rate)
            <span class="rounded-4 border-0 card-center-badge badge text-bg-danger">
                %{{ $product->discount_rate }}
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-gift mb-1"
                    viewBox="0 0 16 16">
                    <path
                        d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
                </svg>
            </span>
            @endif
            @if($product->img)
            <div class="px-2 py-3">
                <a href="{{ route('product',['slug'=>$product->slug]) }}">
                    <img src="{{ asset($product->img) }}" class="card-img-top rounded-4" alt="{{ $product->name }}">
                </a>
            </div>
            @else
            <div class="p-3 mx-auto">
                <a href="{{ route('product',['slug'=>$product->slug]) }}">
                    <img style="width: 85px; height:85px" src="{{ asset($product->category->img) }}" class="card-img-top rounded-4"
                        alt="{{ $product->name }}">
                </a>
            </div>
            @endif
            @if($product->isPopular())
            <span class="badge text-bg-primary rounded-1 border-0 mx-auto" style=" margin-top: -1.7rem; z-index:999;">
                {{__('Popular')}}
            </span>
            @endif
            @if($product->isBestSeller())
            <span class="badge text-bg-danger rounded-1 border-0 mx-auto" style=" margin-top: -1.7rem; z-index:999;">
                {{ __('Best Seller') }}
            </span>
            @endif
            @if($product->isNew())
            <span class="badge text-bg-success rounded-1 border-0 mx-auto" style=" margin-top: -1.7rem; z-index:999;">
                {{ __('Newest') }}
            </span>
            @endif
            <div class="card-body mx-auto text-center d-flex flex-column gap-2 p-1 m-1">
                <a href="{{ route('product',['slug'=>$product->slug]) }}" class="link-dark">
                    <h4 class="card-title">
                        {{ $product->name }}
                    </h4>
                </a>
                <div class="d-flex align-items-center justify-content-center" style="cursor: default;">
                    @if($product->old_price)
                    <del class="small " style="font-size: 10px">
                        {{config('app.currency_symbol')}}{{ money($product->old_price) }}
                    </del>
                    @endif
                    <span class="h5 m-0 text-danger">
                        {{config('app.currency_symbol')}}{{ money($product->price) }}
                    </span>
                </div>
                @if($product->get_properties($product->properties)->count() > 0)
                @foreach($product->get_properties($product->properties) as $property)
                <div class="d-flex align-items-center border rounded-3 p-1" @if($property->description)
                    data-bs-toggle="tooltip" data-bs-placement="top"
                    title="{{ $property->description }}" @endif>
                    <img class="rounded-circle" style="width: 28px; height:28px; opacity: 90%" loading="lazy"
                        src="{{ asset($property->img) }}" alt="{{ $property->name }}">
                    <small class="mx-auto">
                        {{ $property->name }}
                    </small>
                </div>
                @endforeach
                @endif
            </div>
            <div class="footer p-2 mt-auto text-center d-flex flex-column gap-1">
                @if($product->stocks->count() > 0)
                <h6 class="text-success">
                    {{ __('In Stock') }} : {{ $product->stocks->count() }}
                </h6>
                @endif
                <div class="d-grid">
                    <a href="{{route('product',['slug'=>$product->slug])}}" class="btn btn-light border-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search mb-1" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                        {{ __('Details') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

