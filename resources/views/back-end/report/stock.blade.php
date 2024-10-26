@extends('back-end.backend-master')

@section('admin-title')
 Stock Report
@endsection

@section('admin-content')
<div class="row">
			<div class="col-12">
				<div class="card">
                <div class="card-body">
                  <h5 class="card-title">
                    Stock Report
                  </h5>
                  <div class="table-responsive">
                    <table
                      id="example11"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Product</th>
                          <th>Purchase Qty</th>
                          <th>Sale Qty</th>
                          <th>Stock Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $i=1
                        @endphp
                        @foreach($lists as $data)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $data['product_name'] }}</td>
                          <td>{{ $data['product_quantity'] }}</td>
                          <td>{{ $data['sale_quantity'] }}</td>
                          <td>{{ $data['product_quantity'] - $data['sale_quantity'] }}</td>
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