@extends('front-end.master')

@section('meta_title')
  shop
@endsection

@push('styles')

@endpush

@section('content')
<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="active"><a href="">Shop</a></li>
                </div>
            </div>
        </div>
    </div>


    <section id="nomi-area">
    <div class="container">
        <div class="nomi">

          <div class="row">
        <div class="heading-title1">
          <h2>Shop</h2>
        </div>
      </div>
 @if($shopProducts->isNotEmpty())
           <div class="row">
        <!-- Product 1 -->
        @foreach($shopProducts as $product)
        <div class="col-md-3">
          
            <div class="product-box">
                 <a href="{{ route('front.details',['product_slug'=>$product->product_slug]) }}">
                    @if(!empty($product->product_image))
                <img src="{{ asset('back-end/product/product/' . $product->product_image) }}" alt="{{ $product->product_name }}" data-src="{{ asset('back-end/product/product/' . $product->product_image) }}" class="lazyload img-fluid product-image">
                 @else
                                        <img src="https://placehold.co/300x250/png" class="img-fluid">
                                        @endif

                <h5 class="mt-3 product-name">
                  {{ Str::limit($product->product_name,30) }}
                </h5>
              </a>
                 @php
                    $discounted_price = calculate_discounted_price($product->sale_price, $product->discount_type, $product->discount_price);
                @endphp

                <div class="d-flex justify-content-center">
                  @if($product->discount_type)

                    <p class="discount-price me-2">
                      TK. {{ $discounted_price }}
                    </p>

                    <p class="original-price">
                      TK. {{ $product->sale_price }}
                    </p>

                    @else
                    <p class="discount-price">
                      TK. {{ $product->sale_price }}
                    </p>
                    @endif
                </div>

              <!--   <div class="rating mb-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div> -->
                <a href="{{ route('front.details',['product_slug'=>$product->product_slug]) }}">
                <button class="btn nomi-btn">Add to Cart</button>
                </a>
            </div>

        </div>
        @endforeach


    </div>
    @endif
        </div>
    </div>
</section>


@endsection