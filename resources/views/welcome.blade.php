@extends('layouts.app')
@section('content')
@include('components.quote')

<!-- Slider area Start -->
<section class="slider-area">
    <div class="home-slider owl-carousel owl-theme">
        @foreach ($sliders as $slider)
        <div class="single-slider "
            @if($slider->img) style="background-image: url({{asset('storage/'.str_replace('\\','/',$slider->img))}})" @endif>
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 text-center">
                                <div class="slider-tittle one text-white">
                                    @if($slider->title)<h3> {{$slider->title}} </h3>@endif
                                    @if($slider->body)<div>{!!$slider->body!!}</div>@endif
                                </div>
                                <div class="slider-btn bnt1 text-center"> <a href="/services"
                                        class="box-btn">Services</a> <a href="/contact" class="border-btn">Contact Us
                                    </a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- End Slider End -->

<!-- Service area Start -->
<section class="feature-area">
    <div class="container">
        <div class="row">
            @foreach ($topServices as $topService)
            <div class="col-lg-4 col-md-6">
                <div class="single-feature-sec text-center">
                    <div class="service-icon"> @if($topService->icon) <i class="{{$topService->icon}}"></i> @endif </div>
                    <div class="service-content">
                        <a href="{{route('service',$topService?->slug)}}">
                            <h2>{{$topService->name}}</h2>
                        </a>
                        <p> {{ $topService->excerpt ?? '' }} </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Service Area End -->

@if(setting('site.about_us_Section'))
    <!-- About Area area Start -->
    <section class="about-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="about-img">
                        @if(setting('site.about_image')) <img src="{{asset('storage/'.setting('site.about_image'))}}" class="img-fluid" alt=""> @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="about-txt">
                        <h3>Work With Our Teams</h3>
                        <p>{{setting('site.about_text')}}</p>
                        <ul class="list-style-one mt-4">
                            @foreach ($services as $service)
                            <li><a href="{{route('service',$service?->slug)}}">{{$service->name}}</a></li>
                            @endforeach
                        </ul>
                        <a href="/about-us" class="btn mt-3">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area area End -->
@endif

@if(setting('site.Call_To_Action_Section'))
    @include('components.cta')
@endif

@if(setting('site.Our_Services_Section') and !$services->isEmpty())
    <!-- Service Sec Start -->
    <section class="service-sec">
        <div class="container">
            <div class="sec-title mb-0">
                <h2>Our <span>Services</span></h2>
            </div>
            <div class="row">
                @foreach ($services as $service)
                <div class="col-lg-4 col-md-6">
                    <!-- Single Service Sec -->
                    <a href="{{url('service-details/'.$service?->slug)}}">
                    <div class="single-services-sec">
                        <div class="services-icon"> @if($service->icon) <i class="{{$service->icon}}"></i> @endif </div>
                        <div class="single-services-content">
                            <h5>{{$service->name}}</h5>
                            <p>{{ $service->excerpt ?? '' }}</p>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--  Service Sec End -->
@endif

@if(setting('site.Client_Testimonials_Section'))
    @include('components.teatimonials')
@endif

@if(setting('site.Our_Team_Section'))
    @include('components.team')
@endif

@if(setting('site.Pricing_table_Section'))
    @include('components.pricing')
@endif

@if(setting('site.Posts_Section'))
    @include('components.posts',['posts'=>$posts])
@endif
@endsection
