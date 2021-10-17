@extends('layouts.admin.app')
@section('style')
<link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href=".{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">New Shop Requests</div>
        <div class="card-body">
            @if($shops->isEmpty())
            <div class="alert alert-danger">No Shop Requests yet!</div>
            @else
            <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered" style="text-align:center;">
                    <thead>
                        <tr>
                            <th>Shop Name</th>
                            <th>Manager Name</th>
                            <th>Manager Email</th>
                            <th>Shop Address</th>
                            <th>Manager contact</th>
                            <th>Seller Name</th>
                            <th>Latitude</th>
                            <th>longitude</th>
                            <th>action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($shops as $shop)
                        @if($shop->is_active)
                        <tr>
                            <td>{{$shop->shop_name}}</td>
                            <td>{{$shop->m_name}}</td>
                            <td>{{$shop->m_email}}</td>
                            <td>{{$shop->s_address}}</td>
                            <td>{{$shop->s_contact}}</td>
                            <td>{{$shop->seller->f_name}} {{$shop->seller->l_name}}</td>
                            <td>{{$shop->latitude}}</td>
                            <td>{{$shop->longitude}}</td>
                            <td>
                                <a href="{{route('admin.medicine',$shop->id)}}" class="btn btn-success btn-sm">Show
                                    medicines</a>
                            </td>
                        </tr>

                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<!-- Custom Theme Scripts -->
@endsection


</body>

</html>
