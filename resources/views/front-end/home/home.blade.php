@extends('front-end.master')

@php
    $site_name = \App\Models\General::first()->site_name ?? '';
@endphp

@section('meta_title')
  {{ $site_name }}
@endsection

@push('styles')
<style>
#nomi-banner-area{background-color:#fff;padding:10px 0px}.carousel img{height:355px}.right-image img{width: 100%;padding-bottom: 5px;height: 180px}.nomi, .nomi-category{background: #fff;padding: 20px;filter: drop-shadow(3px 4px 6px #eee);margin:10px 0px}#nomi-area .product-box{border: 1px solid #ddd;border-radius: 5px;padding: 15px;text-align: center;transition: transform 0.3s, box-shadow 0.3s;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);background-color: #fff;margin-bottom: 10px}#nomi-area .product-box:hover{transform: translateY(-5px);box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2)}#nomi-area .product-name{color: #002366;font-weight: bold;font-size: 14px}#nomi-area .discount-price{color: #ff6f00;font-weight: bold}#nomi-area .original-price{text-decoration: line-through;color: #6c757d}#nomi-area .product-image{height: 200px;object-fit: cover;border-radius: 10px}#nomi-area .nomi-btn{background-color: #002366;border-color: #002366;color:#fff;width:100%}#nomi-area .nomi-btn:hover{background-color: #ff6f00;border-color: #ff6f00;color:#fff}.nomi-category .product-box{border: 1px solid #ddd;border-radius: 5px;padding: 15px;text-align: center;transition: transform 0.3s, box-shadow 0.3s;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);background-color: #fff;margin-bottom: 10px}.nomi-category .product-box:hover{transform: translateY(-5px);box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2)}.nomi-category .product-name{color: #002366;font-weight: bold;font-size: 14px}.nomi-category .discount-price{color: #ff6f00;font-weight: bold}.nomi-category .original-price{text-decoration: line-through;color: #6c757d}.nomi-category .product-image{height: 200px;object-fit: cover;border-radius: 10px}.nomi-category .nomi-btn{background-color: #002366;border-color: #002366;color:#fff;width:100%}.nomi-category .nomi-btn:hover{background-color: #ff6f00;border-color: #ff6f00;color:#fff}.cat-left-image{max-width: 100%;height: 350px}.nomi-banner-image-1{width:100%!important;height: 150px!important}.nomi-banner-image-2{height: 250px !important;width: 100%}

</style>
@endpush

@section('content')

<section id="nomi-banner-area">
    <div class="container">
         <div class="row">
        <!-- Left Side Carousel -->
        <div class="col-md-8">
          @if($sliders->isNotEmpty())
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                   @foreach($sliders as $slider)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        @if(!empty($slider->image)) 
                       <img src="{{ asset('/') }}back-end/slider/{{ $slider->image }}" class="d-block w-100 lazyload" data-src="{{ asset('/') }}back-end/slider/{{ $slider->image }}">
                       @else
                       <img src="https://placehold.co/1000x500/png" class="img-fluid">
                       @endif
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            @endif
        </div>
        
        <!-- Right Side Single Image -->
        <div class="col-md-4">
            <div class="right-image">
              @if(isset($sliderRightTop))
                <img src="{{ asset('/') }}back-end/banner/{{ $sliderRightTop->banner_image }}" class="img-fluid">
                @else
                <img src="https://placehold.co/300x200/png" class="img-fluid">
                @endif
            </div>

            <div class="right-image rightImage2">
                 @if(isset($sliderRightBottom))
                <img src="{{ asset('/') }}back-end/banner/{{ $sliderRightBottom->banner_image }}" class="img-fluid">
                @else
                <img src="https://placehold.co/300x200/png" class="img-fluid">
                @endif
            </div>

        </div>
    </div>
    </div>
</section>


<section id="nomi-area">
    <div class="container">
        <div class="nomi">

          <div class="row">
        <div class="heading-title1">
          <h2>Featured Categories</h2>
        </div>
      </div>
 @if($categories->isNotEmpty())
           <div class="row">
        <!-- Product 1 -->
        @foreach($categories as $catInfo)
        <div class="col-lg-2 col-md-3 col-6">
          
            <div class="product-box">
                  <a href="{{ route('front.category.products',['cat_slug'=>$catInfo->cat_slug]) }}">
                    @if(isset($catInfo->cat_icon))
                <img src="{{ asset('/') }}back-end/category/icon/{{ $catInfo->cat_icon }}" data-src="{{ asset('/') }}back-end/category/icon/{{ $catInfo->cat_icon }}" class="lazyload img-fluid">
                @else
                <img src="https://placehold.co/100x100/png" class="img-fluid">
                @endif

                <h5 class="mt-3 product-name">
                  {{ $catInfo->cat_name }}
                </h5>
              </a>
            </div>

        </div>
        @endforeach


    </div>
    @endif
        </div>
    </div>
</section>

  <!-- home banner-1 -->
@if($bannersOne->isNotEmpty())
   <section id="nomi-banner-area1">
     <div class="container">
         <div class="nomi-banner1">
           <div class="row">
             @foreach($bannersOne as $bannerOne)
               <div class="col-md-4">
                 <div class="home-banner-image">
                    @if($bannerOne->banner_link)
                      <a href="{{ $bannerOne->banner_link }}" target="_blank">
                    @endif
                    @if(isset($bannerOne->banner_image))
                        <img src="{{ asset('back-end/banner/' . $bannerOne->banner_image) }}" 
                             data-src="{{ asset('back-end/banner/' . $bannerOne->banner_image) }}" 
                             class="lazyload nomi-banner-image-1">
                    @else 
                        <img src="https://placehold.co/300x200/png" 
                             data-src="https://placehold.co/300x200/png" 
                             class="lazyload nomi-banner-image-1">
                    @endif
                    @if($bannerOne->banner_link)
                      </a>
                    @endif
                    @if($bannerOne->banner_title)
                      <div class="home-banner-title">
                         <a href="#">{{ $bannerOne->banner_title }}</a>
                      </div>
                    @endif
                 </div>
               </div>
             @endforeach
           </div>
         </div>
     </div>
   </section>
@endif

<!-- home banner-1 -->


<section id="nomi-area">
    <div class="container">
        <div class="nomi">

          <div class="row">
        <div class="heading-title1">
          <h2>Todays Deal</h2>
        </div>
      </div>
 @if($TodaysDealProducts->isNotEmpty())
           <div class="row">
        <!-- Product 1 -->
        @foreach($TodaysDealProducts as $product)
        <div class="col-lg-3 col-md-4">
          
            <div class="product-box">
                 <a href="{{ route('front.details',['product_slug'=>$product->product_slug]) }}">
                @if(!empty($product->product_image)) 
                    <!-- Check if product image exists and display it -->
                    <img src="{{ asset('back-end/product/product/' . $product->product_image) }}" 
                         alt="{{ $product->product_name }}" 
                         data-src="{{ asset('back-end/product/product/' . $product->product_image) }}" 
                         class="lazyload img-fluid product-image">
                @else 
                    <!-- Fallback image if no product image exists -->
                    <img src="https://placehold.co/300x250/png" class="img-fluid" alt="Placeholder Image">
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



  <!-- home banner-1 -->
@if($bannersTwo->isNotEmpty())
   <section id="nomi-banner-area1">
     <div class="container">
         <div class="nomi-banner1">
           <div class="row">
         @foreach($bannersTwo as $bannerTwo)
         <div class="col-md-6">
           <div class="home-banner-image">
              @if($bannerTwo->banner_link)
              <a href="{{ $bannerTwo->banner_link }}" target="_blank">
              @endif
                  <img src="{{ asset('back-end/banner/' . $bannerTwo->banner_image) }}" alt="{{ $bannerTwo->banner_title ?? 'Banner Image' }}" data-src="{{ asset('back-end/banner/' . $bannerTwo->banner_image) }}" class="lazyload nomi-banner-image-2">
              @if($bannerTwo->banner_link)
              </a>
              @endif
              @if($bannerTwo->banner_title)
              <div class="home-banner-title">
                 <a href="#">{{ $bannerTwo->banner_title }}</a>
              </div>
              @endif
           </div>
         </div>
         @endforeach
       </div>
         </div>
     </div>
   </section>
@endif
<!-- home banner-1 -->


<section id="nomi-area">
    <div class="container">
        <div class="nomi">

          <div class="row">
        <div class="heading-title1">
          <h2>Featured Products</h2>
        </div>
      </div>
 @if($FeaturedProducts->isNotEmpty())
           <div class="row">
        <!-- Product 1 -->
        @foreach($FeaturedProducts as $product)
        <div class="col-lg-3 col-md-4">
          
            <div class="product-box">
                 <a href="{{ route('front.details',['product_slug'=>$product->product_slug]) }}">
                    @if(!empty($product->product_image))
                <img src="{{ asset('back-end/product/product/' . $product->product_image) }}" alt="{{ $product->product_name }}" data-src="{{ asset('back-end/product/product/' . $product->product_image) }}" class="lazyload img-fluid product-image">
                @else
                <img src="https://placehold.co/300x250/png" class="img-fluid" alt="Placeholder Image">
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

@if($homeCategories->isNotEmpty())
    @foreach($homeCategories as $catIndex => $catName)
        <section id="nomi-category-product">
            <div class="container">
                <div class="nomi-category">
                    <div class="row">
                        <div class="heading-title1">
                            <h2>{{ $catName->cat_name }}</h2>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Left Side Large Image -->
                        <div class="col-md-4">
                          @if(isset($catName->cat_banner1))
                            <img src="{{ asset('/') }}back-end/category/banner/{{ $catName->cat_banner1 }}" alt="" class="img-fluid cat-left-image">
                            @else
                            <img src="https://placehold.co/600x400/png" alt="" class="img-fluid cat-left-image">
                            @endif
                        </div>

                        <!-- Right Side Image Slider -->
                        <div class="col-md-8">
                            <div id="imageSlider{{ $catIndex }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @if($catName->categoryProduct->isNotEmpty())
                                        @php
                                            // Always chunk products into groups of 3
                                            $chunks = $catName->categoryProduct->chunk(3);
                                        @endphp

                @foreach($chunks as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach($chunk as $product)
                            <div class="col-12 col-lg-4 col-md-6 mb-3"> <!-- 1 per row on mobile, 3 per row on desktop -->
                                <div class="product-box">
                                    <a href="{{ route('front.details',['product_slug'=>$product->product_slug]) }}">
                                        @if(!empty($product->product_image))
                                        <img src="{{ asset('back-end/product/product/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="img-fluid product-image" style="width:100%;height:300px!important;">
                                        @else
                                        <img src="https://placehold.co/300x200/png" class="img-fluid" alt="Placeholder Image" style="width:100%;height:200px!important;">
                                        @endif
                                        <h5 class="mt-3 product-name">
                                            {{ Str::limit($product->product_name, 20) }}
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
                                            <input type="hidden" name="sale_price" value="{{ $discounted_price }}">
                                        @else
                                            <p class="discount-price">
                                                TK. {{ $product->sale_price }}
                                            </p>
                                            <input type="hidden" name="sale_price" value="{{ $product->sale_price }}">
                                        @endif
                                    </div>
                                    
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
                    </div>
                @endforeach
                                    @else
                                        <p>No products available in this category.</p>
                                    @endif
                                </div>

                                <!-- Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#imageSlider{{ $catIndex }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"><</span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#imageSlider{{ $catIndex }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endif



@endsection

@push('scripts')

@endpush

