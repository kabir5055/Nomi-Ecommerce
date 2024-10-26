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
                <form action="{{ route('front.products.buy.now') }}" method="POST" class="mt-3"> <!-- Form outside the design structure -->
                    @csrf
                      @if($product->discount_type)
                          <input type="hidden" name="sale_price" value="{{ $discounted_price }}">
                      @else
                          <input type="hidden" name="sale_price" value="{{ $product->sale_price }}">
                      @endif
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <input type="hidden" name="selected_size" value="{{ $product->size }}">
                      <input type="hidden" name="selected_color" value="{{ $product->color }}">
                      <input type="hidden" name="quantity" value="1">

                    <button type="submit" class="btn nomi-btn w-100 mb-2"><i class="fa fa-shopping-bag"></i> Buy Now</button>
                </form>
            </div>

        </div>
        @endforeach


    </div>
    @endif
        </div>
    </div>
</section>


@endsection