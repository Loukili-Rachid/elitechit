<footer class="footer">
    <!-- Footer Top -->
    <div class="footer-top"  style="padding-bottom:5px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-widget footer-about widget">
                        <div class="logo">
                            <h3 class="widget-title">About Us</h3>
                        </div>
                        <div class="footer-widget-about-description">
                            <p>{{setting('site.short_about')}}</p>
                        </div>
                    </div>
                </div>


                @foreach (App()->footers['data'] as $footer)
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Footer Links -->
                    <div class="single-widget f-link widget">
                        <h3 class="widget-title">{{$footer->title}}</h3>
                        <ul>

                            @foreach ($footer->items as $item)
                            <li>
                                <i class="{{ $item->icon}}"></i>
                                @php
                                $link = $item->link;
                                if ($link && !str_starts_with($link, 'http')) {
                                $link = url($item->link);
                                }
                                @endphp
                                <a href="{{ $link }}" target="{{$item->target}}"> {{ $item->title}} </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
        <div class="container">
            <div class="row" >
            <div class="social p-3 col-lg-3 col-md-4 col-12" style="display: flex;align-items: center;margin-top: 0px;">
                <ul class="social-icons">
                    <li>
                        <a class="facebook" href="{{App()->communication->facebook}}" target="_blank">
                            <i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a class="twitter" href="{{App()->communication->twitter}}" target="_blank"><i
                            class="fa fa-twitter"></i></a></li>
                    <li><a class="linkedin" href="{{App()->communication->instagram}}" target="_blank"><i
                                class="fa fa-instagram"></i></a></li>
                    <li><a class="pinterest" href="{{App()->communication->youtube}}" target="_blank"><i
                        class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
            @if (App()->seals)
                @foreach(App()->seals as $seal)
                    <div class="col-lg-2 col-md-4 col-4">
                        <a href="{{$seal->link}}" style="display: flex; flex-direction: column; align-items: center; justify-content: space-between; height: 100%;">
                            <div style="height: 60%; width: 100% ; display: flex; justify-content: center; align-items: center ">
                                @if($seal->image)
                                <img src="{{asset('storage/'.$seal->image)}}" alt="{{$seal->image}}" width="70">
                                @endif
                            </div>
                            <div class="text-white" >{!!$seal->title!!}</div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-content">
                        <!-- Copyright Text -->
                        <p>&copy; <span id="year"></span> {{ App()->footers['info']?->title }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!Cookie::get('elitechit-cookie') && app()->cookies)
    <div class="w-100 fixed-bottom p-2 " style=" z-index:100;background: rgba(29,25,25,.8509803921568627);color: #ccc;font-size: 14px;" role="alert">
        <div  class="row">
            <div class="col-md-8">
                {{app()->cookies->body}}
            </div>
            <div class="col-md-4">
                <a href="{{route('privacy-policy')}}" class="btn py-1 read-more px-1 mx-2">
                Read more
                </a>
                <a href="{{route('createCookie')}}" class="btn okey py-1 px-4 mx-1">
                    <i style="color: #ff9d00;" class="fas fa-check"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
    <!--/ End Copyright -->
</footer>

@if(setting('site.page_id'))
<div id="fb-root"></div>
<div id="fb-customer-chat" class="fb-customerchat"></div>
<script defer>
var chatbox = document.getElementById('fb-customer-chat');
chatbox.setAttribute("page_id", {{setting('site.page_id')}});
chatbox.setAttribute("attribution", "biz_inbox");
</script>
<script defer>
    window.fbAsyncInit = function() {
                        FB.init({xfbml: true, version: 'v14.0'});};
                        (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
</script>
@endif

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/fontawesome.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/jquery.meanmenu.min.js')}}"></script>
<script src="{{asset('js/slick.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}" defer></script>
<script src="{{ asset('js/search.js') }}" defer></script>
