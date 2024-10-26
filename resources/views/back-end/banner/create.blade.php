@extends('back-end.backend-master')

@section('admin-title')
 {{ $create }}
@endsection

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                       Add New Banner
                      <a href="{{ route('banner.index') }}" class="btn btn-sm btn-info float-end">
                        <i class="fa fa-eye"></i> All Banner
                        </a>
                    </h4>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Banner Type <span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                          <select name="banner_type" class="form-control">
                              <option value="">Select Type</option>
                              <option value="banner-1">Banner-1</option>
                              <option value="banner-2">Banner-2</option>
                              <option value="slider_right_top">Slier Right Top</option>
                              <option value="slider_right_bottom">Slier Right Bottom</option>
                          </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Banner Title</label>
                      <div class="col-sm-9">
                        <input type="text" name="banner_title" class="form-control" id="name" placeholder="Banner Title" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Banner Image<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        <input type="file" name="banner_image" class="form-control" id="name"/>
                      </div>
                    </div>

                     <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Banner Link</label>
                      <div class="col-sm-9">
                        <input type="text" name="banner_link" class="form-control" id="name" placeholder="Banner Link" />
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
    .form-area{
    padding:30px 0px;
    background: #fff;
  }
</style>
@endpush