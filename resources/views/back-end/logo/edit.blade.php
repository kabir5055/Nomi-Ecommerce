@extends('back-end.backend-master')

@section('admin-title')
 {{ $edit }}
@endsection

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" action="{{ route('logo.update') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                       {{ $edit }}
                      <a href="{{ route('logo.index') }}" class="btn btn-sm btn-info float-end">
                        <i class="fa fa-eye"></i> All Logo
                        </a>
                    </h4>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Frontend Logo</label>
                      <div class="col-sm-9">
                        <input type="file" name="frontend_logo" class="form-control" id="name"/>
                          <img src="{{ asset('/') }}back-end/logo/{{ $info->frontend_logo }}" style="width:40px;height:40px;">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Admin Logo</label>
                      <div class="col-sm-9">
                        <input type="file" name="backend_logo" class="form-control" id="name"/>
                          <img src="{{ asset('/') }}back-end/logo/{{ $info->backend_logo }}" style="width:40px;height:40px;">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Favicon</label>
                      <div class="col-sm-9">
                        <input type="file" name="favicon" class="form-control" id="name"
                        />
                        <img src="{{ asset('/') }}back-end/logo/{{ $info->favicon }}" style="width:40px;height:40px;">
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