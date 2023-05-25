@extends('layouts.app')
@section('content')

@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>Login</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcrumb Sec End -->

<!-- Inner Content area Start --> 
<section class="contact-area inner-content-wrapper">
    <div class="container col-lg-8 col-md-10">
        <div class="contact-info">
            <div class="alert alert-success container mt-4">
                <p>
                    Thanks for signing up! Before getting started, 
                </p>
                @if (!Session::has('success'))
                <p>
                  could you verify your email address by clicking on the link we just emailed to you?
                  If you didn't receive the email, we will gladly send you another.
                </p>
                @endif
                @if (Session::has('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
                 @endif
    
            <div class="mt-4 d-flex align-items-center justify-content-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
    
                    <div>
                        <button
                        class="btn"
                        type="submit"
                        >
                            {{ __('Resend Verification Email') }}
                        </button>
                    </div>
                </form>
    
                <a href="{{route('logout')}}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Log Out') }}
                </a>
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