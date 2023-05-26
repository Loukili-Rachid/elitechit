@extends('layouts.app')
@section('content')

@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>Product</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcrumb Sec End -->

<!-- Inner Content area Start --> 
<section class="blog-sec blog-details-area inner-content-wrapper">
  <div class="container">
    <div class="row">
        <div class="col">
          <div class="blog-details-content">
            <div class="blog-details-img"> @if($product->image)<img class="img-fluid" src="{{asset('storage/'.$product->image)}}" alt=""> @endif </div>
            <div class="blog-top-content">
              <div class="news-content">
                @php
                  Carbon\Carbon::setLocale('en')   
                @endphp
                <ul class="admin">
                    <li class="float"> <i class="bx bx-calendar-alt"></i> {{Carbon\Carbon::parse($product->created_at)->diffForHumans()}} </li>
                </ul>
                <div  class="d-flex justify-content-between align-items-center">
                    <h3>{{$product->title}}</h3>
                    <form method="POST" action="{{ route('addToCart', ['id' => $product->id]) }}">
                        @csrf
                        <button type="submit" class="btn">Add to cart</button>
                    </form>
                </div>
                <p>{!!$product->body!!}</p>
              </div>
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