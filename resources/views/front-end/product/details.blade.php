
@extends('front-end.master')

@section('meta_title')
  {{ $productDetails->product_name }}
@endsection

@push('styles')
<style>
.heading-title h4{border-bottom: 2px solid #0056b3;font-family: "Playfair Display", serif;font-weight: 600;}

.quantity-control{max-width: 150px}input#quantity{width: 50px}
.input-group{position: relative;display: flex;flex-wrap: wrap;align-items: stretch;width: 100%;left: 83px;top: -30px}

.decrease{padding: 0px 15px;border: none}.increase{padding: 0px 15px;border: none}.call_btn{background:var(--theme-secondary-bg)}.aponn{margin: 10px 0px}.visulization{background: #fff;border: 1px solid rgba(0,0,0,.1);padding: 20px}.nav-pills .nav-link.active, .nav-pills .show > .nav-link{color: #fff;background:var(--theme-secondary-bg)}.nav-pills .nav-link{background: 0 0;border: 0;border-radius: .25rem;background:#007aff;margin-right: 10px;border-radius: 0;color: #fff}#details-p{font-size: 14px;color: #333333}.product-size ul li.active a, .product-color ul li.active a{font-weight: bold;color: #ff4500}

.product-name h4{font-size:18px}.btn_btn{padding: 5px 10px;color: #000;font-weight: 600;border-radius: 0px;font-size: 12px;background: #f8f8f8}.nomi-details-left{background: #fff;padding: 20px;border: 1px solid rgba(0,0,0,.1)}.delivery-area .card{border-radius: 0}.delivery-area .card .card-title{margin: 0;padding: 0}.delivery-option, .service-option, .seller-info{display: flex;justify-content: space-between;align-items: center}.delivery-option i, .service-option i{font-size: 20px;color: #444}.delivery-option span, .service-option span{margin-left: 10px}.price-info{color: #ff5e57;font-weight: bold}.verified-badge{color: green}.visit-store{text-decoration: none;font-size: 0.9rem;color: #333}.visit-store:hover{text-decoration: underline}.delivery-option{border-bottom: 1px solid rgba(0,0,0,.1);padding: 5px 0px;font-size: 14px}.delivery-option i, .service-option i{font-size: 12px;color: #444}.share i{font-size: 16px;color: #fff;width: 30px;height: 30px;line-height: 30px!important;text-align: center;border: 1px solid rgba(0,0,0,.1)}.facebook{background-color: #1877F2;color: #ffffff}.twitter{background-color: #1DA1F2;color: #ffffff}.whatsapp{background-color: #25D366;color: #ffffff}.linkedin{background-color: #0077B5;color: #ffffff}.addtocart{background-color: #ff6f00;color: white;transition: transform 0.3s ease}.addtocart:hover{background-color: #ff6f00;transform: scale(1.05);color: white}.buynow{background-color: #ff0000;color: white;transition: transform 0.3s ease}.buynow:hover{background-color: #ff0000;transform: scale(1.05);color: white}.callnow{background-color: #28a745;color: white;transition: transform 0.3s ease}.callnow:hover{background-color: #28a745;transform: scale(1.05);color: white}.whatsapp{background-color: #25D366;color: white;transition: transform 0.3s ease}.whatsapp:hover{background-color: #25D366;transform: scale(1.05);color: white}

</style>
@endpush

@section('content')

<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li><a href="">{{ $productDetails->category->cat_name }}</a></li>
                        <li class="active"><a href="">{{ $productDetails->product_name }}</a></li>
                </div>
            </div>
        </div>
    </div>

<section id="product-details-area">
  <div class="container">
    <div class="row">
      <div class="aponn">
        <form action="{{ route('front.products.cart') }}" method="POST">
        @csrf
        <div class="row">

        <div class="col-md-8">
            <div class="nomi-details-left">
                <div class="row">
                    <div class="col-md-5">
                        <div class="product-details-image">
                          @if(!empty($productDetails->product_image))
                          <img src="{{ asset('/') }}back-end/product/product/{{ $productDetails->product_image }}" data-src="{{ asset('back-end/product/product/' . $productDetails->product_image) }}" class="lazyload img-fluid">
                           @else
                                        <img src="https://placehold.co/400x400/png" class="img-fluid">
                                        @endif
                        </div>
      </div>
      
      <div class="col-md-7">
        <div class="product-content">
          <div class="product-name mpt-20">
            <h4>{{ $productDetails->product_name }}</h4>
          </div>
          
          <!-- <div class="product-category">
            <span>SKU: AKS-001</span>
          </div> -->
           

          <div class="product-category">
            <span>Category: {{ $productDetails->category->cat_name }}</span>
          </div>

          <div class="product-category">
            <span>Brand: {{ $productDetails->brand->brand_name }}</span>
          </div>
           
                    <div class="product-price">
                      @php
                          $discounted_price = calculate_discounted_price($productDetails->sale_price, $productDetails->discount_type, $productDetails->discount_price);
                      @endphp

                      <p style="font-family:Arial, Helvetica, sans-serif">
                          @if($productDetails->discount_type)

                           <span>Price:</span>
                              <span class="price_field">
                                  ৳ {{ $discounted_price }}
                              </span>

                              
                              <span class="regular_price_field" style="text-decoration: line-through;color:red;margin-left:10px;">
                                  ৳ {{ $productDetails->sale_price }} 
                              </span>&nbsp;

                             
                          @else
                              <span>Price:</span>
                              <span class="price_field">
                                  ৳ {{ $productDetails->sale_price }}
                              </span>
                          @endif
                      </p>
                  </div>
        
           
          <?php
            $all_sizes = json_decode($productDetails->size);
            ?>

           @if(isset($all_sizes) && (is_array($all_sizes) || is_object($all_sizes)))
          <div class="product-size">
            <span> Size:</span>
            <div class="size-list" id="size-list">
              <ul>
                 @foreach($all_sizes as $size)
                <li>
                  <a href="javascript:void(0)" onclick="selectSize('{{ $size }}')" class="{{ old('selected_size') == $size ? 'active' : '' }}">
                     {{ $size }}
                  </a>
                </li>
                @endforeach
            </ul>
            </div>
          </div>
          @endif

          <?php
            $all_colors = json_decode($productDetails->color);
          ?>

          @if(isset($all_colors) && (is_array($all_colors) || is_object($all_colors)))
          <div class="product-color mt-3">
            
            <span>Color:</span>
            <div class="color-list" id="color-list">
               @if(is_array($all_colors) || is_object($all_colors))
              <ul>
                   @foreach($all_colors as $color)
                    <li>
                       <a href="javascript:void(0)" onclick="selectColor('{{ $color }}')">
                         {{ $color }}
                       </a>
                    </li>
                   @endforeach
               </ul>
               @endif
            </div>
          </div>
          @endif

          <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
          <input type="hidden" name="sale_price" value="{{ $discounted_price }}">
          <input type="hidden" name="selected_size" id="selected_size" value="{{ old('selected_size') }}">
          <input type="hidden" name="selected_color" id="selected_color">

          <div class="quantity-control mt-4">
                    <label for="quantity">Quantity:</label>
                    <div class="input-group">
                        <button class="decrease" type="button" onclick="decreaseQuantity()">-</button>
                        <input type="text" name="quantity" class="form-control text-center" id="quantity" value="1" readonly>
                        <button class="increase" type="button" onclick="increaseQuantity()">+</button>
                    </div>
                </div>
                 

                <div class="btn-area">

                
                    <button type="submit" class="btn btn-sm btn_btn addtocart">
                        <i class="fa fa-shopping-cart"></i>  Add To Cart   
                    </button>

                    <button type="submit" class="btn btn-sm btn_btn buynow">
                        <i class="fa fa-shopping-bag"></i>  Buy Now  
                    </button>
            

                  <a href="tel:+8801314109523" class="btn btn-sm btn_btn callnow">
                    <i class="fa fa-phone"></i>  Call Now
                  </a>

                    <a href="https://wa.me/01314109523" target="_blank" class="btn btn-sm btn_btn whatsapp">
                    <i class="fa-brands fa-whatsapp"></i> Whatsapp
                  </a>

                </div>

                 <!-- Share Section -->
            <div class="share mt-3">
                <span>Share: </span>
                <a href="#" class="text-info"><i class="fab fa-facebook-f facebook"></i></a>
                <a href="#" class="text-info"><i class="fab fa-twitter twitter"></i></a>
                <a href="#" class="text-info"><i class="fab fa-whatsapp whatsapp"></i></a>
                <a href="#" class="text-info"><i class="fab fa-linkedin-in linkedin"></i></a>
            </div>

        </div>
      </div>
                </div>
            </div>
        </div>

      <div class="col-md-4">
        <div class="delivery-area">

            <div class="card mb-2">
      <!-- Delivery Section -->
      <div class="mb-4">
        <div class="card-header">
          <h5 class="card-title">Delivery</h5>
        </div>

          <div class="card-body">
            <div class="delivery-option">
          <div>
            <i class="fas fa-truck"></i>
            <span>Inside Dhaka (1-3 days)</span>
          </div>
          <div class="price-info">TK.70</div>
        </div>

        <div class="delivery-option">
          <div>
            <i class="fas fa-truck"></i>
            <span>Outside Dhaka (2-4 days)</span>
          </div>
          <div class="price-info">TK.120</div>
        </div>

        <div class="delivery-option">
          <div>
            <i class="fas fa-money-bill-wave"></i>
            <span>Cash on Delivery Available</span>
          </div>
        </div>

          </div>

      </div>

    

    </div>

    <!-- return -->
     <div class="card">
      <!-- Delivery Section -->
      <div class="mb-4">
        <div class="card-header">
          <h5 class="card-title">Return & Warranty</h5>
        </div>

          <div class="card-body">

        <div class="delivery-option">
          <div>
            <i class="fas fa-shield-alt"></i>
            <span>7 Days Returns</span>
          </div>
        </div> 

        <div class="delivery-option">
          <div>
            <i class="fas fa-shield-alt"></i>
            <span>Warranty available</span>
          </div>
        </div>


          </div>

      </div>

    

    </div>
    <!-- return -->


        </div>
      </div>
      </div>
      </form>
      </div>
    </div>
  </div>
</section>


<section id="visulization-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="visulization mb-4">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Product Details</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Product Visulization</button>
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                          <p id="details-p">
                               {!! $productDetails->product_description !!}
                          </p>
                          

                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                          
                           <?php
                             $alls = json_decode($productDetails->product_gallery);
                           ?>
                           @if($alls)
                           <div class="col-md-12">
                              <div class="row">
                                @if(is_array($alls) || is_object($alls))
                              @foreach($alls as $gl)
                                   <div class="col-md-4">
                                      <div class="details_image">
                                        @if(!empty($gl))
                                          <img src="{{ asset('/') }}back-end/product/gallery/{{ $gl }}" style="width:100%;height: 50%;margin:20px 0px;" data-src="{{ asset('/') }}back-end/product/gallery/{{ $gl }}" class="lazyload">
                                           @else
                                        <img src="https://placehold.co/300x300/png" class="img-fluid">
                                        @endif
                                        </div>
                                    </div>
                                    @endforeach
                               @endif
                                  </div>
                            </div>
                            @endif
                         <div>
                    </div>

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
          <h2>Related Products</h2>
        </div>
      </div>
 @if($related_products->isNotEmpty())
           <div class="row">
        <!-- Product 1 -->
        @foreach($related_products as $product)
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

@push('scripts')
<script>
  function increaseQuantity() {
    let quantityInput = document.getElementById('quantity');
    let currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
}

function decreaseQuantity() {
    let quantityInput = document.getElementById('quantity');
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

</script>

<script>
  $(document).ready(function() {
    // Handle active class for size list
    $('#size-list li').on('click', function() {
        $('#size-list li').removeClass('active'); // Remove active class from all
        $(this).addClass('active'); // Add active class to the clicked one
    });

    // Handle active class for color list
    $('#color-list li').on('click', function() {
        $('#color-list li').removeClass('active'); // Remove active class from all
        $(this).addClass('active'); // Add active class to the clicked one
    });
  });
</script>

<script>
  function selectSize(size) {
    document.getElementById('selected_size').value = size;

    // Optional: Highlight the selected size
    var sizeList = document.querySelectorAll('#size-list ul li a');
    sizeList.forEach(function(item) {
        item.classList.remove('active');
    });
    // event.target.classList.add('active');
    event.target.parentElement.classList.add('active');

}

function selectColor(color) {
    document.getElementById('selected_color').value = color;

    // Optional: Highlight the selected color
    var colorList = document.querySelectorAll('#color-list ul li a');
    colorList.forEach(function(item) {
        item.classList.remove('active');
    });
    event.target.classList.add('active');
}
</script>

<script>
  window.onload = function() {
    // Pre-select the size if exists
    var selectedSize = document.getElementById('selected_size').value;
    if (selectedSize) {
        var sizeLinks = document.querySelectorAll('#size-list ul li a');
        sizeLinks.forEach(function(link) {
            if (link.innerHTML.trim() == selectedSize) {
                link.parentElement.classList.add('active');
            }
        });
    }

    // Pre-select the color if exists
    var selectedColor = document.getElementById('selected_color').value;
    if (selectedColor) {
        var colorLinks = document.querySelectorAll('#color-list ul li a');
        colorLinks.forEach(function(link) {
            if (link.innerHTML.trim() == selectedColor) {
                link.parentElement.classList.add('active');
            }
        });
    }
};
</script>
@endpush