@extends('layouts.app')

@section('content')

<div class="col-md-9 col-sm-8 col-xs-12" id="content">
    <div class="breadcrumbs">
        <a href="url(/)"><i class="fa fa-home"></i></a>
        <a href="">{{$medicine->medicine_name}}</a>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <ul class="thumbnails">
                <li><a href="{{$medicine->image}}" class="thumbnail fix-box"><img class="changeimg"
                            src="{{$medicine->image}}"></a></li>
                <li class="image-additional"><a title="Dianabol" class="thumbnail"
                        style="width:90px;height:90px;overflow:hidden">
                        <img class="galleryimg" src="{{$medicine->image}}"></a></li>
            </ul>
        </div>
        <div class="col-sm-6">
            <div class="btn-group">
                <button title="" class="btn btn-default mr_5" type="button"><i class="fa fa-heart"></i></button>
                <button title="" class="btn btn-default" type="button"><i class="fa fa-exchange"></i></button>
            </div>
            <h1 style="color: #39baf0">{{$medicine->medicine_name}}</h1>
            <ul class="list-unstyled product-section">
                <li><span>Product Code:</span> {{$medicine->medicine_id}}</li>
                <li>
                    <span>Rating:</span>
                    <div class="starrr" style="margin-left:10px">
                        @if(isset($medicine->ratings) && !$medicine->ratings->isEmpty())
                        <?php
                                $rated = floor($medicine->ratings->average('rating'));
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
                        @else
                        <?php
                                    $unrated = 5;
                                    while($unrated > 0){
                                    echo('<a class="fa fa-star-o"></a>');
                                    $unrated--;
                                }
                            ?>
                        @endif
                        (<strong>{{(!$medicine->ratings->isEmpty())?round($medicine->ratings->average('rating'), 2) : 'Not Rated Yet'}}</strong>)
                    </div>
                </li>
                <li><span>Shop Name:</span> {{$medicine->shop->shop_name}}</li>
                <li><span>Shop Address:</span> {{$medicine->shop->s_address}}</li>
                <li><span>Availability:</span> <span class="check-stock">Pre-Order</span></li>
            </ul>
            <ul class="list-unstyled">
                <li>
                    <h2>{{$medicine->medicine_price}} BDT/Unit</h2>
                </li>
                <li>Price may vary shop to shop</li>
            </ul>
            <div id="product">
                <form action="{{route('cart.add',$medicine->id)}}" method="get">
                    @csrf
                    <div class="form-group">
                        <label for="input-quantity" class="control-label">Qty</label>
                        <input type="number" class="form-control" id="input-quantity" size="2" value="1"
                            name="quantity">
                        <br>
                        @error('quantity')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <button class="btn btn-primary btn-lg btn-block reg_button" type="submit"><i
                                class="fa fa-shopping-cart"></i> Add to Cart!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-description" aria-expanded="true">Description</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-description" class="tab-pane active">
                    <div class="row ">
                        <p>{!! $medicine->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rel-product">
        <div class="infoBoxHeading">
            <a>Related Product</a>
        </div>
        <div class="row product-layout_width">

            @if(isset($relatedMedicines) && !$relatedMedicines->isEmpty())
            @foreach($relatedMedicines as $rm)
            <div class="product-layout col-md-4  col-sm-6 col-xs-12">
                <div class="product-thumb-height">
                    <div class="product-thumb transition">
                        <ul>

                            <li class="li_product_image">
                                <div class="image">
                                    <a href="{{route('medicine.single',$rm->id)}}">
                                        <img src="{{$rm->image}}" class="img-responsive" width="200" height="200">
                                    </a>

                                </div>
                            </li>
                            <li class="li_product_price">
                                <span class="new_price1">{{$rm->medicine_price}} BDT/Unit</span>
                                <span class="saving1"></span></li>
                            <li>
                            </li>
                            <li class="li_product_desc">
                                <div class="caption">
                                    <p>
                                        {{ substr($medicine->description,0,100) }}
                                    </p>
                                </div>
                            </li>
                            <li class="li_product_buy_button">
                                <a class="btn btn-default" id="but" href="cart.html" role="button">
                                    Add to Cart
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="alert alert-danger">No Related Medicines Found</div>
            @endif

        </div>
    </div>
</div>

@endsection
