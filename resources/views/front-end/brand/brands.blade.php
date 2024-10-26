@extends('front-end.master')

@section('meta_title')
  All Brands
@endsection

@push('styles')
<style>

  
  </style>
@endpush

@section('content')

<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="active"><a href="">Brands</a></li>
                </div>
            </div>
        </div>
    </div>


    @if(count($brands)>0)
<section id="brands-brand" class="section-padding">
      <div class="container">
        <div class="row">
             <div class="brands">
               <h2 class="flash-sale-title">All Brands⚡</h2>
                 <div class="row">
                   
                   @foreach($brands as $brand)
                      <!-- Brand 1 -->
                      <div class="col-6 col-md-3 col-lg-2 mb-4">
                        <div class="brand-card">
                             <a href="{{ route('front.brand.products',$brand->brand_slug) }}">
                                @if(!empty($brand->brand_icon))
                                        <img src="{{ asset('/') }}back-end/brand/{{ $brand->brand_icon }}" class="brand-logo img-fluid">
                                        @else
                                        <img src="https://placehold.co/100x100/png" class="img-fluid">
                                        @endif
                                    </a>
                          <p class="brand-name">
                            {{ $brand->brand_name }}
                          </p>
                        </div>
                      </div>
                      @endforeach

                 </div>
             </div>
        </div>
      </div>
  </section>
@endif

@endsection

@push('scripts')

@endpush