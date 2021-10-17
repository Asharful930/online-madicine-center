@extends('layouts.seller.app')

@section('content')
<div class="container">
    <div class="row justify-content-center text-center">
        <!-- top tiles -->
        <div class="row tile_count">
            <div class="card col-md-3 col-xs-5" style="margin: 0px 20px">
                <div class="card-body">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Total Shops </span>
                    <div class="count">{{$count['totalShops']}}</div>
                </div>
            </div>
            <div class="card col-md-3 col-xs-5" style="margin: 0px 20px">
                <div class="card-body">
                    <span class="count_top"><i class="fa fa-money"></i> Total Sell </span>
                    <div class="count">{{$count['totalSale']}} BDT</div>
                </div>
            </div>
            <div class="card col-md-3 col-xs-5" style="margin: 0px 20px">
                <div class="card-body">
                    <span class="count_top"><i class="fa fa-money"></i> Average Sale Per shop</span>
                    <div class="count green">{{$count['totalSale']/$count['totalShops']}} BDT</div>
                </div>
            </div>
            <!-- /top tiles -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Shop list</div>

                <div class="card-body">
                    @if(auth('sellers')->user()->shop->isEmpty())
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
                                    <th>Total Sale</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach(auth('sellers')->user()->shop as $shop)
                                @if($shop->is_active)
                                <tr>
                                    <td>{{$shop->shop_name}}</td>
                                    <td>{{$shop->m_name}}</td>
                                    <td>{{$shop->m_email}}</td>
                                    <td>{{$shop->s_address}}</td>
                                    <td>{{$shop->s_contact}}</td>
                                    <td>{{$count['totalSale']}} BDT</td>
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
    </div>
</div>
@endsection
