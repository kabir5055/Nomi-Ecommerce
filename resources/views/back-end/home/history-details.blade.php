@extends('back-end.backend-master')

@push('admin-styles')
<style>
  #todays_order-area{margin: 20px 0px;padding: 0}.category-title{border-bottom: 1px solid #002366;margin-bottom: 10px;position: relative}.category-title h4{text-transform: uppercase;font-weight: 600;font-size: 15px;color: #000;letter-spacing: 1px}.table thead{background: var(--btn-bg);background:#000;color: #fff}.cart-product table th{background: #0056b3;color: #fff}.cart-product table th{background: #e6f2ff;color: #000}.coupon-area{border: 1px solid rgba(0,0,0,.1);padding: 10px;height: 140px;margin-bottom: 10px}button.coupon-btn{color: #000;padding: 10px 25px;text-decoration: none;font-size: 16px;float: left;border: none;margin-top: 10px;border:1px solid #007bff;font-weight: 600}

.category{padding: 20px;background: #fff;margin: 0;border: 1px solid rgba(0,0,0,.1)}.update-btn{background: #002366;border: none;font-size: 12px;padding: 5px 5px;border-radius:3px;color: #fff}.trash-btn{background:transparent;color: #818a91}.trash-btn:hover{background:transparent;color: red}.quantity_input{width: 60px}.quantity-btn{width: 20px;}.nomi-cart-btn{font-size: 14px;background: #002366;padding: 10px 15px;margin: 0px 10px 0px 0px;color: #fff;transition: transform 0.3s ease}.nomi-cart-btn:hover{background: #ff6f00;transform: scale(1.05)}.continue-back{margin-top: 10px}
  </style>
@endpush

@section('admin-title')
{{ $general->site_name??'' }} || Dashboard
@endsection

@section('admin-content')
<section id="featured-category-area">
  <div class="container">
      <div class="row">
          <div class="col-md-12 category">
              <div class="category-title">
                  <h4>Today's Ordered Details</h4>
              </div>
              <div class="cart-product">
                  <div class="table-responsive">
                  <table class="table table-bordered text-center">
                      <thead>
                          <tr>
                              <th>SN</th>
                              <th>Product Image</th>
                              <th>Product Name</th>
                              <th>Quantity</th>
                              <th>Sale Price</th>
                              <th>Unit total</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php 
                              $i = 1;
                              $total = 0; 
                          @endphp

                          @foreach($order_details as $info)
                         
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
                              <td>{{ $info->quantity }}</td>
                              <td>{{ $info->sale_price }} &#2547; ৳</td>
                              <td>{{ $info->unit_total }} ৳</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
          
      </div>
      <div class="col-md-5 offset-md-7">
          <div class="summary-product bg-white p-4 mt-3">
              <div class="category-title mt-1 d-flex justify-content-between align-items-center">
                  <h4>Summary</h4>
                  </div>
                      <table class="table table-bordered mt-2">
                          <tbody>
                             
                                  <tr>
                                      <th>Total Amount</th>
                                      <td>
                                          {{$order_details->first()->order->subtotal_amount}} ৳
                                      </td>
                                  </tr>

                                  <tr>
                                      <th>Shipping Charge</th>
                                      <td>
                                          {{$order_details->first()->order->shipping_charge}} ৳
                                      </td>
                                  </tr>

                                  <tr>
                                      <th>Cupon Discount</th>
                                      <td>
                                          {{$order_details->first()->order->coupon_amount}} ৳
                                      </td>
                                  </tr>

                                  <tr>
                                      <th>Grand Total</th>
                                      <td>
                                          {{$order_details->first()->order->grand_total}} ৳
                                      </td>
                                  </tr>
                              
                          </tbody>
                      </table>
                  <div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection

@push('admin-scripts')
<script>
</script>
@endpush