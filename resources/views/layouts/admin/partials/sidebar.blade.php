<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="{{url('/')}}" class="site_title"><span>{{ config('app.name', 'Laravel') }}</span></a>
    </div>

    <div class="clearfix"></div>
    <br />
    <div class="profile clearfix">
        <div class="profile_pic">
            <p class="img-circle profile_img"> {{auth('admin')->user()->f_name[0]}} </p>
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2> {{(Auth::guest('admin'))? auth('admin')->user()->f_name : "Guest"}} </h2>
        </div>
    </div>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <!-- sidebar menu -->

        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-home"></i> Home </a></li>
            </ul>
        </div>
        <div class="menu_section">
            <h3>Shop Management</h3>
            <ul class="nav side-menu">
            <li><a href="{{route('admin.shop.requestApproved')}}"><i class="fa fa-institution"></i> Shop Requests</a></li>
        </div>
        <div class="menu_section">
            <h3>User Management</h3>
            <ul class="nav side-menu">
                <li><a><i class="fa fa-users"></i>Users Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route('admin.approval.adminRequest')}}">Admin Requests</a></li>
                        <li><a href="{{route('admin.approval.sellerRequest')}}">Seller Requests</a></li>
                        <li><a href="{{route('admin.approval.allSellerList')}}">Approved Seller List</a></li>
                        <li><a href="{{route('inactiveseller.list')}}">Inactive Seller List</a></li>
                        <li><a href="{{route('admin.approval.allAdminList')}}">Approved Admin List</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="menu_section">
            <h3> Prescription Requests</h3>
            <ul class="nav side-menu">
            <li><a href="{{route('admin.prescription')}}"><i class="fa fa-user-plus"></i> User Requests </a></li>
        </div>
    </div>
    <div class="menu_section">
        <h3>Payment Management</h3>
        <ul class="nav side-menu">
        <li><a href="{{route('admin.payments.all')}}"><i class="fa fa-money"></i> All Payments </a></li>
    </div>
    <!-- /sidebar menu -->
</div>
