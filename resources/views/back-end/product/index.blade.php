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
                    {{ $read }}
                    <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary float-end">+Add New</a>
                  </h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Approved</th>
                          <th>Featured</th>
                          <th>Todays Deal</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $i=1
                        @endphp
                        @foreach($lists as $key=>$info)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>
                            @if($info->product_image!='')
                            <img src="{{ asset('/') }}back-end/product/product/{{ $info->product_image }}" style="width:30px;height: 30px;">
                            @else
                            <img src="{{ asset('/') }}back-end/images/user/default.jpg" style="width:30px;height: 30px;">
                            @endif
                          </td>
                         
                          <td>{{ $info->product_name }}</td>
                          <td>{{ $info->sale_price }}</td>
                          <td>
                            @if($info->status==1)
                            <a href="{{ route('product.inactive',$info->id) }}" class="btn btn-sm btn-info">Yes</a>
                            @else
                            <a href="{{ route('product.active',$info->id) }}" class="btn btn-sm btn-secondary">No</a>
                            @endif
                          </td>

                           <td>
                            @if($info->is_featured==1)
                            <a href="{{ route('product.nofeatured',$info->id) }}" class="btn btn-sm btn-success">Yes</a>
                            @else
                            <a href="{{ route('product.featured',$info->id) }}" class="btn btn-sm btn-secondary">No</a>
                            @endif
                          </td>

                           <td>
                            @if($info->is_todays_deal==1)
                            <a href="{{ route('product.todays.deal.inactive',$info->id) }}" class="btn btn-sm btn-success">Yes</a>
                            @else
                            <a href="{{ route('product.todays.deal.active',$info->id) }}" class="btn btn-sm btn-secondary">No</a>
                            @endif
                          </td>

                          <td>
                            <a href="" class="btn btn-sm btn-info">
                              <i class="fa fa-eye"></i>
                            </a>

                             <a href="{{ route('product.duplicate',$info->id) }}" class="btn btn-sm btn-success">
                              <i class="fa fa-clone text-white"></i>
                            </a>

                             <a href="{{ route('product.edit',$info->id) }}" class="btn btn-sm btn-primary">
                              <i class="fa fa-edit"></i>
                            </a>

                            <a href="{{ route('product.delete',$info->id) }}" class="btn btn-sm btn-danger">
                              <i class="fa fa-trash"></i>
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