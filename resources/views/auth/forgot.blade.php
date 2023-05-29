@extends('layouts.app')
@section('content')

@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>Forgot password</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Forgot password</li>
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
            <div class="contact-wrap">
                <div class="contact-form" >
                    <div class="contact-title">
                        <h2>Forgot password</h2>
                    </div>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                          {{Session::get('error')}}
                        </div>
                    @endif
                    <form  method="POST" action="{{route('sendResetLink')}}">
                        @csrf
                            <div class="col">
                                <p>
                                    Enter your email address and we will send you a link to reset your password
                                </p>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                <label>Email Address</label>
                                <input  value="{{ old('email') }}"  type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  data-error="Please enter your email">
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <div class="d-flex">
                                    <span class="pr-1">Already have an account ?</span> 
                                    <a style="text-decoration: underline;" class="breadcrumb-item active text-primary" href="{{ route('showLoginForm') }}">Login</a>
                                </div>
                                <button type="submit" class="btn"> Send Reset Password Link </button>
                            </div>
                    </form>
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