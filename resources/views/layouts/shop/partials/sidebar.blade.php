<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="{{url('/')}}" class="site_title"><span>{{ config('app.name', 'Laravel') }}</span></a>
    </div>

    <div class="clearfix"></div>
    <br />
    <div class="profile clearfix">
        <div class="profile_pic">
            <p class="img-circle profile_img"> {{auth('manager')->user()->m_name[0]}} </p>
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2> {{(Auth::guest('manager'))? auth('manager')->user()->m_name : "Guest"}} </h2>
        </div>
    </div>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    
    <!-- sidebar menu -->
    
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a href="{{route('manager.index')}}"><i class="fa fa-home"></i> Home </a></li>
            </ul>
        </div>
        <div class="menu_section">
            <h3>Medicine Management</h3>
            <ul class="nav side-menu">
            <li><a href="{{route('medicine.input-form')}}"><i class="fa fa-institution"></i> Add Medicine</a></li>
            <li><a href="{{route('medicine.medicineList')}}"><i class="fa fa-institution"></i> Medicine List</a></li>
        </div>
        
    </div>
    <!-- /sidebar menu -->
</div>