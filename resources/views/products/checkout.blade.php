@extends('layouts.app')
@section('content')

<!-- Quote Section -->
@include('components.quote')
@php $editing = isset($client->address_one) @endphp
<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>Checkout</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
<div class="mt-4 container card">
    <section class="contact-area inner-content-wrapper pt-4 pb-1">
        <div class=" col-lg-12">
            
            <div class="contact-wrap">
                <div class="contact-form" >
                    <div class="contact-title">
                        <h2>billing address</h2>
                    </div>
                    <form  method="POST" action="{{route('purchase')}}" class="card-form ">
                        @csrf
                            <div class="row">
                              <div class="col-lg-6">
                                  <div class="form-group">
                                    <label>First Name <b class="text-danger">*</b></label>
                                    <input  value="{{$client->first_name  }}"  type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror"  data-error="Please enter your first name">
                                    <div class="help-block with-errors text-danger">@if ($errors->has('first_name')) {{ $errors->first('first_name') }}@endif</div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Last Name <b class="text-danger">*</b></label>
                                  <input  value="{{ $client->last_name}}"  type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror"  data-error="Please enter your last name">
                                  <div class="help-block with-errors text-danger">@if ($errors->has('last_name')) {{ $errors->first('last_name') }}@endif</div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                  <div class="form-group">
                                  <label>Address Line 1 <b class="text-danger">*</b></label>
                                  <input  value="{{ old('address_one', ($editing ? $client->address_one : '')) }}"  type="text" name="address_one" id="address_one" class="form-control @error('address_one') is-invalid @enderror"  data-error="Please enter your address Line 1">
                                  <div class="help-block with-errors text-danger">@if ($errors->has('address_one')) {{ $errors->first('address_one') }}@endif</div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Address Line 2 </label>
                                    <input  value="{{ old('address_two', ($editing ? $client->address_two : '')) }}"  type="text" name="address_two" id="address_two" class="form-control @error('address_two') is-invalid @enderror"  data-error="Please enter your address Line 2">
                                    <div class="help-block with-errors text-danger">@if ($errors->has('address_two')) {{ $errors->first('address_two') }}@endif</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label>Country <b class="text-danger">*</b></label>
                                    <select name="country" class="form-control">
                                        <option value="United States">United States</option>
                                    </select>
                                      
                                    <div class="help-block with-errors text-danger">@if ($errors->has('email')) {{ $errors->first('email') }}@endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Zip Code <b class="text-danger">*</b></label>
                                      <input  value="{{ old('zip_code', ($editing ? $client->zip_code : '')) }}"  type="text" name="zip_code" id="zip_code" class="form-control @error('zip_code') is-invalid @enderror"  data-error="Please enter your Zip Code">
                                      <div class="help-block with-errors text-danger">@if ($errors->has('zip_code')) {{ $errors->first('zip_code') }}@endif</div>
                                      </div>
                                  </div>
                              </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label>City <b class="text-danger">*</b></label>
                                    <input  value="{{ old('city', ($editing ? $client->city : '')) }}"  type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror"  data-error="Please enter your city">
                                    <div class="help-block with-errors text-danger">@if ($errors->has('city')) {{ $errors->first('city') }}@endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>State <b class="text-danger">*</b></label>
                                        <select name="state" class="form-control">
                                            <option value="">Select a state</option>
                                            <?php
                                            $states = [
                                                'AL' => 'Alabama',
                                                'AK' => 'Alaska',
                                                'AZ' => 'Arizona',
                                                'AR' => 'Arkansas',
                                                'CA' => 'California',
                                                'CO' => 'Colorado',
                                                'CT' => 'Connecticut',
                                                'DE' => 'Delaware',
                                                'FL' => 'Florida',
                                                'GA' => 'Georgia',
                                                'HI' => 'Hawaii',
                                                'ID' => 'Idaho',
                                                'IL' => 'Illinois',
                                                'IN' => 'Indiana',
                                                'IA' => 'Iowa',
                                                'KS' => 'Kansas',
                                                'KY' => 'Kentucky',
                                                'LA' => 'Louisiana',
                                                'ME' => 'Maine',
                                                'MD' => 'Maryland',
                                                'MA' => 'Massachusetts',
                                                'MI' => 'Michigan',
                                                'MN' => 'Minnesota',
                                                'MS' => 'Mississippi',
                                                'MO' => 'Missouri',
                                                'MT' => 'Montana',
                                                'NE' => 'Nebraska',
                                                'NV' => 'Nevada',
                                                'NH' => 'New Hampshire',
                                                'NJ' => 'New Jersey',
                                                'NM' => 'New Mexico',
                                                'NY' => 'New York',
                                                'NC' => 'North Carolina',
                                                'ND' => 'North Dakota',
                                                'OH' => 'Ohio',
                                                'OK' => 'Oklahoma',
                                                'OR' => 'Oregon',
                                                'PA' => 'Pennsylvania',
                                                'RI' => 'Rhode Island',
                                                'SC' => 'South Carolina',
                                                'SD' => 'South Dakota',
                                                'TN' => 'Tennessee',
                                                'TX' => 'Texas',
                                                'UT' => 'Utah',
                                                'VT' => 'Vermont',
                                                'VA' => 'Virginia',
                                                'WA' => 'Washington',
                                                'WV' => 'West Virginia',
                                                'WI' => 'Wisconsin',
                                                'WY' => 'Wyoming'
                                            ];

                                          
                                            $selectedState = old('state', ($editing ? $client->state : '')); 
                                          
                                            foreach ($states as $code => $name) {
                                              $selected = ($selectedState === $code) ? 'selected' : '';
                                              echo '<option value="' . $code . '" ' . $selected . '>' . $name . '</option>';
                                            }
                                            ?>
                                          </select>
                                          
                                        <div class="help-block with-errors text-danger">@if ($errors->has('state')) {{ $errors->first('state') }}@endif</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label>Phone</label>
                                    <input  value="{{ old('phone', ($editing ? $client->phone : '')) }}"  type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"  data-error="Please enter your phone">
                                    <div class="help-block with-errors text-danger">@if ($errors->has('phone')) {{ $errors->first('phone') }}@endif</div>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label>Company name</label>
                                      <input  value="{{ old('company_name', ($editing ? $client->company_name : '')) }}"  type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror"  data-error="Please enter your company name">
                                      <div class="help-block with-errors text-danger">@if ($errors->has('company_name')) {{ $errors->first('phone') }}@endif</div>
                                    </div>
                                  </div>
                            </div>
                        
                    </div>
                </div>
                                 
        </div>
    </section>
    <div class="row d-flex justify-content-end pb-3 px-3 font-weight-bolder">
        @if ($checkout)
            @auth('client')
                <div class="col-lg-6 alert alert-secondary">
                    <div class="section-title"> <span class="section-span">Payment details</span> </div>
                    <div class="row">
                        <div class="col" >
                            <div class="quote-form">
                                <div class="row">
                                    <input type="hidden" name="payment_method" class="payment-method">
                                    <div class="col-md">
                                        <input  class="form-control @error('card_holder_name') is-invalid @enderror" type="text" id="card-holder-name" name="card_holder_name" placeholder="Card holder name" required>
                                    </div>
                                </div>

                                <!-- Stripe Elements Placeholder -->
                                <div id="card-element" class="my-3 form-control"></div>

                                <div class="d-flex justify-content-end  mt-2">
                                    <button type="submit" class="btn pay" id="card-button"
                                    >
                                        <i class="fa-solid fa-bag-shopping"></i> checkout
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
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
    <div class="row pb-3 px-3 font-weight-bolder">
        <div class="col-lg-6">
            <a class="mr-2 btn"
            href="{{route('products')}}"
            >
            <i class="fa-sharp fa-solid fa-arrow-left"></i> continue shopping
            </a>
        </div>
    </div>
</div>
@if ($checkout)
  @auth('client')
    @section('scripts')
        <script src="https://js.stripe.com/v3/"></script>
    
        <script>
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        
            const elements = stripe.elements();
            
            let style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
            let card = elements.create('card', {style: style})
            card.mount('#card-element')

            let paymentMethod = null
            $('.card-form').on('submit', function (e) {
                $('button.pay').attr('disabled', true)
                if (paymentMethod) {
                    return true
                }
                stripe.confirmCardSetup(
                    "{{ $intent }}",
                    {
                        payment_method: {
                            card: card,
                            billing_details: {name: $('.card_holder_name').val()}
                        }
                    }
                ).then(function (result) {
                    if (result.error) {
                        $('button.pay').removeAttr('disabled')
                    } else {
                        paymentMethod = result.setupIntent.payment_method
                        $('.payment-method').val(paymentMethod)
                        $('.card-form').submit()
                    }
                })
                return false
            })
        </script>
    @endsection
  @endauth
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