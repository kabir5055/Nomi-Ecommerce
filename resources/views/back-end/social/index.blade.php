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
                    <a href="{{ route('social.create') }}" class="btn btn-sm btn-primary float-end">+Add New</a>
                </h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Facebook</th>
                                <th>Twitter</th>
                                <th>Linkedin</th>
                                <th>Youtube</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1
                            @endphp
                            @foreach($lists as $key => $info)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $info->facebook }}</td>
                                <td>{{ $info->twitter }}</td>
                                <td>{{ $info->linkedin }}</td>
                                <td>{{ $info->youtube }}</td>
                                <td>
                                    <a href="{{ route('social.edit', $info->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('social.delete', $info->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Link Type?')">
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
    .table {
        text-align: center;
    }
    .table thead tr th {
        background: #3e5569;
        color: #fff;
    }
    .card .card-title {
        position: relative;
        font-weight: 600;
        margin-bottom: 10px;
        padding: 0px 20px 5px 0px;
    }
</style>
@endpush