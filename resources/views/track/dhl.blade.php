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
            <h1>Tracking shipment</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Tracking shipment</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcrumb Sec End -->

<!-- Inner Content area Start -->
<section class="blog-sec inner-content-wrapper">
  @if(Session::has('success'))
  <div class="alert alert-success container" id="successAlert">
    {{Session::get('success')}}
  </div>
  @endif

  @if(Session::has('error'))
  <div class="container alert alert-danger" id="errorAlert">
      {{Session::get('error')}}
  </div>
  @endif


  <div class="container px-1 px-md-4 mx-auto">
    <div class="card" style="background-color: #ECEFF1;">
      <form id="contactForm" method="POST" action="{{route('trackingDhl')}}" >
        @csrf
        <div class="row px-3 top " >
          <div class="col-lg-8 col-md-8 col-sm-6">
            <div class="form-group">
              <input style="padding: 20px 30px"  value="{{ old('tracking_number', $trackingNumber) }}" type="text" name="tracking_number"class="form-control @error('tracking_number') is-invalid @enderror"maxlength="20">
              <div class="help-block with-errors text-danger">@if ($errors->has('tracking_number')) {{ $errors->first('tracking_number') }}@endif</div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6">
            <button type="submit" class="btn" style="padding: 9px 20px">Track </button>
          </div>
        </div>
      </form>
      @if (!empty($data))
      <div class="row d-flex justify-content-between px-3 top">
        <div class="d-flex flex-column">
            <p class="mb-0">Status: <span  class="font-weight-bold">{{$data["shipments"][0]["status"]["status"]??''}}</span></p>
            <p class="mb-0">Location address: <span class="font-weight-bold">{{$data["shipments"][0]["status"]["location"]["address"]["addressLocality"]??''}}  {{$data["shipments"][0]["status"]["location"]["address"]["postalCode"]??''}}</span></p>
            <p> description: <span class="font-weight-bold">{{$data["shipments"][0]["status"]["description"]??''}}</span></p>
        </div>
        <div class="d-flex">
          <h5>DHL <span class="text-primary font-weight-bold">#{{$tracking_number ?? ''}}</span></h5>
        </div>
      </div>
      <!-- Add class 'active' to progress -->
      <div class="row d-flex justify-content-center">
          <div class="col-12">
          <ul id="progressbar" class="text-center">
              <li class="{{ in_array($data['shipments'][0]['status']['statusCode'], ['delivered', 'transit', 'pre-transit']) ? 'active' : '' }} step0"></li>
              <li class="{{ in_array($data['shipments'][0]['status']['statusCode'], ['delivered', 'transit', 'pre-transit']) ? 'active' : '' }} step0"></li>
              <li class="{{ in_array($data['shipments'][0]['status']['statusCode'], ['delivered', 'transit']) ? 'active' : '' }} step0"></li>
              <li class="{{ in_array($data['shipments'][0]['status']['statusCode'], ['delivered']) ? 'active' : '' }} step0"></li>
          </ul>
          </div>
      </div>
      <div class="row top">
        <div class="col-12 d-flex justify-content-end pb-3"><a href="#" class="font-weight-bold" onclick="showAllUpdates(event)">All Shipment Updates <i class="fa-solid fa-angle-down"></i> <i style="display: none;" class="fa-solid fa-angle-up"></i></a></div>
      </div>
      <div class="row top"  id="allUpdates" style="display: none;">
        @foreach ($data["shipments"][0]["events"] as $event )
          @php
            $date = new DateTime($event["timestamp"]);
            $formattedDate = $date->format("l, n/j/Y");
            // $time = DateTime::createFromFormat("g:i A", $event["timestamp"]);
            $formattedTime = $date->format("g:i A");
          @endphp
          <div class="row d-flex icon-content">
            <div class="col-lg-2 col-md-2">
              @if ($loop->first)
                <i style="font-size: 18px" class="fa-solid fa-location-dot"></i>
              @else
                <i class="fa-solid fa-caret-up"></i>
              @endif
            </div>
            <div class="col-lg-2 col-md-3 ">{{$formattedDate}}</div>
            <div class="col-lg-2 col-md-2 ">{{$formattedTime}}</div>
            <div class="col-lg-6 col-md-5 d-flex flex-column">
              <p class="font-weight-bold">{{$event["location"]["address"]["addressLocality"]??''}} {{$event["location"]["address"]["postalCode"]??''}}<br>
                {{$event["status"]??''}}
              </p>
            </div>
          </div>
        @endforeach
      </div>
      @endif
    </div>
</div>
</section>


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
@section('scripts')
<script>
  // Function to show all shipment updates
  function showAllUpdates(event) {
  event.preventDefault();
  
  const allUpdates = document.getElementById('allUpdates');
  const angleDownIcon = document.querySelector('.fa-angle-down');
  const angleUpIcon = document.querySelector('.fa-angle-up');
  
  if (allUpdates.style.display === 'block') {
    allUpdates.style.display = 'none';
    angleDownIcon.style.display = 'inline-block';
    angleUpIcon.style.display = 'none';
  } else {
    allUpdates.style.display = 'block';
    angleDownIcon.style.display = 'none';
    angleUpIcon.style.display = 'inline-block';
  }
}

// Close the success alert after 5 seconds
setTimeout(function() {
  $('#errorAlert').fadeOut('slow');
}, 6000);
</script>
@endsection