@extends('layouts.app')
@section('content')

@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>Register</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Register</li>
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
                        <h2>Register Form</h2>
                    </div>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    <form  method="POST" action="{{route('register')}}">
                        @csrf
                            <div class="row">
                              <div class="col-lg-6">
                                  <div class="form-group">
                                    <label>First Name</label>
                                    <input  value="{{ old('first_name') }}"  type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror"  data-error="Please enter your first name">
                                    <div class="help-block with-errors text-danger">@if ($errors->has('first_name')) {{ $errors->first('first_name') }}@endif</div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Last Name</label>
                                  <input  value="{{ old('last_name') }}"  type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror"  data-error="Please enter your last name">
                                  <div class="help-block with-errors text-danger">@if ($errors->has('last_name')) {{ $errors->first('last_name') }}@endif</div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                  <div class="form-group">
                                  <label>Email Address</label>
                                  <input  value="{{ old('email') }}"  type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  data-error="Please enter your email">
                                  <div class="help-block with-errors text-danger">@if ($errors->has('email')) {{ $errors->first('email') }}@endif</div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Phone</label>
                                  <input  value="{{ old('phone') }}"  type="phone" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"  data-error="Please enter your phone">
                                  <div class="help-block with-errors text-danger">@if ($errors->has('phone')) {{ $errors->first('phone') }}@endif</div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label>Password</label>
                                <input  value="{{ old('password') }}"  type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"  data-error="Please enter your password">
                                <div class="help-block with-errors text-danger">@if ($errors->has('password')) {{ $errors->first('password') }}@endif</div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label>Confirm password</label>
                                <input  value="{{ old('password_confirmation') }}"  type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"  data-error="Please Re-enter your password">
                                <div class="help-block with-errors text-danger">@if ($errors->has('password_confirmation')) {{ $errors->first('password_confirmation') }}@endif</div>
                                </div>
                              </div>
                            </div>
                            
                            <div class="col d-flex justify-content-between">
                              <div class="d-flex">
                                <span class="pr-1">Already have an account ?</span> 
                                <a style="text-decoration: underline;" class="breadcrumb-item active text-primary" href="{{ route('showLoginForm') }}">Login</a>
                              </div>
                                
                              <button type="submit" class="btn"> register </button>
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