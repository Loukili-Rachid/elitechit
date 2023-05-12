@if(!$posts->isEmpty())
<!-- Inner Content area Start -->
<section class="blog-sec inner-content-wrapper">
    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6">
                <!-- Single Blog Sec -->
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="{{route('post',$post->slug)}}"> 
                            @if($post->img)<img src="{{asset('storage/'.$post->img)}}" alt="" title=""> @endif
                        </a>
                    </div>
                    <div class="post-content">
                        @php
                        Carbon\Carbon::setLocale('en')
                        @endphp
                        <div class="date"> <i class="fa fa-calendar"></i>
                            <span>{{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
                        </div>
                        <h3> <a href="{{route('post',$post->slug)}}">{{$post->title}}</a> </h3>
                        <p> {!! \Illuminate\Support\Str::limit($post->body ?? '',100,' ...') !!}</p>
                        <a href="{{route('post',$post->slug)}}" class="btn">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <div class="d-flex border-top mt-5">
        <div class="px-5 m-auto pt-3">
            {{ $posts->links() }}</div>
    </div>
</section>
@endif