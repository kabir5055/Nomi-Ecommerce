@extends('back-end.backend-master')

@section('admin-title')
 {{ $edit }}
@endsection

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                       {{ $edit }}
                      <a href="{{ route('category.index') }}" class="btn btn-sm btn-info float-end">
                        <i class="fa fa-eye"></i> All Category
                        </a>
                    </h4>
                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label"
                        >Name</label
                      >
                      <div class="col-sm-9">
                        <input type="text" name="cat_name" class="form-control" id="name" value="{{ $info->cat_name }}"/>

                      </div>
                    </div>

                      <div class="form-group row">
                    <label class="col-md-3">Icon</label>
                    <div class="col-md-9">
                      <div class="custom-file">
                        <input
                          type="file" name="cat_icon"
                          class="custom-file-input"
                          id="validatedCustomFile"
                        />
                        <label
                          class="custom-file-label"
                          for="validatedCustomFile"
                          >Choose file...</label
                        >
                        <div class="invalid-feedback">
                          Example invalid custom file feedback
                        </div>
                        <img src="{{ asset('/') }}back-end/category/icon/{{ $info->cat_icon }}" style="width:40px;height:40px;">
                      </div>
                    </div>
                  </div>

                       <div class="form-group row">
                    <label class="col-md-3">Banner</label>
                    <div class="col-md-9">
                      <div class="custom-file">
                        <input
                          type="file" name="cat_banner1"
                          class="custom-file-input"
                          id="validatedCustomFile"
                        />
                        <label
                          class="custom-file-label"
                          for="validatedCustomFile"
                          >Choose file...</label
                        >
                        <div class="invalid-feedback">
                          Example invalid custom file feedback
                        </div>
                        <img src="{{ asset('/') }}back-end/category/banner/{{ $info->cat_banner1 }}" style="width:40px;height:40px;">
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="id" value="{{ $info->id }}">


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
    .form-area{
    padding:30px 0px;
    background: #fff;
  }
</style>
@endpush