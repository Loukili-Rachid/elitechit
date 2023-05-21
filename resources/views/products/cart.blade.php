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
        >
        <i class="fa-sharp fa-solid fa-arrow-left"></i> continue shopping
        </a>
    </div>
    @if ($checkout)
        @auth('client')
            <div class="col-lg-6 mt-2 alert alert-secondary">
                <div class="section-title"> <span class="section-span">Payment details</span> </div>
                <div class="row">
                    <div class="col" >
                        <form class="quote-form card-form " method="POST" action="{{route('purchase')}}">
                            @csrf
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