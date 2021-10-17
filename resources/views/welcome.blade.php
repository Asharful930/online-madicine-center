@extends('layouts.app')

@section('content')
<div class="contentContainer">
    <div class="contentText">
        <div class="breadcrumbs">
            <a href="{{url('/')}}" class="headerNavigation"><i class="fa fa-home"></i></a>
        </div>
    </div>

    <!----slidder start-!-->
    @include('layouts.partial.bestSeller')
    <!----slidder End-!-->

    <!----content_2 For New Products--!-->
    <div class="contentText">
        <h1>ALL Medicines</h1>
        <div class="row margin-top product-layout_width">
            @include('layouts.alerts')
            @if(isset($medicines)&&!$medicines->isEmpty())
            @foreach($medicines as $medicine)
            @if($medicine->shop->seller->is_active)
            <div class="product-layout  col-md-4 col-sm-6 col-xs-12">
                <div class="product-thumb-height">
                    <div class="product-thumb transition">
                        <ul>
                            <li class="li_product_title">
                                <div class="product_title">
                                    <a
                                        href="{{route('medicine.single',$medicine->id)}}">{{$medicine->medicine_name}}</a>
                                </div>
                            </li>
                            <li class="li_product_image" style="overflow: hidden;">
                                <div class="image" style="overflow:hidden">
                                    <a href="{{route('medicine.single',$medicine->id)}}">
                                        <img src="{{$medicine->image}}" class="img-responsive" width="200" height="200"
                                            style="margin: 0px auto;" />
                                    </a>

                                </div>
                            </li>
                            <li class="li_product_price">
                                <span class="old_price1"></span>
                                <span class="new_price1">{{$medicine->medicine_price}} BDT/Unit</span>
                                <span class="saving1"></span>
                            <li>
                            <li class="li_product_desc">

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
                                </div>

                                <div class="caption">
                                    <br>
                                    <p>
                                        {{substr($medicine->description,0,100)}}
                                    </p>
                                </div>
                            </li>
                            <div id="product" class="col-md-11">
                                <form action="{{route('cart.add',$medicine->id)}}" method="get">
                                    @csrf
                                    <div class="form-group">
                                        <label for="input-quantity" class="control-label">Qty</label>
                                        <input type="number" class="form-control" id="input-quantity" size="2" value="1"
                                            name="quantity">
                                        <br>
                                        <button class="btn btn-primary btn-lg btn-block reg_button" type="submit"><i
                                                class="fa fa-shopping-cart"></i> Add to Cart!</button>
                                    </div>
                                </form>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @else
            <div class="alert alert-danger">No Medicines Found</div>
            @endif
        </div>
        @if(isset($medicines)&&!$medicines->isEmpty())
        <div class="row">{{$medicines->links()}}</div>
        @endif
    </div>
    <!----content_2 End--!-->
</div>
@endsection
