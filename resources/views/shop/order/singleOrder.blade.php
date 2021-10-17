@extends('layouts.shop.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                                <td class="text-right">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($order))
                            <?php $subtotal=0; ?>
                            @foreach($order->orderDetails as $orderDetail)
                            @if($orderDetail->shop_id == auth('manager')->user()->id)
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
                                <?php $subtotal += $orderDetail->subtotal?>
                                <td><br>
                                    @if(!$orderDetail->shipped)
                                    <a href="{{route('medicine.shipped',$orderDetail->id)}}"
                                        class="btn btn-success btn-shipped">Shipped</a>
                                    @else
                                    <p class="text-success">Order Shipped</p>
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
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-center"><strong>Total</strong></td>
                                <td colspan="2" class="text-left">{{$subtotal}} BDT</td>
                            </tr>
                            @else
                            <div class="alert alert-danger">No Order Details Found.</div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
