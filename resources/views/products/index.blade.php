@extends('layouts.app')
@section('content')

<!-- Quote Section -->
@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>Products</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcrumb Sec End -->

@if(!$products->isEmpty())
<!-- Inner Content area Start -->
<section class="blog-sec inner-content-wrapper">
  @if(Session::has('success'))
  <div class="alert alert-success container">
    {{Session::get('success')}}
  </div>
  @endif
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
            <div class="col-lg-4 col-md-6">
                <!-- Single Blog Sec -->
                <div class="single-blog-post">
                    {{-- <div class="post-image">
                        <a href="{{route('product',$product)}}"> 
                            @if($product->img)<img src="{{asset('storage/'.$product->img)}}" alt="" title=""> @endif
                        </a>
                    </div> --}}
                    <div class="post-content">
                        @php
                        Carbon\Carbon::setLocale('en')
                        @endphp
                        <div class="date"> <i class="fa fa-calendar"></i>
                            <span>{{Carbon\Carbon::parse($product->created_at)->diffForHumans()}}</span>
                        </div>
                        <h3> <a href="{{route('addToCart',$product)}}">{{$product->title}}</a> </h3>
                        <p> {!! \Illuminate\Support\Str::limit($product->description ?? '',100,' ...') !!}</p>
                        <h3 class="d-flex justify-content-center">$ {{$product->price}} </h3>
                        <div class="d-flex justify-content-center align-items-center">
                          <a href="{{route('addToCart',$product)}}" class="btn">Add to cart</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <div class="d-flex border-top mt-5">
        <div class="px-5 m-auto pt-3">
            {{ $products->links() }}</div>
    </div>
</section>
@endif


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