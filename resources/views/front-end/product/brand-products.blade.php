@extends('front-end.master')

@section('meta_title')
  Subcategory Products
@endsection

@push('styles')
  <style>
      .card{border-radius: 0}.card-header{padding: 5px 18px;background: #e6f2ff}.card-title{font-size: 18px;font-weight: 600;margin:0;}.card-body ul{list-style: none;margin:0;padding:0}.card-body ul li{border-bottom: 1px dotted rgba(0,0,0,.5);padding:2px 0px}.card-body ul li a{text-decoration: none;color:#000;font-size: 16px}
  </style>
@endpush

@section('content')

<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li><a href="">Brand</a></li>
                        <li class="active"><a href="">{{ $brandInfo->brand_name  }}</a></li>
                </div>
            </div>
        </div>
    </div>

<section id="nomi-area">
    <div class="container">
        <div class="nomi">
             <div class="row">
            <div class="col-md-3">

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">All Brands</h2>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach(App\Models\Brand::all() as $brand)
                            <li>
                                <a href="{{ route('front.brand.products',['brand_slug'=>$brand->brand_slug]) }}">
                                   <i class="fa fa-angle-right"></i>
                                   {{ $brand->brand_name }}
                                </a>
                            </li>
                            @endforeach
                          
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-9">

                <section id="nomi-area">
                    <div class="container">
                       <div class="nomi1" style="margin:0">

                          <div class="row">
                            <div class="heading-title1">
                              <h2>{{ $brandInfo->brand_name }}</h2>
                            </div>
                          </div>
                           @if($brandProducts->isNotEmpty())
                           <div class="row">
                            <!-- Product 1 -->
                                @foreach($brandProducts as $product)
                                <div class="col-md-4">
                                  
                                    <div class="product-box">
                                         <a href="{{ route('front.details',['product_slug'=>$product->product_slug]) }}">
                                            @if(!empty($product->product_image))
                                        <img src="{{ asset('back-end/product/product/' . $product->product_image) }}" alt="{{ $product->product_name }}" data-src="{{ asset('back-end/product/product/' . $product->product_image) }}" class="lazyload img-fluid product-image">
                                         @else
                                        <img src="https://placehold.co/300x250/png" class="img-fluid">
                                        @endif

                                        <h5 class="mt-3 product-name">
                                          {{ Str::limit($product->product_name,20) }}
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
            </div>
        </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')

@endpush