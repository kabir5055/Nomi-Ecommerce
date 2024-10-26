@extends('front-end.master')

@section('meta_title')
  Contact Us
@endsection

@push('styles')
<style>
     
   #contact-page-box-area{margin:20px 0px}.contact-section{background-color: #fff;padding: 40px}.contact-icon{font-size: 25px;color: white;background-color: #5bc0de;border-radius: 50%;padding: 20px;width: 60px;height: 60px;display: flex;align-items: center;justify-content: center;margin: 0 auto}.contact-details{font-weight: bold;margin-top: 15px}.contact-item{text-align: center;padding: 20px 10px;background: #fff;min-height: 220px;border: 1px solid rgba(0,0,0,.1);margin-bottom: 10px}.contact-item h5{margin-top: 15px;font-weight: bold;text-transform: uppercase;font-size: 16px!important}.contact-item p{margin: 0;color: #333333c2;line-height: 21px;font-size: 14px}
</style>
@endpush

@section('content')

<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="active"><a href="">Contact Us</a></li>
                </div>
            </div>
        </div>
    </div>


    <section id="contact-page-box-area">
        <div class="container">
            <div class="row">
                  <div class="col-md-3">
                     <div class="contact-item">
                        <i class="fa fa-map-marker contact-icon"></i>
                        <h5>OFFICE Address</h5>
                        <p>
                            {{ $general->address??'' }}
                        </p>
                    </div>
                  </div>

                  <div class="col-md-3">
                     <div class="contact-item">
                        <i class="fa fa-phone contact-icon"></i>
                        <h5>PHONE NUMBER</h5>
                        <p>
                            {{ $general->phone??'' }}
                        </p>
                    </div>
                  </div>

                  <div class="col-md-3">
                     <div class="contact-item">
                        <i class="fa fa-phone contact-icon"></i>
                        <h5>Support</h5>
                        <p>
                            {{ $general->phone??'' }}
                        </p>
                    </div>
                  </div>

                  <div class="col-md-3">
                     <div class="contact-item">
                        <i class="fa-solid fa-envelope contact-icon"></i>
                        <h5>EMAIL Address</h5>
                         <p>
                             {{ $general->email??'' }}
                         </p>
                    </div>
                  </div>
            </div>
        </div>
    </section>

@endsection