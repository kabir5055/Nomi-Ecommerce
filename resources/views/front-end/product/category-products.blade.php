@extends('front-end.master')

@section('meta_title')
  {{ $catName }}
@endsection

@push('styles')
<style>

#shop-page-area{padding:20px 0px}.shop-product-box{text-align: center;margin-bottom: 10px;box-shadow: 0px 0px 5px 3px #efefef;position: relative}.shop-product-image img{height: 100%;width:100%}.shop-product-title{margin-top: 10px}.shop-product-title span{text-align: center;color: #000;font-size: 16px}.discounted_amount{background: #0056b3;background: #0074f0;width: fit-content;left: 0;top: 165px;color: #FFF;font-size: 14px;padding: 2px 10px;position: absolute;transform: rotate(0deg)}.products-cart-button{width: 100%;text-align: center;background: #0f0f0f91;padding-top: 5px;padding-bottom: 5px;border: none;cursor: pointer;-webkit-transition: .3s ease;transition: .3s ease}.products-cart-button a{text-decoration: none;color:#fff;font-weight: 500;font-size: 14px}.ptb-20{padding:20px 0px}.mt-10{margin-top: 10px}.card{border-radius: 0}.card-header{padding: 5px 18px;background: #e6f2ff}.card-title{font-size: 18px;font-weight: 600}.card-body ul{list-style: none;margin:0;padding:0}.card-body ul li{border-bottom: 1px dotted rgba(0,0,0,.5);padding:2px 0px}.card-body ul li a{text-decoration: none;color:#000;font-size: 16px}
  .phone-info{
    margin:5px!important;
  }
</style>
@endpush

@section('content')

<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li><a href="">Category</a></li>
                        <li class="active"><a href="">{{ $catName }}</a></li>
                </div>
            </div>
        </div>
    </div>


<section id="shop-page-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">All Categories</h2>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach(App\Models\Category::all() as $category)
                            <li>
                                <a href="{{ route('front.category.products',['cat_slug'=>$category->cat_slug]) }}">
                                   <i class="fa fa-angle-right"></i>
                                   {{ $category->cat_name }}
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
                       <div class="nomi" style="margin:0">

                          <div class="row">
                            <div class="heading-title1">
                              <h2>{{ $catName }}</h2>
                            </div>
                          </div>
                           @if($categoryProducts->isNotEmpty())
                           <div class="row">
                            <!-- Product 1 -->
                                @foreach($categoryProducts as $product)
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
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

@endpush