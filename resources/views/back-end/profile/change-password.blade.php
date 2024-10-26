@extends('back-end.backend-master')

@section('admin-title')
 Change Password
@endsection

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" action="{{ route('profile.change.password.updated') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                       Change Password 
                    </h4>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">New Password</label>
                      <div class="col-sm-9">
                        <input type="password" name="new_password" class="form-control" id="name" placeholder="New Password" value="{{ old('new_password') }}"/>
                        @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>


                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Confirm Password</label>
                      <div class="col-sm-9">
                        <input type="password" name="confirm_password" class="form-control" id="name" placeholder="Confirm Password" />
                         @error('confirm_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>


                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary float-end">
                        <i class="fa fa-paper-plane"></i> Change Password
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