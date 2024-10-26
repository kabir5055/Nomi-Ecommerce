@extends('front-end.master')

@section('meta_title')
Change Password
@endsection

@push('styles')
 <style>
   .btn-change-password{
    height: 40px;
    margin-left: 10px;
    border-radius: 20px;
    color: #fff !important;
    background: #002366;
    font-size: 14px;
    font-weight: 600;
   }
.btn-change-password:hover{
    background: #ff6f00;
   }
 </style>
@endpush

@section('content')
<div class="user-dashbaord-area">
<div class="container mt-3 mb-3">
    <div class="row">

      <!-- Sidebar -->
      @include('front-end/sidebar/sidebar')

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4">
        
        
      <div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                
                <div class="col">
                <h4 class="profile_text">Change Password</h4>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li><a href="">Dashboard</a></li>
                        <li class="active"><a>Change Password</a></li>
                </div>
            </div>
        </div>
    </div>

        <div class="mt-2">
           <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Change Password</h4>
            </div>
            <div class="card-body">
                 <form action="{{ route('front.user.change.password.store') }}" method="post">
                  @csrf
                      <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                      @endif -->
                      <div class="form-group">
                        <label for="">Current Password</label>
                        <input type="password" name="current_password" placeholder="Current Password" class="form-control">
                      </div>
                      @error('current_password')
                          <small class="text-danger">{{ $message }}</small>
                      @enderror

                     <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" name="new_password" placeholder="New Password" class="form-control">
                     </div>
                      @error('new_password')
                          <small class="text-danger">{{ $message }}</small>
                      @enderror

                     <div class="form-group mt-3">
                        <label for="">Confirm Password</label>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                     </div>
                      @error('confirm_password')
                          <small class="text-danger">{{ $message }}</small>
                      @enderror

                     <div class="btn-area mt-3">
                        <button type="submit" class="btn btn-md btn-change-password">
                            <i class="fa fa-lock"></i> Change Password
                        </button>
                     </div>
                 </form>
            </div>

           </div>
        </div>

      </main>
    </div>
  </div>
</div>
@endsection