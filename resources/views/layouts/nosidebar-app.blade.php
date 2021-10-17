<?php
    $cart['count'] = Cart::getContent()->count();
    $cart['total'] = Cart::getTotal();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="images/favicon.png" />
    <title>{{ config('app.name', 'Online Medicine Center') }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/owl-carousel.css')}}" />
    @yield('style')
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/custom.js')}}"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4" id="logo">
                <a href="{{url('/')}}" class="logo-text" style="padding:0px">
                    <img style="width:60%" src="{{asset('images/logo.png')}}" alt="{{ config('app.name', 'Online Medicine Center') }}">
                </a>
            </div>
            <div class="col-md-4 col-md-offset-4 col-sm-offset-2  col-sm-6 col-xs-12">
                <div id="top_right">
                    <div id="cart">
                        <div class="text">
                            <div class="img">
                                <a href="{{route('cart.show')}}"> <img class="img-responsive"
                                        src="{{asset('images/cart.png')}}" alt="" title="" width="26" height="27" />
                            </div><span>Your cart:</span><span class="cart_total">{{$cart['total'] ?? ''}}
                                BDT</span><span class="cart_items">({{$cart['count'] ?? ''}} items)</span></a>
                        </div>
                    </div>
                    <div id="bottom_right">
                        <div class="row">
                            <div class="col-md-6 col-xs-6 wd_auto">
                                <div class="left">
                                    <div class="login">
                                        @if(Auth::user() === null && Auth::guard('sellers')->user() == null &&
                                        Auth::guard('admin')->user() == null && Auth::guard('manager')->user() == null)
                                        <a class="btn btn-default reg_button" href="{{url('login')}}">Login</a>
                                        <a class="btn btn-default reg_button" href="{{url('register')}}">Signup</a>
                                        @else
                                        <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid bg-color" style="margin-top: 1.5em !important;">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <nav role="navigation" class="navbar navbar-inverse" id="nav_show">
                            <div id="nav">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                                        data-target="#myNavbar">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>

                                </div>
                                <div class="collapse navbar-collapse" id="myNavbar">
                                    <ul class="nav navbar-nav site_nav_menu1">
                                            @if(auth()->user())
                                            <a href="{{route('home')}}">Home</a>
                                            @elseif(auth('admin')->user())
                                            <a href="{{route('admin.index')}}">Home</a>
                                            @elseif(auth('manager')->user())
                                            <a href="{{route('manager.index')}}">Home</a>
                                            @elseif(auth('sellers')->user())
                                            <a href="{{route('seller.index')}}">Home</a>
                                            @else
                                            <a href="{{url('/')}}">Home</a>
                                            @endif
                                        </li>
                                        <li><a href="#">About us</a></li>
                                        <li><a href="{{route('privacyPolicy')}}">Privacy Policy</a></li>
                                        <li><a href="{{route('shippingPayment')}}">Terms & Conditions</a></li>
                                        <li><a href="{{route('shippingPayment')}}">Shipping & Payment</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                    </ul>

                                </div>
                            </div>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" id="search_manu" style="margin-top: 10px">
            <div class="col-md-6 geo-alert">

            </div>
            <div class="col-md-6 col-xs-12">
                <form action="{{route('medicine.search')}}" method="GET" id="search-form">
                    @csrf
                    <input type="hidden" name="lat" id="lat" value="">
                    <input type="hidden" name="lng" id="lng" value="">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="name" placeholder="Search with Medicine Name"
                                class="form-control input-lg" id="inputGroup" />
                            <a class="input-group-addon" href="#" style="color:white" onclick="event.preventDefault();
                                document.getElementById('search-form').submit();">
                                Search
                            </a>
                        </div>
                        @error('name')
                        <p class="invalid-feedback text-danger" role="alert">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="site_content">
        <div class="container">
            <div class="row">
                <div class="right_sidebar1">
                    <div id="right_part">
                        @yield('content')

                    </div>

                </div>

            </div>
        </div>
    </div>



    <div id="footer1">
        <div class="container-fluid footer-background">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-3 col-xs-12 txt-center">
                            <a href="{{url('/')}}">
                                <span class="logo-text">Medicine Center</span>
                            </a>
                        </div>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <div id="footer_menu">
                                @if(auth()->user())
                                <a href="{{route('home')}}">Home</a> |
                                @elseif(auth('admin')->user())
                                <a href="{{route('admin.index')}}">Home</a> |
                                @elseif(auth('manager')->user())
                                <a href="{{route('manager.index')}}">Home</a> |
                                @elseif(auth('sellers')->user())
                                <a href="{{route('seller.index')}}">Home</a> |
                                @else
                                <a href="{{url('/')}}">Home</a> |
                                @endif
                                <a href="#">About Us</a> |
                                <a href="#">Shipping & Payment</a> |
                                <a href="#">Privacy Policy</a>
                                <a href="#">Terms & Conditions</a> |
                                <a href="#">Contact Us</a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div id="social_icons" class="pull-right">
                                <a href="#" class="btn btn-default reg_button"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="btn btn-default reg_button"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="btn btn-default reg_button"><i class="fa fa-yahoo"></i></a>
                                <a href="#" class="btn btn-default reg_button"><i class="fa fa-envelope"></i></a>
                                <a href="#" class="btn btn-default reg_button"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="copyright">
                                <!--Do not remove Backlink from footer of the template. To remove it you can purchase the Backlink !-->
                                {{ config('app.name', 'Online Medicine Center') }} © 2019 All right reserved.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <a style="display: none" href="javascript:void(0);" class="scrollTop back-to-top" id="back-to-top">
        <i class="fa fa-chevron-up"></i>
    </a>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition,showError);
            } else {
                $('.geo-alert').html('Please alow location otherwise we will not be able to provide you the nearest pharmacy distance');
            }
        }
        function showPosition(position) {
            // x.innerHTML = "Latitude: " + position.coords.latitude +
            //     "<br>Longitude: " + position.coords.longitude;
            document.getElementById("lat").value = position.coords.latitude;
            document.getElementById("lng").value = position.coords.longitude;
        }
        function showError(error) {
            var x = $('.geo-alert');
            switch(error.code) {
                case error.PERMISSION_DENIED:
                x.html('<div class="alert alert-danger">Please alow location otherwise we will not be able to provide you the nearest pharmacy distance</div>');
                break;
                case error.POSITION_UNAVAILABLE:
                x.html('<div class="alert alert-danger">Location information is unavailable.</div>');
                break;
                case error.TIMEOUT:
                x.html('<div class="alert alert-danger">The request to get user location timed out.</div>');
                break;
                case error.UNKNOWN_ERROR:
                x.html('<div class="alert alert-danger">An unknown error occurred.</div>');
                break;
            }
        }
        (function() {
            getLocation();

        })();

    </script>
    @yield('scripts')

</body>


</html>
