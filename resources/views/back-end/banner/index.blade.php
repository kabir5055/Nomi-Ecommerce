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
                    <a href="{{ route('banner.create') }}" class="btn btn-sm btn-primary float-end">+Add New</a>
                  </h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Type</th>
                          <th>Title</th>
                          <th>Link</th>
                          <th>Banner</th>
                          <th>Status</th>
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
                          <td>{{ $info->banner_type }}</td>
                          <td>{{ $info->banner_title??'No Title' }}</td>
                          <td>{{ $info->banner_link??'No Link' }}</td>

                          <td>
                             <img src="{{ asset('/') }}back-end/banner/{{ $info->banner_image }}" style="height:150px;">
                          </td>

                          <td>
                            @if($info->status=='1')
                            <span>Active</span>
                            @else
                            <span>Inactive</span>
                            @endif
                          </td>

                          <td>
                          	<a href="{{ route('banner.edit',$info->id) }}" class="btn btn-sm btn-primary">
                          		<i class="fa fa-edit"></i>
                          	</a>

                          	<a href="{{ route('banner.delete',$info->id) }}" class="btn btn-sm btn-danger">
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