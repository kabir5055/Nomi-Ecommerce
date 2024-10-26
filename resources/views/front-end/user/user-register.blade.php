@extends('front-end.master')

@section('meta_title')
User Registration
@endsection

@push('styles')
<style>
    #login-area{padding:50px 0px}#login-area .card{border-radius: 0}#login-area .card-header h4{padding:0px;margin:0!important;text-align:center;font-size: 16px;}button.submit_btn:hover{background: #ff6f00}
    button.submit_btn {
	height: 40px;
	/* margin-left: 10px; */
	/* width: 130px; */
	border-radius: 20px;
	color: #fff !important;
	background: #002366;
	font-size: 16px;
	font-weight: 600;
	width: 100%;
}
    label{
        font-size:14px!important;
    }
    input{
        border-radius: 0px!important;
        font-size:14px!important;
    }
    .remember-me{
        font-size:14px!important;
    }
</style>
@endpush

@section('content')
<section id="login-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-box">
                    <form action="{{ route('front.user.register.store') }}" method="POST">
                        @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Registration with Nomi Online Shop</h4>
                        </div>
                        <div class="card-body">

                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span> </label>
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-2">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="E-Mail">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone No">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-2">
                                    <label for="">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm submit_btn">
                              <i class="fa fa-paper-plane"></i>  Submit
                            </button>
                        </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

@endpush