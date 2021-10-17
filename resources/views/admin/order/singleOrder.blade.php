@extends('layouts.admin.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Order BY {{$order->user->f_name}} {{$order->user->l_name}}</h2>
            <p> <strong>Contact: </strong> {{$order->user->contact}} </p>
            <p> <strong>Address: </strong> {{$order->user->address}} </p>
        </div>
        <div class="col-md-6">
            <h2>Shipped To {{$order->shipment->shipped_to}}</h2>
            <p> <strong>Contact: </strong> {{$order->shipment->contact}} </p>
            <p> <strong>Address: </strong> {{$order->shipment->address}} </p>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Details of Order No. {{$order->id}}</div>
                <div class="card-body">
                    <table class="table table-bordered" id="datatable" style="width:100%">
                        <thead>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">PRODUCT NAME</td>
                                <td class="text-right">QUANTITY</td>
                                <td class="text-right">UNIT PRICE</td>
                                <td class="text-right">TOTAL</td>
                                <td class="text-right">RATING</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($order))
                            @foreach($order->orderDetails as $orderDetail)
                            <tr>
                                <td class="text-center">
                                    <a href="{{route('medicine.single',$orderDetail->medicine->id)}}">
                                        <img title="ana" src="{{$orderDetail->medicine->image}}"
                                            style="width: 100px; height: 80px;">
                                    </a>
                                </td>
                                <td class="text-left"><a
                                        href="{{route('medicine.single',$orderDetail->medicine->id)}}">{{$orderDetail->medicine->medicine_name}}</a>
                                    <br>
                                    <small>Shop Name: {{$orderDetail->medicine->shop->shop_name}}</small>
                                </td>
                                <td class="text-right"><br>
                                    {{$orderDetail->quantity}}
                                </td>
                                <td class="text-right"><br>{{$orderDetail->medicine->medicine_price}} BDT</td>
                                <td class="text-right">
                                    <br>{{$orderDetail->subtotal}} BDT</td>

                                <td>
                                    {{$orderDetail->status}}
                                    <br>
                                    @if(isset($orderDetail->medicine->ratings) && !$order->ratings->isEmpty())
                                    <div class="starrr">
                                        <?php
                                            $rated = floor($orderDetail->medicine->ratings->average('rating'));
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
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <div class="alert alert-danger">No Order Details Found.</div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if(isset($order->payments) && !$order->payments->isEmpty())
            <div class="card mt-2" style="margin-bottom:2em">
                <div class="card-header">
                    <h3 class="card-title">Payment Details</h3>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">Account No.</th>
                                <th class="text-center">Method</th>
                                <th class="text-center">Amount Paid</th>
                                <th class="text-center">Transaction ID</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        @foreach($order->payments as $payment)
                        <tbody>
                            <tr>
                                <td class="text-center">{{$payment->account_no}}</td>
                                <td class="text-center">{{$payment->method}}</td>
                                <td class="text-center">{{$payment->amount}} BDT</td>
                                <td class="text-center"> {{$payment->trx_id}}</td>
                                <td class="text-center"> {{$payment->status}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pricing Details</h3>
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <tbody>
                            <tr>

                                <td class="text-right"><strong>Sub-Total:</strong></td>
                                <td class="text-right">{{$order->orderDetails->sum('subtotal')}} BDT</td>
                            </tr>
                            <tr>
                                <td class="text-right">Shipping Charge (Per Shop):</td>
                                <td class="text-right">45 BDT</td>
                            </tr>
                            <tr>
                                <td class="text-right">Total Shops:</td>
                                <td class="text-right">{{count($order->orderDetails->unique('shop'))}}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Total Shipping Cost:</td>
                                <td class="text-right">
                                    {{$shippingTotal = (45 * count($order->orderDetails->unique('shop')))}} BDT</td>
                            </tr>

                            <tr>
                                <td class="text-right"><strong>Order Total:</strong></td>
                                <td class="text-right">{{$order->total}} BDT</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if($order->status == 'Payment Verification Pending')
            <div class="card mt-2" style="margin-bottom:2em">
                <div class="card-header">
                    <h3 class="card-title">Payment Details</h3>
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        @foreach($order->payments as $payment)
                        @if($payment->status == 'Unverified')
                        <tbody>
                            <tr>
                                <td class="text-right"><strong>Account No:</strong></td>
                                <td class="text-right">{{$payment->account_no}}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Method:</td>
                                <td class="text-right">{{$payment->method}}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Amount:</td>
                                <td class="text-right">{{$payment->amount}} BDT</td>
                            </tr>
                            <tr>
                                <td class="text-right">Transaction ID:</td>
                                <td class="text-right"> {{$payment->trx_id}}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-right" colspan="2">
                                    <form action="{{route('admin.payment.verify',$payment->id)}}" method="post">
                                        @csrf
                                        @method('patch')
                                        <input type="submit" class="btn btn-success" value="Verify">
                                    </form>
                                    <form action="{{route('admin.payment.declined',$payment->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="btn btn-danger" value="Declined">
                                    </form>
                                </td>
                            </tr>

                        </tfoot>

                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
