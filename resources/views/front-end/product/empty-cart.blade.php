@extends('front-end.master')

@section('meta_title')
Empty Cart
@endsection

@push('styles')
<style>
    #login-area{padding:30px 0px 50px 0px}.card{border-radius: 0}.card-header{padding: 5px 18px;background: #e6f2ff}button.submit_btn{height: 40px;margin-left: 10px;width: 130px;border-radius: 20px;color: #fff !important;background: #007bff;font-size: 16px;font-weight: 600}button.submit_btn:hover{background: #0056b3}.cart-content{padding:50px 0px;text-align: center}.cart-content-image{text-align: center;margin-left: auto;margin-right: auto;padding: 20px 0px;position: relative;overflow: hidden}.cart-content-image img{transition: transform 0.5s ease;width:150px;height:150px;object-fit: cover;animation: zoom 3s infinite}.cart-content-image:hover img{transform: scale(1.2)}@keyframes zoom{0%{transform: scale(1)}50%{transform: scale(1.2)}100%{transform: scale(1)}}a.return_btn{border-radius: 20px;color: #fff !important;background: #007bff;font-size: 16px;font-weight: 600;padding:10px 20px;text-decoration: none;margin-top:10px!important}

</style>
@endpush

@section('content')
<section id="login-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                 <div class="empty-cart">
                      <div class="cart-content">
                          <div class="cart-content-image">
                              <img src="{{ asset('/') }}front-end/assets/images/cart.png" alt="">
                          </div>
                         <div class="cart-content-content mt-3 mb-4">
                              <h4>Your Cart is Currently Empty</h4>
                          <p>
                              Must add item on the cart before your proceed to checkout
                          </p>
                         
                         </div>
                         
                        <a href="{{ route('front.home') }}" class="return_btn">
                            <i class="fa fa-arrow-left"></i>
                            Back to Home
                        </a>
                    
                      </div>
                 </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

@endpush