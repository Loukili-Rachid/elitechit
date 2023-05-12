@extends('layouts.app')
@section('content')

@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg">
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
              <li class="breadcrumb-item active" aria-current="page">Service Details</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Sec End -->

<!-- Inner Content area Start -->
<section class="service-sec services-details-area inner-content-wrapper">
  <div class="container">
    <div class="row">
        <div class="col-lg-4">
          <div class="widget-sidebar">
            <div class="sidebar-widget categories">
              <h3>All Services</h3>
              <ul>
                @foreach ($services as $serviceList)
                <li><a href="{{route('service',$serviceList->slug)}}">{{$serviceList->name}}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="services-details-content">
            <div class="services-details-img mb-30"> @if($service->image)<img class="img-fluid" src="{{asset('storage/'.$service->image)}}" alt="">@endif </div>
            <div class="services-content mb-30">
              <h3>{{$service->name}}</h3>
              <p>{!!$service->body!!}</p>
            </div>
          </div>
        </div>
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
