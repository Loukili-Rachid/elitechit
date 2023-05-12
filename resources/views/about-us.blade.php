@extends('layouts.app')
@section('content')

@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg" @if(setting('site.about_image')) style="background: url({{asset('storage/'.str_replace('\\','/', setting('site.about_image')))}}) " @endif>
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>About Us</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">About</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcrumb Sec End -->

<!-- About Area area Start --> 
<section class="about-sec pt-120">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-12 col-lg-6">
          <div class="about-img">
            <img src="{{asset('storage/'.setting('site.about_image'))}}" class="img-fluid" alt="">
          </div>
         </div>
         <div class="col-sm-12 col-md-12 col-lg-6">
           <div class="about-txt">
             <h3>Work With Our Teams</h3>
             <p>{{setting('site.about_text')}}</p>
             <ul class="list-style-one mt-4">
              @foreach (App()->services as $service)
                <li>{{$service->name}}</li>
              @endforeach
            </ul>    
            <a href="/about-us" class="btn mt-3">Read More</a>        
           </div>
        </div>
      </div>
   </div>
</section>
<!-- About Area area End --> 
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