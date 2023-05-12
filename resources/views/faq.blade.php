@extends('layouts.app')
@section('content')

@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg" @if($background) style="background: url({{asset('storage/'.str_replace('\\','/', $background))}}) " @endif>
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>FAQs</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">FAQs</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcrumb Sec End -->

<!-- Inner Content area Start --> 
<section class="faq-area inner-content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="section-title">
          <h2>Frequently Asked  Questions</h2>
        </div>
        <div class="faq-accordion">
          <ul class="accordion">
            @foreach ($faqs as $faq)
            <li class="accordion-item">
              @php
                  $active = ($loop->index == 0)? "active":"";
                  $show = ($loop->index == 0)? "show":"";
              @endphp
              <a class="accordion-title @php echo $active @endphp" href="javascript:void(0)">
                <i class="fa fa-plus"></i> {{ $loop->index+1 }}.{{$faq->question}}
              </a>
              <div class="accordion-content @php echo $show @endphp ">
                <p>{{$faq->response}}</p>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="user-area-style">
          <div class="contact-form-action">
            <div class="account-title">
              <h2>Still Got Questions?</h2>
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
            <form method="POST" action="{{route('question')}}">
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <input value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Name">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <input value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <textarea value="{{ old('content') }}" name="content" class="form-control @error('content') is-invalid @enderror" id="message" rows="8" placeholder="Text here"></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn mb-0" type="submit"> Submit now </button>
                </div>
              </div>
            </form>
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