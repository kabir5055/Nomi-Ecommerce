@extends('back-end.backend-master')

@section('admin-title')
 {{ $edit }}
@endsection

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" action="{{ route('slider.update') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                       {{ $edit }}
                      <a href="{{ route('slider.index') }}" class="btn btn-sm btn-info float-end">
                        <i class="fa fa-eye"></i> All Brand
                        </a>
                    </h4>

                      <div class="form-group row">
                    <label class="col-md-3">Image <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                      <div class="custom-file">
                        <label
                          class="custom-file-label"
                          for="validatedCustomFile"
                          >Choose file...</label
                        >
                        <input
                          type="file" name="image"
                          class="custom-file-input"
                          id="validatedCustomFile"
                        />
                        <div class="invalid-feedback">
                          Example invalid custom file feedback
                        </div><br>
                        <img src="{{ asset('/') }}back-end/slider/{{ $info->image }}" style="width:40px;height:40px;">
                      </div>
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