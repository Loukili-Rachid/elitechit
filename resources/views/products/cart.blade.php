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
            <h1>Cart</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcrumb Sec End -->
@if(Session::has('success'))
<div class="alert alert-success container mt-4">
  {{Session::get('success')}}
</div>
@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">
      {{Session::get('error')}}
    </div>
@endif
<div class="mt-5 container card">
  <livewire:cart /> 
  <div class="row pb-3 px-3 font-weight-bolder">
    <div class="col-lg-6">
        <a class="mr-2 btn"
          href="{{route('products')}}"
        >
        <i class="fa-sharp fa-solid fa-arrow-left"></i> continue shopping
        </a>
    </div>
    @if ($checkout)
        @auth('client')
          <div class="col-lg-6 d-flex justify-content-end ">
              <a href="{{route('showCheckout')}}" class="btn"
              >
                  <i class="fa-solid fa-bag-shopping"></i> confirm your order
              </a>
        </div>
        @else
            <div class="col-lg-6 d-flex justify-content-end ">
                <a href="{{route('showRegistrationForm')}}" class="btn"
                >
                    <i class="fa-solid fa-bag-shopping"></i> checkout
                </a>
            </div>
        @endauth
    @endif
  </div>
</div>

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