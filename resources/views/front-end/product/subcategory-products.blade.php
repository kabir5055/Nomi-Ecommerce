@extends('front-end.master')

@section('meta_title')
  Subcategory Products
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
                        <li><a href="">Category</a></li>
                        <li><a href="">Subcategory</a></li>
                        <li class="active"><a href="">Product</a></li>
                </div>
            </div>
        </div>
    </div>

<section id="featured-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="category-banner-image">
                        <img src="{{ asset('/') }}front-end/assets/images/b2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>


  <section id="featured-product-area" class="p-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12 featured-product">
                    <div class="category-title">
                        <h4>Subcategory Products</h4>
                    </div>
                    <div class="row">
                       @forelse($subcategoryProducts as $product) 
                       <!--  product box -->
                         <div class="col-md-3">
                            <div class="product-box">
                                <div class="product-image">
                                    <a href="{{ route('front.details',$product->product_slug) }}">
                                        @if(!empty($product->product_image))
                                         <img src="{{ asset('/') }}back-end/product/product/{{ $product->product_image }}" alt="{{ $product->product_name }}">
                                           @else
                                        <img src="https://placehold.co/300x250/png" class="img-fluid">
                                        @endif
                                    </a>
                                </div>
                                <div class="product-content">
                                   
                                    <p>
                                         <a href="{{ route('front.details',$product->product_slug) }}">
                                             {{ $product->product_name }}
                                         </a>
                                    </p>
                                   

                                     <div class="rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star-half"></i>
                                    </div>
                                    <h4>
                                        @if($product->discount_type == 'percent')
                                            @php
                                                $discounted_price = $product->sale_price - ($product->sale_price * $product->discount_price / 100);
                                            @endphp
                                            <span class="opacity-40">
                                                <strike>{{ $product->sale_price }} &#2547;</strike>
                                            </span>
                                            <span id="price">{{ $discounted_price }} &#2547;</span>
                                        @else
                                            @if($product->discount_type == 'flat')
                                                <span class="opacity-40">
                                                    <strike>{{ $product->sale_price }} &#2547;</strike>
                                                </span>
                                                <span id="price">{{ $product->sale_price - $product->discount_price }} &#2547;</span>
                                            @else
                                                <span id="price">{{ $product->sale_price }} &#2547;</span>
                                            @endif
                                        @endif
                                    </h4>

                                </div>
                                <div class="btn-area">
                                    <a href="" class='pbtn btn btn-sm btn-block'>
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        add to cart
                                    </a>
                                </div>
                                <div class="offer">
                                    @if($product->discount_type=='flat')
                                     <p> {{ $product->discount_price }} &#2547;</p>
                                     @elseif($product->discount_type=="percent")
                                     <p> {{ $product->discount_price }} % OFF</p>
                                     <p>Sale</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                       <!--  product box -->
                       @empty
                          <div class="col-md-12">
                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong>{{ $subcatName }}! No Product Avaiable</strong>
                            </div>
                          </div>
                       @endforelse
                     
                        

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush