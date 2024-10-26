@extends('front-end.master')

@section('meta_title')
  Payment
@endsection

@push('styles')
<style>
	.checkout-form{
		border:1px solid rgba(0,0,0,.1);
		padding:10px;
	}
    .p-40{
        padding:40px 0px;
    }

    .category-title{border-bottom: 1px solid #002366;margin-bottom: 10px;position: relative}.category-title h4{text-transform: uppercase;font-weight: 600;font-size: 15px;color: #000;letter-spacing: 1px}.table thead{background: var(--btn-bg);background:#000;color: #fff}.cart-product table th{background: #0056b3;color: #fff}.cart-product table th{background: #e6f2ff;color: #000}.coupon-area{border: 1px solid rgba(0,0,0,.1);padding: 10px;height: 140px;margin-bottom: 10px}button.coupon-btn{color: #000;padding: 10px 25px;text-decoration: none;font-size: 16px;float: left;border: none;margin-top: 10px;border:1px solid #007bff;font-weight: 600}

    .category{padding: 20px;background: #fff;margin: 0;border: 1px solid rgba(0,0,0,.1)}.update-btn{background: #002366;border: none;font-size: 12px;padding: 5px 5px;border-radius:3px;color: #fff}.trash-btn{background:transparent;color: #818a91}.trash-btn:hover{background:transparent;color: red}#quantity_input{width: 60px}.nomi-cart-btn{font-size: 14px;background: #002366;padding: 10px 15px;margin: 10px 10px 0px 0px;color: #fff;transition: transform 0.3s ease}.nomi-cart-btn:hover{background: #ff6f00;transform: scale(1.05)}.continue-back{margin-top: 10px}
</style>
@endpush


@section('content')

<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="active"><a href="">Payment</a></li>
                </div>
            </div>
        </div>
    </div>

<section id="checkout-page" class="p-40">
    <div class="container">
        <div class="row">
            <!-- Left Section (Payment Method) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Payment Method</div>
                        @error('payment_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    <div class="card-body">
                        <form action="{{ route('front.payment.store') }}" method="POST">
                            @csrf
                            <input type="radio" name="payment_type" value="cash"> Cash On Delivery <br/>
                            <input type="radio" name="payment_type" value="bkash"> Bkash<br/>
                            <input type="radio" name="payment_type" value="nagad"> Nagad<br/>
                            <input type="radio" name="payment_type" value="rocket"> Rocket<br/>

                            <input type="hidden" id="hidden_shipping_charge" name="shipping_charge">
                            <input type="hidden" id="hidden_grand_total" name="grand_total">
                            <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                            <input type="hidden" name="discount_amount" value="{{ session('discountAmount', 0) }}">

                            <button type="submit" id="checkout_btn" class="nomi-cart-btn">
                                Place Order <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Section (Summary, Coupon, Shipping) -->
            <div class="col-md-6">
                <div class="coupon-area">
                    <form action="{{ route('front.apply.coupon') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Coupon Code</label>
                            <input type="text" name="coupon_code" placeholder="Apply Coupon Code" class="form-control">
                            <button type="submit" class="coupon-btn">
                                <i class="fa-solid fa-plus"></i> Apply
                            </button>
                        </div>
                    </form>
                </div>

                <div class="summary-product mt-4">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Shipping Area</th>
                                <td>
                                    <select name="shipping_area" class="form-control" id="shipping_charge">
                                        <option value="">Select Shipping Area</option>
                                        <option value="70">Inside Dhaka</option>
                                        <option value="120">Outside Dhaka</option>
                                        @if($sub_total >= $free_shipping_limit->amount)
                                            <option value="0" selected>Free Delivery</option>
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Sub Total</th>
                                <td>
                                   <input type="text" class="form-control" value="{{ $sub_total }} ৳" readonly="">
                                    <input type="hidden" value="{{ $sub_total }}" id="sub_total_price">
                                </td>
                            </tr>
                            <tr>
                                <th>Coupon Discount</th>
                                <td>
                                    @php
                                        $discountAmount = session('discountAmount', 0);
                                        $subTotalAfterDiscount = $sub_total - $discountAmount;
                                    @endphp
                                    <input type="text" class="form-control" value="{{ isset($discountAmount) ? $discountAmount : '0' }} &#2547;" readonly>
                                    <input type="hidden" value="{{ $subTotalAfterDiscount }}" id="sub_total_after_discount">
                                </td>
                            </tr>
                            <tr>
                                <th>Shipping Charge</th>
                                <td>
                                    @if($sub_total >= $free_shipping_limit->amount)
                                        <input type="text" class="form-control" value="0 ৳" readonly="">
                                    @else
                                        <input type="text" class="form-control" id="charge_show" readonly="">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <td>
                                @if($sub_total >= $free_shipping_limit->amount)
                                    <input type="text" class="form-control" value="{{ isset($discountAmount) ? ($sub_total - $discountAmount) : $sub_total }} ৳" readonly="">
                                    <input type="hidden" id="grand_total" value="{{ $sub_total }} ৳">
                                @else
                                    <input type="text" class="form-control" id="grand_total" readonly="">
                                @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    if ($('#shipping_charge').val() === '') {
        $('#checkout_btn').prop('disabled', true);
    }else {
        $('#checkout_btn').prop('disabled', false);
        
        var charge = $('#shipping_charge').val();
        console.log(charge);
        var sub_total_price = $('#sub_total_after_discount').val();

        var totalPrice = parseFloat(charge) + parseFloat(sub_total_price);
        $('#charge_show').val(charge + '৳');
        $('#grand_total').val(totalPrice + '৳');
        $('#hidden_shipping_charge').val(charge);
        $('#hidden_grand_total').val(totalPrice);
    }
    
    $('#shipping_charge').change(function() {
        var charge = $(this).val();
        var sub_total_price = $('#sub_total_after_discount').val();

        if (charge === '') {
            $('#checkout_btn').prop('disabled', true);
        } else {
            $('#checkout_btn').prop('disabled', false);
        }

        var totalPrice = parseFloat(charge) + parseFloat(sub_total_price);
        $('#charge_show').val(charge + '৳');
        $('#grand_total').val(totalPrice + '৳');
        $('#hidden_shipping_charge').val(charge);
        $('#hidden_grand_total').val(totalPrice);
    });
});
</script>
@endpush