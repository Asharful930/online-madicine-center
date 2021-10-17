<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="{{url('/')}}" class="site_title"><span>{{ config('app.name', 'DIU Hall') }}</span></a>
    </div>

    <div class="clearfix"></div>
    <br />
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        @guest()
        <div class="menu_section">
            <ul class="nav side-menu">
                <li>
                    <a href="{{ route('login') }}"><i class="fa fa-user-plus"></i> {{ __('User-Login') }}</a>
                </li>
                <li>
                    <a href="{{ route('admin.login') }}"><i class="fa fa-user"></i> {{ __('Admin-Login') }}</a>
                </li>
                <li>
                    <a href="{{ route('seller.login') }}"><i class="fa fa-user"></i> {{ __('Seller-Login') }}</a>
                </li>
                <li>
                    <a href="{{ route('manager.login') }}"><i class="fa fa-user"></i> {{ __('Manager-Login') }}</a>
                </li>
            </ul>
        </div>
        @else
        <!-- sidebar menu -->
        @if(auth()->user())
        <div class="profile clearfix">
            <div class="profile_pic">
                <p class="img-circle profile_img"> {{auth()->user()->f_name[0]}} </p>
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2> {{(Auth::user())? auth()->user()->f_name : "Guest"}} </h2>
            </div>
        </div>
        @endif
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home </a></li>
                <li><a><i class="fa fa-file"></i> Prescription Upload<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route('add.prescription')}}">Prescription Upload</a></li>
                        <li><a href="{{route('show.request')}}">Your request</a></li>

                    </ul>
                </li>
            </ul>
        </div>
        <div class="menu_section">
            <h3>Payments</h3>
            <ul class="nav side-menu">
                <li><a href="{{route('user.payment.all')}}"><i class="fa fa-money"></i> Payments </a></li>
            </ul>
        </div>


        @endguest
    </div>
    <!-- /sidebar menu -->
</div>
