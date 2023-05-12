@if(!App()->teams['data']->isEmpty())
    <!-- Our Team Sec Start -->
    <section class="our-team-sec">
        <div class="container">
            <div class="sec-title mb-0">
                <h2>Our <span>Team</span></h2>
            </div>
            <div class="row">
                @foreach (App()->teams['data'] as $team)
                <div class="col-lg-3 col-md-6">
                    <!-- Single Our Team Sec -->
                    <div class="team">
                        <div class="team-image"> <img src="{{asset('storage/'.$team->image.'')}}" alt="">
                            <ul>
                                <li><a href="{{$team->facebook}}"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{$team->twitter}}"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="{{$team->linkedin}}"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="{{$team->google_plus}}"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-info">
                            <h5><a href="/our-team">{{$team->full_name}}</a></h5>
                            <span>{{$team->role}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Our Team Sec End -->
@endif