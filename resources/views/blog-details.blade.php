@extends('layouts.app')
@section('content')

@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg" @if($background) style="background: url({{asset('storage/'.str_replace('\\','/', $background))}}) " @endif>
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>Blog</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
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
        <div class="col-lg-8">
          <div class="blog-details-content">
            <div class="blog-details-img"> @if($post->img)<img class="img-fluid" src="{{asset('storage/'.$post->img)}}" alt=""> @endif </div>
            <div class="blog-top-content">
              <div class="news-content">
                @php
                  Carbon\Carbon::setLocale('en')   
                @endphp
                <ul class="admin">
                  <li class="float"> <i class="bx bx-calendar-alt"></i> {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </li>
                </ul>
                <h3>{{$post->title}}</h3>
                <p>{!!$post->body!!}</p>
              </div>
              
              <div class="row">
                @php
                $content = str_replace("[","",$post->photos);
                $content = str_replace("]","",$content);
                $photos = explode(",",$content);
                @endphp
                @foreach($photos as $photo)
                <div class="col-lg-6 col-md-6">
                  <div class="single-blog-post-img"> <img src="{{asset('storage/'.$photo)}}" alt=""> </div>
                </div>
                @endforeach
              </div>
            </div>
            <ul class="social">
              <li> <span>Share this post:</span> </li>
              <li> <a href="{{App()->communication->twitter}}" target="_blank"> <i class="bx bxl-twitter"></i> </a> </li>
              <li> <a href="{{App()->communication->instagram}}" target="_blank"> <i class="bx bxl-instagram"></i> </a> </li>
              <li> <a href="{{App()->communication->facebook}}" target="_blank"> <i class="bx bxl-facebook"></i> </a> </li>
              <li> <a href="{{App()->communication->youtube}}" target="_blank"> <i class="bx bxl-youtube"></i> </a> </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="widget-sidebar">
            <div class="sidebar-widget categories">
              <h3>All Services</h3>
              <ul>
                @foreach(App()->services as $service)
                <li><a href="{{route('service',$service->slug)}}">{{$service->name}}</a></li>
                @endforeach
                
              </ul>
            </div>
            <div class="sidebar-widget latest-news">
              <h3 class="widget-title">The Latest News</h3>
              <ul>
                @foreach($latestPosts as $latestPost)
                <li> <a href="{{route('post',$latestPost->slug)}}"> {{$latestPost->title}} </a>
                  @php
                    Carbon\Carbon::setLocale('en')   
                  @endphp
                   <span>{{Carbon\Carbon::parse($latestPost->created_at)->diffForHumans()}}</span>
                </li>
                @endforeach
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