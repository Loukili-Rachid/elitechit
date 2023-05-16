<header>    
    <div class="top-bar d-none d-md-block pt-15 pb-15">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xl-8 col-lg-9 col-md-12">
                    <div class="header-info"> <a href="{{setting('site.map_address')}}"> <span class="header-address"><i class="fa fa-map-marker-alt"></i> {{setting('site.address')}}</span></a>
                        <a href="tel:{{App()->communication->phone}}"><span class="header-phone"><i class="fas fa-phone"></i> {{App()->communication->phone}}</span></a>
                        <span class="header-email"><i class="fas fa-envelope"></i> <a href="mailto:{{App()->communication->email}}">{{App()->communication->email}}</a></span> </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-md-5 d-none d-lg-block">
                    <div class="header-social-icons header-social-icons-black float-right">
                        <ul style="display: flex; align-items: center">
                            <div class="search-bar-1">
                                @include('components.searchBar')
                            </div>
                            <li>
                                <a href="{{route('cart')}}" style="display: flex; align-items: center">
                                    <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i> Cart 
                                    <span class="badge badge-pill badge-danger ml-1">{{ count((array) session('cart')) }}</span>
                                </a>
                            </li>
                            <li><a href="{{App()->communication->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{App()->communication->twitter}}"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{App()->communication->youtube}}"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="{{App()->communication->instagram}}"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- menu-area -->
    <div class="header-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-5 d-flex align-items-center">
                    <div class="logo"> <a href="/"><img src="{{asset('storage/'.(setting('site.logo')))}}" alt=""></a> </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9">
                    <div class="header-right float-right d-none d-lg-block"> <a href="#quote-popup" class="bt-btn btn open-popup-link">Get a Quote</a> </div>
                    <div class="header__menu float-right">
                        <nav id="mobile-menu">
                            <ul>
                                {{ menu('navbar','layouts.nav') }}
                                @auth('client')
                                    <li >
                                        <a style="text-decoration: underline;" class="breadcrumb-item active text-primary" href="{{ route('logout') }}">Logout</a>
                                    </li>
                                @else
                                    <li >
                                        <a style="text-decoration: underline;" class="breadcrumb-item active text-primary" href="{{ route('showLoginForm') }}">Login</a>
                                    </li>
                                    <li >
                                        <a style="text-decoration: underline;" class="breadcrumb-item active text-primary" href="{{ route('showRegistrationForm') }}">Register</a>
                                    </li>
                                @endauth
                            </ul>
    
                        </nav>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
    <div  style="position: relative" class="px-3 mb-4 search-bar-2" >
        <div  style="display: flex;justify-content: space-between;align-items: center;" >
            <div style="width:100%;">
                @include('components.searchBar')
            </div>
            <div class="ml-1">
                <a href="{{route('cart')}}" style="display: flex; align-items: center">
                    <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i> Cart 
                    <span class="badge badge-pill badge-danger ml-1">{{ count((array) session('cart')) }}</span>
                </a>
            </div>
        </div>
    </div>
</header>
