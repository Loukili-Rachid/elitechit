@if(!App()->teatimonials->isEmpty())
   <!-- Teatimonials Sec Start -->
   <section class="testimonial-sec">
    <div class="container">
        <div class="sec-title">
            <h2>Client <span>Testimonials</span></h2>
        </div>
        <div class="indurance-testimonial-slider">
            @foreach (App()->teatimonials as $teatimonial)
            <div class="single-testimonial-slide">
                <div class="testimonial-item">
                    <div class="testimonial-content"> <span>{{$teatimonial->content}}</span> </div>
                    <div class="testimonial-author">
                        <div class="author-image"> <img src="{{asset('storage/'.$teatimonial->image)}}" alt=""> </div>
                        <div class="author-name">
                            <h6 class="title">{{$teatimonial->owner}}</h6>
                            <span>{{$teatimonial->role}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Teatimonials Sec End -->
@endif