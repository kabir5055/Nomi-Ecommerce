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

<div class="user-dashbaord-area">
<div class="container mt-3 mb-3">
    <div class="row">

      <!-- Sidebar -->
      @include('front-end/sidebar/sidebar')

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4">
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
                            <h4>Your Ordered Item List</h4>
                        </div>
                        <div class="cart-product">
                            <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Date</th>
                                        <th>Order No.</th>
                                        <th>Total Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i = 1;
                                        $total = 0; 
                                    @endphp

                                    @foreach($orders as $info)
                                   
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $info->date }}</td>
                                        <td>{{ $info->order_no }} &#2547;</td>
                                        <td>{{ $info->grand_total }}</td>
                                        <td>
                                            <a href="{{ route('front.purchase.history.details', $info->id) }}" class="trash-btn">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="continue-back">
                                <a href="{{ route('front.shop') }}" class="nomi-cart-btn">
                                    <i class="fa-solid fa-arrow-left-long"></i> Continue Shopping
                            </a>

                            <a href="{{ route('front.home') }}" class="nomi-cart-btn mdn">
                                    <i class="fa-solid fa-home"></i> Back To Home
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
        </section>

        </main>
    </div>
  </div>
</div>

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
