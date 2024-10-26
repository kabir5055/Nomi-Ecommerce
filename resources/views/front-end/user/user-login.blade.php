@extends('front-end.master')

@section('meta_title')
User Login
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
	font-size: 14px;
	font-weight: 500;
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
                    <div class="card">
                    <form action="{{ route('front.user.login.store') }}" method="POST">
                    @csrf
                        <div class="card-header">
                            <h4 class="card-title">Login with Nomi Online Shop</h4>
                        </div>
                        <div class="card-body">
                            
                                <div class="form-group">
                                    <label for="">Name or Phone <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" placeholder="Name or Phone" name="name_phone">
                                    @error('name_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-2">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="remember-me mt-2">
                                    <input type="checkbox"> Remember me
                                    <a href="" class="float-end">Forgot password?</a>
                                </div>

                        
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm submit_btn">
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