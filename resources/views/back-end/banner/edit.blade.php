@extends('back-end.backend-master')

@section('admin-title')
 {{ $edit }}
@endsection

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" action="{{ route('banner.update') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                       {{ $edit }}
                      <a href="{{ route('banner.index') }}" class="btn btn-sm btn-info float-end">
                        <i class="fa fa-eye"></i> All Banner
                        </a>
                    </h4>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Type</label>
                      <div class="col-sm-9">
                          <select name="banner_type" class="form-control">
                              <option value="">Select Type</option>
                              <option value="banner-1" {{ $info->banner_type=="banner-1"?"selected":"" }} >Banner-1</option>
                              <option value="banner-2" {{ $info->banner_type=="banner-2"?"selected":"" }} >Banner-2</option>
                              <option value="banner-3" {{ $info->banner_type=="slider_right_top"?"selected":"" }} >
                                Slier Right Top
                              </option>
                              <option value="banner-4" {{ $info->banner_type=="slider_right_bottom"?"selected":"" }} >
                                Slier Right Bottom
                              </option>
                          </select>
                      </div>
                    </div>

                      <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Banner Title</label>
                      <div class="col-sm-9">
                        <input type="text" name="banner_title" class="form-control" id="name" value="{{ $info->banner_title }}" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Banner</label>
                      <div class="col-sm-9">
                        <input type="file" name="banner_image" class="form-control" id="name"/>
                          <img src="{{ asset('/') }}back-end/banner/{{ $info->banner_image }}" style="width:40px;height:40px;">
                      </div>
                    </div>

                      <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Banner Link</label>
                      <div class="col-sm-9">
                        <input type="text" name="banner_link" class="form-control" id="name" value="{{ $info->banner_link }}" />
                      </div>
                    </div>

                    <input type="hidden" name="id" value="{{ $info->id }}">

                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary float-end">
                        <i class="fa fa-paper-plane"></i> Update
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