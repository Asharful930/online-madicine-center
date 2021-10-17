@extends('layouts.user.app')

@section('style')
<link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href=".{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Unpaid Orders</div>
                <div class="card-body">

                    <table id="datatable" class="table table-striped table-bordered" style="text-align:center;">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Order ID</th>
                                <th>Total Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                            @if($order->status == 'Payment Pending')
                            <tr>
                                <td>{{$order->created_at->format('d-M-Y')}}</td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->orderDetails->sum('quantity')}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->status}}</td>
                                <td>
                                    <a href="{{route('user.order.single',$order->id)}}"
                                        class="btn btn-sm btn-primary">Show Details</a>
                                    <a href="{{route('user.order.payment',$order->id)}}"
                                        class="btn btn-sm btn-success">Make Payment</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">Payment Verification Pending Orders</div>
                <div class="card-body">

                    <table class="table table-striped table-bordered datatable" style="text-align:center;">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Order ID</th>
                                <th>Total Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                            @if($order->status == 'Payment Verification Pending')
                            <tr>
                                <td>{{$order->created_at->format('d-M-Y')}}</td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->orderDetails->sum('quantity')}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->status}}</td>
                                <td>
                                    <a href="{{route('user.order.single',$order->id)}}"
                                        class="btn btn-sm btn-primary">Show Details</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">Payment Verified Orders</div>
                <div class="card-body">

                    <table class="table table-striped table-bordered datatable" style="text-align:center;">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Order ID</th>
                                <th>Total Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                            @if($order->status == 'Payment Verified')
                            <tr>
                                <td>{{$order->created_at->format('d-M-Y')}}</td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->orderDetails->sum('quantity')}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->status}}</td>
                                <td>
                                    <a href="{{route('user.order.single',$order->id)}}"
                                        class="btn btn-sm btn-primary">Show Details</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">Shipped Orders</div>
                <div class="card-body">

                    <table class="table table-striped table-bordered datatable" style="text-align:center;">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Order ID</th>
                                <th>Total Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                            @if($order->status == 'Shipped:Full' || $order->status == 'Shipped:Partial')
                            <tr>
                                <td>{{$order->created_at->format('d-M-Y')}}</td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->orderDetails->sum('quantity')}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->status}}</td>
                                <td>
                                    <a href="{{route('user.order.single',$order->id)}}"
                                        class="btn btn-sm btn-primary">Show Details</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">Completed Orders</div>
                <div class="card-body">

                    <table class="table table-striped table-bordered datatable" style="text-align:center;">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Order ID</th>
                                <th>Total Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                            @if($order->status == 'Completed')
                            <tr>
                                <td>{{$order->created_at->format('d-M-Y')}}</td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->orderDetails->sum('quantity')}}</td>
                                <td>{{$order->total}}</td>
                                <td>
                                    {{$order->status}} <br>

                                    @if(isset($order->ratings) && !$order->ratings->isEmpty())
                                    <div class="starrr">
                                        <?php
                                            $rated = floor($order->ratings->average('rating'));
                                            $unrated = 5-$rated;
                                            while($rated > 0){
                                                echo('<a class="fa fa-star"></a>');
                                                $rated--;
                                            }
                                            while($unrated > 0){
                                                echo('<a class="fa fa-star-o"></a>');
                                                $unrated--;
                                            }

                                        ?>
                                    </div>
                                    <p class="text-center text-primary">{{$order->ratings[0]->feedback}}</p>

                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('user.order.single',$order->id)}}"
                                        class="btn btn-sm btn-primary">Show Details</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
