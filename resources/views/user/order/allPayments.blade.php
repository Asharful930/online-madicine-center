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
            <div class="card" style="margin-bottom:2em">
                <div class="card-header">
                    <h3 class="card-title">Payment Details</h3>
                </div>
                <div class="card-body">

                    @if(isset($orders) && !$orders->isEmpty())
                    <table id="datatable" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Payment Date</th>
                                <th>Order No.</th>
                                <th>Account No.</th>
                                <th>Method</th>
                                <th>Amount Paid</th>
                                <th>Transaction ID</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            @foreach($order->payments as $payment)
                            <tr>
                                <td>{{$payment->created_at->format('d/M/Y - h:i A')}}</td>
                                <td> <a href="{{route('user.order.single',$payment->order->id)}}">
                                        {{$payment->order->id}} </a></td>
                                <td>{{$payment->account_no}}</td>
                                <td>{{$payment->method}}</td>
                                <td>{{$payment->amount}} BDT</td>
                                <td> {{$payment->trx_id}}</td>
                                <td> {{$payment->status}}</td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>

                    </table>
                    @else

                    <div class="alert alert-danger">No Payments yet</div>
                    @endif
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
