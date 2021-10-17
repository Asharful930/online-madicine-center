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
                            <th>Shop contact</th>
                            <th>Seller Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($shops as $shop)
                        <tr>
                            <td>{{$shop->shop_name}}</td>
                            <td>{{$shop->m_name}}</td>
                            <td>{{$shop->m_email}}</td>
                            <td>{{$shop->s_address}}</td>
                            <td>{{$shop->s_contact}}</td>
                            <td>{{$shop->seller->f_name}} {{$shop->seller->l_name}}</td>
                            <td>
                                <form action="{{route('edit.shop.activation',$shop->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-xs-12 mb-1">
                                        <input type="text" class="form-control" placeholder="Enter Latitude"
                                            requred="required" name="latitude">
                                        @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-xs-12 mb-1">
                                        <input type="text" class="form-control" placeholder="Enter longitute"
                                            requred="required" name="longitude">
                                        @error('longitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-xs-12 mb-1">
                                        <input type="submit" value="Accept" class="btn btn-success">
                                    </div>
                                </form>
                                <form action="{{route('edit.shop.reject',$shop->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Reject" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
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
@endsection
