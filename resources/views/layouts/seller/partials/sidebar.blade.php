<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="{{url('/')}}" class="site_title"><span>{{ config('app.name', 'Laravel') }}</span></a>
    </div>

    <div class="clearfix"></div>
    <br />
    <div class="profile clearfix">
        <div class="profile_pic">
            <p class="img-circle profile_img"> {{auth('sellers')->user()->f_name[0]}} </p>
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2> {{(Auth::guest('sellers'))? auth('sellers')->user()->f_name : "Guest"}} </h2>
        </div>
    </div>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    
    <!-- sidebar menu -->
    
        <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{route('seller.index')}}"><i class="fa fa-home"></i> Home </a></li>
        </ul>
        </div>
        <div class="menu_section">
        <h3>Shops</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-bug"></i> Shop Management<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('seller.shop.shopRequest')}}">Request Shop</a></li>
                <li><a href="{{route('seller.approval.approvalShop')}}">Approved Shops</a></li>
            </ul>
            </li>
        </div>
    </div>
    <!-- /sidebar menu -->
</div>