@extends('front-end.master')

@section('meta_title')
 Cart Product
@endsection

@push('styles')
<style>
  #featured-category-area{margin: 20px 0px;padding: 0}.category-title{border-bottom: 1px solid #002366;margin-bottom: 10px;position: relative}.category-title h4{text-transform: uppercase;font-weight: 600;font-size: 15px;color: #000;letter-spacing: 1px}.table thead{background: var(--btn-bg);background:#000;color: #fff}.cart-product table th{background: #0056b3;color: #fff}.cart-product table th{background: #e6f2ff;color: #000}.coupon-area{border: 1px solid rgba(0,0,0,.1);padding: 10px;height: 140px;margin-bottom: 10px}button.coupon-btn{color: #000;padding: 10px 25px;text-decoration: none;font-size: 16px;float: left;border: none;margin-top: 10px;border:1px solid #007bff;font-weight: 600}

.category{padding: 20px;background: #fff;margin: 0;border: 1px solid rgba(0,0,0,.1)}.update-btn{background: #002366;border: none;font-size: 12px;padding: 5px 5px;border-radius:3px;color: #fff}.trash-btn{background:transparent;color: #818a91}.trash-btn:hover{background:transparent;color: red}#quantity_input{width: 60px}.nomi-cart-btn{font-size: 14px;background: #002366;padding: 10px 15px;margin: 0px 10px 0px 0px;color: #fff;transition: transform 0.3s ease}.nomi-cart-btn:hover{background: #ff6f00;transform: scale(1.05)}.continue-back{margin-top: 10px}
  </style>
@endpush

@section('content')
<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="active"><a href="">View Cart</a></li>
                </div>
            </div>
        </div>
    </div>

<section id="featured-category-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 category">
                <div class="category-title">
                    <h4>Your Ordered Item</h4>
                </div>
                <div class="cart-product">
                    <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @php 
                                $i = 1;
                                $total = 0; 
                            @endphp

                            @foreach($carts as $info)
                            @php
                                $total += $info->unit_total;
                                
                            @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                @if(!empty($info->product->product_image))
                                    <img src="{{ asset('/') }}back-end/product/product/{{ $info->product->product_image }}" class="img-fluid" style="width:50px;height:50px;">
                                @else
                                    <img src="https://placehold.co/50x50/png" class="img-fluid" alt="Placeholder Image" style="width:50px;height:50px!important;">
                                @endif
                                </td>
                                <td>{{ $info->product->product_name }}</td>
                                <td>{{ $info->sale_price }} &#2547;</td>
                                <td>{{ $info->size != "null" ? $info->size : '' }}</td>
                                <td>{{ $info->color != "null" ? $info->color : '' }}</td>
                                <td>
                                       <form action="{{ route('front.product.cart.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $info->product_id }}">
                                            <input type="hidden" name="color" value="{{ $info->color }}">
                                            <input type="hidden" name="size" value="{{ $info->size }}">
                                            <input type="number" name="quantity" min="1" value="{{ $info->quantity }}" id="quantity_input">
                                            <button type="submit" class="update-btn">
                                                Update
                                            </button>
                                        </form>
                                </td>
                                <td>{{ $info->unit_total }} &#2547;</td>
                                <td>
                                    <a href="{{ route('front.product.cart.delete', $info->id) }}" class="trash-btn">
                                         <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                

              <div class="continue-back">
                    <a href="{{ route('front.home') }}" class="nomi-cart-btn">
                        <i class="fa-solid fa-arrow-left-long"></i> Continue Shopping
                </a>

                 <a href="{{ route('front.home') }}" class="nomi-cart-btn mdn">
                        <i class="fa-solid fa-home"></i> Back To Home
                </a>
              </div>

                
                </div>
            </div>

            <div class="col-md-5 offset-md-7">
                <div class="summary-product bg-white p-4 mt-3">
                    <div class="category-title mt-1 d-flex justify-content-between align-items-center">
                        <h4>Cart Summary</h4>
                        <p class="coupon-btn bg-success text-white px-2" style="border-radius: 5px;">{{ $i-1 }} Item</p>
                    </div>
                    <table class="table table-bordered mt-2">
                        <tbody>
                            <tr>
                                <th>Sub Total</th>
                                <td>
                                    {{$total}} ৳
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                    <form action="{{ route('front.shipping.address.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sub_total" value="{{ $total }}">
                        <button type="submit" id="checkout_btn" class="nomi-cart-btn">
                            Proceed to Checkout <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#shipping_charge').change(function() {
        $('#checkout_btn').hide();
        var charge = $(this).val();
        var sub_total_price = $('#sub_total_price').val();
        // var sub_total_price = $('#sub_total_after_discount').val();

        if (charge == '') {
            $('#checkout_btn').hide();
        } else {
            $('#checkout_btn').show();
        }

        var totalPrice = parseFloat(charge) + parseFloat(sub_total_price);
        $('#charge_show').val(charge + '৳');
        $('#total_show').val(totalPrice + '৳');
        $('#hidden_shipping_charge').val(charge);
        $('#hidden_grand_total').val(totalPrice);
    });
});
</script>
@endpush
