@extends('layouts.app')
@section('content')


@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg" @if($background) style="background: url({{asset('storage/'.str_replace('\\','/', $background))}}) " @endif>
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>Gallery</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Gallery</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcrumb Sec End -->

<!-- Inner Content area Start --> 
<section class="gallery-area inner-content-wrapper">
  <div class="container">
    <div class="row">
        @foreach ($galleries as $gallery)
        <div class="col-lg-4 col-sm-6">
          <div class="gallery-box">
            <div class="gallery-img"> <img src="{{asset('storage/'.$gallery->image)}}">
              <div class="gallery-overlay"> <a href="{{asset('storage/'.$gallery->image)}}"><i class="ti-plus"></i></a> </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @if ($all)
      <div class="gallery-btn text-center mt-25"> <a href="{{route('gallery','all')}}" class="btn">Browse All</a> </div>      
      @endif
  </div>
</section>
<!-- Inner Content Area End --> 

@if(setting('site.Call_To_Action_Section'))
  @include('components.cta')
@endif
@if(setting('site.Client_Testimonials_Section'))
  @include('components.teatimonials')
@endif

@if(setting('site.Pricing_table_Section'))
  @include('components.pricing')
@endif
@endsection