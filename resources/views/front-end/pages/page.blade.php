@extends('front-end.master')

@section('meta_title')
  About Us
@endsection

@section('content')

<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="active"><a href="">{{ $info->name }}</a></li>
                </div>
            </div>
        </div>
    </div>


    <section id="brands-brand" class="section-padding">
      <div class="container">
        <div class="row">
             <div class="brands">
               <h2 class="flash-sale-title">{{ $info->name }}⚡</h2>
                <div class="content-description p-2">
                    {!! $info->content !!}  
                </div>
             </div>
        </div>
      </div>
  </section>

@endsection