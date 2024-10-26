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
                <h4 class="card-title m-0">Update Profile</h4>
            </div>
            <div class="card-body">
                 <form action="{{ route('front.user.profile.update.store') }}" method="post" enctype="multipart/form-data">
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
                            @if(Auth::user()->image)
                                <img src="{{ asset('front-end/assets/images/user/'.Auth::user()->image) }}" alt="Profile" class="rounded-circle mb-2" style="width: 100px; height: 100px;">
                            @else
                                <img src="{{ asset('front-end/assets/images/user/user.png') }}" alt="Profile" class="rounded-circle mb-2" style="width: 100px; height: 100px;">
                            @endif <br>

                            <label for="">Avater <span class="text-danger">*</span> </label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>

                        <div class="form-group">
                            <label for="">Name <span class="text-danger">*</span> </label>
                            <input type="text" value="{{Auth::user()->name}}" name="name" class="form-control" placeholder="Name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Email</label>
                            <input type="email" value="{{Auth::user()->email}}" name="email" class="form-control" placeholder="E-Mail">
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Phone <span class="text-danger">*</span></label>
                            <input type="text"value="{{Auth::user()->phone}}" name="phone" class="form-control" placeholder="Phone No">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                     <div class="btn-area mt-3">
                        <button type="submit" class="btn btn-md btn-change-password">
                            <i class="fa fa-lock"></i> Update
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