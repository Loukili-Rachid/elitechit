@if(!App()->plans->isEmpty())
<!-- Pricing Table Sec Start -->
<section class="pricing-sec">
    <div class="container">
        <div class="sec-title mb-0">
            <h2>Pricing <span>Table</span></h2>
        </div>
        <div class="card-deck mb-3">
            @foreach (App()->plans as $plan)
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="card h-100 text-center pb-3 border-0 mb-5">
                        <div class="single-ticket m-0 mb-2">
                            <div class="inner-box">
                                <div class="plan-header">
                                    <h2 class="plan-price">${{ $plan->price }}<small>/{{ $plan->price_type }}</small>
                                    </h2>
                                    <div class="plan-duration">{{ $plan->name }}</div>
                                </div>
                                <ul class="plan-stats pt-2 pb-0 px-1">
                                    @foreach ($plan->options as $option)
                                        <li>{{ $option->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="pricing-buy-it-now position-absolute d-flex align-self-center">
                            <a href="javascript:void(0)" class="btn">Buy Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Pricing Table Sec End -->
@endif
