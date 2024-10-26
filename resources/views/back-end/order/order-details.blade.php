@extends('back-end.backend-master')

@section('admin-title')
{{ $read }}
@endsection

@push('admin-styles')
<style>
  span#content-right{float: right}.table th, .table thead th{font-weight: 500;width: 200px}.circle{border-radius: 20px;padding: 0px 10px}.table td, .table th{padding: 5px}a{color:#fff}a:hover{color:#fff}
</style>
@endpush

@section('admin-content')
<section id="order-details-area">
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-md-1 order-area-box">
          <div class="order-detail-top">
            <div class="row">
               <div class="col-md-6">
                 <div class="shipping-address">
                     <div class="shipping-head">
                       <h4>Shipping Information</h4>
                     </div>
                     <div class="shipping-content">
                         <p>
                            <span>Name:</span>
                            <span>{{ $shipping->name }}</span>

                            <br/>

                            <span>Email:</span>
                            <span>{{ $shipping->email??'' }}</span>

                            <br/>

                            <span>Phone No:</span>
                            <span>{{ $shipping->phone }}</span>

                            <br/>

                            <span>Address:</span>
                            <span>{{ $shipping->shipping_address }}</span>

                         </p>
                     </div>
                 </div>
               </div>
               <div class="col-md-6">
                   <div class="order-info">
                     <div class="order-head">
                       <h4>Order Information</h4>
                     </div>
                     <div class="order-content">
                         <p>
                           <span>Order No:</span>
                           <span id="content-right">{{ $orderNo->order_no }}</span> <br/>

                           <span>Delivery Status:</span>
                           <span id="content-right" class="btn btn-sm btn-primary circle">
                            <a href="{{ route('order.approved.delivery.status',['info_id'=>$orderNo->info_id,'id'=>$orderNo->id]) }}">{{ $orderNo->delivery_status }}</a>
                           </span>
                           <br/>

                           <span>Payment Status:</span>
                           <span id="content-right" class="btn btn-sm btn-secondary circle">
                             <a href="{{ route('order.approved.payment.status',['info_id'=>$orderNo->info_id,'id'=>$orderNo->id]) }}">{{ $orderNo->payment_status }}</a>
                           </span>
                           <br/>

                           <span>Payment Method:</span>
                           <span id="content-right">Cash On Delivery</span>
                         </p>
                     </div>
                   </div>
               </div>
            </div>
          </div>

          <div class="product-information">
               <div class="row">
      <div class="col-12">
        <div class="card">
                <div class="card-body">
                  <h5 class="card-title">
                    {{ $read }}
                  </h5>
                  <div class="table-responsive">
                    <table class="table table-bordered">
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
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($orders as $info)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <img src="{{ asset('/') }}back-end/product/product/{{ $info->product->product_image }}" class="img-fluid">
                                </td>
                                <td>{{ $info->product->product_name }}</td>
                                <td>{{ $info->sale_price }}</td>
                                <td>{{ $info->size }}</td>
                                <td>{{ $info->color }}</td>
                                <td>{{ $info->quantity }}</td>
                                <td>{{ $info->unit_total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="col-md-5 offset-md-7 summary-product">
                    <table class="table table-bordered">
                        <tbody>

                            <tr>
                                <th>Sub Total</th>
                                <td>
                                    <span>{{ $orderNo->subtotal_amount }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Coupon Discount</th>
                                <td>
                                    <span>{{ $orderNo->coupon_amount }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Shipping Charge</th>
                                <td>
                                    <span>{{ $orderNo->shipping_charge }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <td>
                                   <span>{{ $orderNo->grand_total }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                  </div>
                </div>
              </div>
      </div>
    </div>
          </div>

        </div>
      </div>
    </div>
</section>
@endsection

@push('admin-styles')
<style>
    .table{
    	text-align: center;
    }
	.table thead tr th{
		background: #3e5569;
		color:#fff;
	}
	.card .card-title {
	position: relative;
	font-weight: 600;
	margin-bottom: 10px;
	padding: 0px 20px 5px 0px;
}
#order-details-area{
  background: #f5f5f5;
}
.order-area-box{
  border:1px solid rgba(0,0,0,.2);
  padding:20px;
}
.order-info{
  float: right;
}
.img-fluid{
  width:50px;
}
</style>
@endpush