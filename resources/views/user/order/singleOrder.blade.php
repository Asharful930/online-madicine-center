@extends('layouts.user.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
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
                                <td class="text-right">Status</td>
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
                                <td class="text-center">
                                    <br>{{($orderDetail->shipped)?'Shipped':'Not Shipped'}}
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
            @if($order->status == 'Shipped:Full')
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Rating & Feedback</h3>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class='starrr' id='star1'></div>
                    </div>
                    <form action="{{route('user.order.rating',$order->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control rating" value="" name="rating">
                            @error('rating')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea name="feedback" id="feedback" cols="30" rows="5" class="form-control"></textarea>
                            @error('feedback')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="submit" value="Provide Feedback" class="btn btn-success">
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('#star1').starrr({
        change: function(e, value){
            if (value) {
                $('.rating').val(value);
            }
        }
    });
</script>
@endsection
