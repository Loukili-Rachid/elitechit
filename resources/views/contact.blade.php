@extends('layouts.app')
@section('content')

@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>Contact</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
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
  <div class="container">
    <div class="row align-items-center">
        <div class="col-lg-8">
          <div class="contact-wrap">
            <div class="contact-form">
              <div class="contact-title">
                <h2>Drop us Message for Any Query</h2>
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
              <form id="contactForm" method="POST" action="{{route('contact')}}" >
                @csrf
                <div class="row">
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Name</label>
                      <input  value="{{ old('name') }}"  type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"  data-error="Please enter your name">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Email Address</label>
                      <input  value="{{ old('email') }}"  type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  data-error="Please enter your email">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Phone</label>
                      <input  value="{{ old('phone') }}"  type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"  data-error="Please enter your phone" maxlength="20">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Subject</label>
                      <input  value="{{ old('subject') }}"  type="text" name="subject" id="msg_subject" class="form-control @error('subject') is-invalid @enderror"  data-error="Please enter your subject">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label>Message</label>
                      <textarea  value="{{ old('message') }}"  name="message" class="form-control @error('message') is-invalid @enderror" id="message" cols="30" rows="10"  data-error="Write your message"></textarea>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                    <button type="submit" class="btn"> Send message </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="contact-info">
            <h3>Our Contact Details</h3>
            <ul class="address">
              <li class="location"> <i class="bx bxs-location-plus"></i> <span>Address</span> <a href="{{setting('site.map_address')}}">{{setting('site.address')}}</a> </li>
              <li> <i class="bx bxs-phone-call">
                </i>
                 <span>Phone</span> <a href="tel:{{App()->communication->phone}}">{{App()->communication->phone}}</a>
                 <a href="tel:{{App()->communication->fax}}">{{App()->communication->fax}}</a>
                 <a href="tel:{{App()->communication->mobile}}">{{App()->communication->mobile}}</a>
                </li>
              <li> <i class="bx bxs-envelope"></i> <span>Email</span> <a href="mailto:{{App()->communication->email}}">{{App()->communication->email}}</a> </li>
            </ul>
            <div class="sidebar-follow-us">
              <h3>Follow us:</h3>
              <ul class="social-wrap">
                <li> <a href="{{App()->communication->twitter}}" target="_blank"> <i class="bx bxl-twitter"></i> </a> </li>
                <li> <a href="{{App()->communication->instagram}}" target="_blank"> <i class="bx bxl-instagram"></i> </a> </li>
                <li> <a href="{{App()->communication->facebook}}" target="_blank"> <i class="bx bxl-facebook"></i> </a> </li>
                <li> <a href="{{App()->communication->youtube}}" target="_blank"> <i class="bx bxl-youtube"></i> </a> </li>
              </ul>
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