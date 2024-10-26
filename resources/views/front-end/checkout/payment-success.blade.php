@extends('front-end.master')

@section('meta_title')
  Payment
@endsection

@push('styles')
<style>
	.checkout-form{
		border:1px solid rgba(0,0,0,.1);
		padding:10px;
	}
    .p-40{
        padding:40px 0px;
    }
</style>
@endpush


@section('content')

<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="active"><a href="">Payment</a></li>
                </div>
            </div>
        </div>
    </div>

<section id="payment-method" class="p-40">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">Payment Success</div>
                        <div class="card-body">
                            <h4>Your Order has  been confirmed.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection