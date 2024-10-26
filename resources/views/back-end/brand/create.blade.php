@extends('back-end.backend-master')

@section('admin-title')
 {{ $create }}
@endsection

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                       {{ $create }}
                      <a href="{{ route('brand.index') }}" class="btn btn-sm btn-info float-end">
                        <i class="fa fa-eye"></i> All Brand
                        </a>
                    </h4>
                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label"
                        >Name <span class="text-danger">*</span></label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text" name="brand_name"
                          class="form-control"
                          id="name"
                          placeholder="Name"
                        />
                      </div>
                    </div>

                      <div class="form-group row">
                    <label class="col-md-3">Icon</label>
                    <div class="col-md-9">
                      <div class="custom-file">
                        <input
                          type="file" name="brand_icon"
                          class="custom-file-input"
                          id="validatedCustomFile"
                          required
                        />
                        <label
                          class="custom-file-label"
                          for="validatedCustomFile"
                          >Choose file...</label
                        >
                        <div class="invalid-feedback">
                          Example invalid custom file feedback
                        </div>
                      </div>
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