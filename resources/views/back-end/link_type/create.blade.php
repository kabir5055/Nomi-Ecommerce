@extends('back-end.backend-master')

@section('admin-title')
    {{ $create }}
@endsection

@section('admin-content')
<div class="row">
    <div class="col-12 form-area">
        <div class="col-md-8">
            <div class="card">
                <form class="form-horizontal" action="{{ route('link_type.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $create }}
                            <a href="{{ route('link_type.index') }}" class="btn btn-sm btn-info float-end">
                                <i class="fa fa-eye"></i> All Link Type
                            </a>
                        </h4>

                        <div class="form-group row">
                            <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary float-end">
                                <i class="fa fa-paper-plane"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('admin-styles')
<style>
    .form-area {
        padding: 30px 0px;
        background: #fff;
    }
</style>
@endpush