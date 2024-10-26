@extends('back-end.backend-master')

@section('admin-title')
{{ $read }}
@endsection

@section('admin-content')
<div class="row">
			<div class="col-12">
				<div class="card">
                <div class="card-body">
                  <h5 class="card-title">
                    {{ $read }} <span class="text-danger">{{ $todays->format('d-M-Y') }}</span>
                  </h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Order No</th>
                          <th>Subtotal</th>
                          <th>Shipping Charge</th>
                          <th>Coupon Discount</th>
                          <th>Grand Total</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $i=1
                        @endphp
                        @foreach($orders as $order)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $order->order_no }}</td>
                            <td>{{ $order->subtotal_amount }}</td>
                            <td>{{ $order->shipping_charge }}</td>
                            <td class="text-danger">{{ $order->coupon_amount }}</td>
                            <td>{{ $order->grand_total }}</td>
                            <td>
                                <a href="{{ route('order.details',['info_id'=>$order->info_id,'id'=>$order->id]) }}" class="btn btn-sm btn-primary">
                                    Details
                                </a>

                                <a href="{{ route('order.print',['info_id'=>$order->info_id,'id'=>$order->id]) }}" class="btn btn-sm btn-info">
                                    Print
                                </a>

                            </td>
                          </tr>
                        @endforeach
                       
                      </tbody>
             
                    </table>
                  </div>
                </div>
              </div>
			</div>
		</div>
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
</style>
@endpush