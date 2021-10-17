@extends('layouts.user.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payment Instructions</h3>
                </div>
                <div class="card-body">

                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Pricing Details for Order ID : {{$order->id}}</h3>
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

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Payment Details</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('user.payment.store',$order->id)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for=""> Account No. </label>
                            <input type="text" class="form-control" name="account_no"
                                placeholder="Please Enter Account Number" value="{{old('account_no')}}"  required>
                            @error('account_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""> Transaction ID </label>
                            <input type="text" class="form-control" name="trx_id"
                                placeholder="Please Enter Transaction ID" value="{{old('trx_id')}}" required>
                            @error('trx_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""> Select Payment Method </label>
                            <select name="method" id="method" class="form-control"  value="{{old('method')}}" >
                                <option value="bKash">bKash</option>
                                <option value="DBBL/Rocket">DBBL/Rocket</option>
                                <option value="nagad">Nagad</option>
                            </select>
                            @error('method')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
