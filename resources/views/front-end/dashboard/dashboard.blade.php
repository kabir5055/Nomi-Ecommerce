@extends('front-end.master')

@section('meta_title')
Dashboard || User
@endsection

@push('styles')
<style>
 body {
  font-family: Arial, sans-serif;
  background-color: #f8f9fa;
}



.card {
  border: none;
  /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
  border-radius: 0;
  border: 1px solid rgba(0,0,0,.1);
}

.card-title {
  font-size: 18px;
  margin-bottom: 10px;
}

.card-body h2 {
  font-size: 36px;
  font-weight: bold;
}

.list-group-item {
  border: none;
  padding: 10px 0;
}

.h2{
  margin-bottom:0!important;
}

.user-dashbaord-area .breadcrumb-area {
	padding: 5px 0;
	margin-top: 0px;
    border-bottom: 0;
}

.user-dashbaord-area .breadcrumb {
	background-color: transparent;
	padding: 5px 0;
	margin-bottom: 0;
	float: right;
	margin-top: -40px;
}
.profile_text {
    font-size: 18px;
    font-weight: 500;
    margin-left: -10px;
}

.product-card {
      border-radius: 0;
      color: #fff;
      text-align: center;
      padding: 20px;
    }
    .product-card .icon {
        width: 44px;
        height: 44px;
        line-height: 46px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        font-size: 16px;
        margin-bottom: 15px;
        color: #fff;
        margin-left: 40%;
    }
    .cart-card {
      background-color: #00c49a;
    }
    .wishlist-card {
      background-color: #ff4d67;
    }
    .order-card {
      background-color: #ffb600;
    }
    .product-count {
      font-size: 18px;
      font-weight: bold;
    }
    .product-desc {
      font-size: 14px;
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
                <h4 class="profile_text">Dashboard</h4>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li><a class="active">Dashboard</a></li>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-4">
                <div class="product-card cart-card">
                    <div class="icon">
                    <i class="fa fa-shopping-cart"></i> 
                    </div>
                    <div class="product-count">0 Product(s)</div>
                    <div class="product-desc">in your cart</div>
                </div>
                </div>

                <div class="col-md-4">
                <div class="product-card wishlist-card">
                    <div class="icon">
                    <i class="fa fa-heart"></i> <!-- Bootstrap icon for wishlist -->
                    </div>
                    <div class="product-count">0 Product(s)</div>
                    <div class="product-desc">in your wishlist</div>
                </div>
                </div>

                <div class="col-md-4">
                <div class="product-card order-card">
                    <div class="icon">
                    <i class="fa fa-building"></i> <!-- Bootstrap icon for orders -->
                    </div>
                    <div class="product-count">0 Product(s)</div>
                    <div class="product-desc">you ordered</div>
                </div>
            </div>
        </div>

      </main>
    </div>
  </div>
</div>
@endsection