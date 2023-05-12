@extends('layouts.app')
@section('content')

<!-- Quote Section -->
@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg" @if($background) style="background: url({{asset('storage/'.str_replace('\\','/', $background))}}) " @endif>
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>Services</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Services</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcrumb Sec End -->

<!-- Inner Content area Start -->
<section class="service-sec inner-content-wrapper" >
  <div class="container">
    <div class="row">
        @foreach ($services as $service)
        <div class="col-lg-4 col-md-6">
          <!-- Single Service Sec -->
          <a href="{{route('service',$service->slug)}}">
          <div class="single-services-sec">
            <div class="services-icon"> @if($service->icon) <i class="{{$service->icon}}"></i> @endif </div>
            <div class="single-services-content">
              <h5>{{$service->name}}</h5>
              <p>{{ $service->excerpt ?? '' }}</p>
            </div>
          </div>
        </a>
        </div>
        @endforeach
     </div>
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
