
@extends('front-end.master')

@section('meta_title')
  All Categories
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
                        <li class="active"><a href="">Categories</a></li>
                </div>
            </div>
        </div>
    </div>

@if(count($categories)>0)
<section id="brands-brand" class="section-padding">
      <div class="container">
        <div class="row">
             <div class="brands">
               <h2 class="flash-sale-title">All Categories⚡</h2>
                 <div class="row">
                   
                   @foreach($categories as $category)
                      <!-- Brand 1 -->
                      <div class="col-6 col-md-3 col-lg-2 mb-4">
                        <div class="brand-card">
                           <a href="{{ route('front.category.products',$category->cat_slug) }}">
                            @if(isset($catInfo->cat_icon))
                                        <img src="{{ asset('/') }}back-end/category/icon/{{ $category->cat_icon }}" data-src="{{ asset('/') }}back-end/category/icon/{{ $category->cat_icon }}" class="lazyload brand-logo">
                                        @else
                                        <img src="https://placehold.co/100x100/png" class="img-fluid">
                                        @endif
                                    </a>
                          <p class="brand-name">
                            {{ $category->cat_name }}
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