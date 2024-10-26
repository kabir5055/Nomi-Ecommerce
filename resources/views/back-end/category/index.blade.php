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
                    <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary float-end">+Add New</a>
                  </h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Icon</th>
                          <th>Banner</th>
                          <th>Name</th>
                          <th>Home Show</th>
                          <!-- <th>Status</th> -->
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
                            @if($info->cat_icon!='')
                            <img src="{{ asset('/') }}back-end/category/icon/{{ $info->cat_icon }}" style="width:30px;height: 30px;">
                            @else
                            <img src="{{ asset('/') }}back-end/images/user/default.jpg" style="width:30px;height: 30px;">
                            @endif
                          </td>

                            <td>
                            @if($info->cat_banner1!='')
                            <img src="{{ asset('/') }}back-end/category/banner/{{ $info->cat_banner1 }}" style="width:30px;height: 30px;">
                            @else
                            <span>No Banner</span>
                            @endif
                          </td>

                          <td>{{ $info->cat_name }}</td>

                          <!-- <td>
                            @if($info->status==1)
                            <span class="btn btn-sm btn-info">Active</span>
                            @else
                            <span class="btn btn-sm btn-warning">Inactive</span>
                            @endif
                          </td> -->

                          <td>
                            @if($info->home_show==1)
                            <a href="{{ route('category.home.show.no',$info->id) }}" class="btn btn-sm btn-info">Yes</a>
                            @else
                            <a href="{{ route('category.home.show.yes',$info->id) }}" class="btn btn-sm btn-warning">No</a>
                            @endif
                          </td>

                          <td>
                          	<a href="{{ route('category.edit',$info->id) }}" class="btn btn-sm btn-primary">
                          		<i class="fa fa-edit"></i>
                          	</a>
                            
                            @if($info->category_count_count>0 || $info->category_product_count>0)
                          	<button type="button" class="btn btn-sm btn-danger" disabled="">
                          		<i class="fa fa-trash"></i>
                          	</button>
                            @else
                            <a href="{{ route('category.delete',$info->id) }}" class="btn btn-sm btn-danger">
                              <i class="fa fa-trash"></i>
                            </a>
                            @endif

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