@extends('layouts.app')

@section('content')
<div class="row margin-top">
    @include('layouts.alerts')
    @if(isset($medicines) || $medicines->isEmpty())
    @foreach($medicines as $medicine)
    @if(isset($medicine->id))
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="{{route('medicine.single',$medicine->id)}}"><img class="img-responsive"
                        src="{{$medicine->image}}" width="200" height="200"></a></div>
            <div class="product-details-box" style="overflow: hidden">
                <div class="caption">
                    <h4 class="product_title"><a
                            href="{{route('medicine.single',$medicine->id)}}">{{$medicine->medicine_name}}</a></h4>
                    <p>
                        {{substr($medicine->description,0,100)}}....</p>
                    <p class="price">
                        <span class="new_price">{{$medicine->medicine_price}} BDT/Unit</span>
                        <div class="starrr">
                            <span>Rating: </span>
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
                        <span class="price-tax">Shop Name: {{$medicine->shop->shop_name}}</span>
                        <span>Shop Address: {{$medicine->shop->s_address}}</span> 

                        <span class="price-tax">Distance:
                            {{($medicine->distance>1000)?number_format(($medicine->distance/1000), 2, '.', ',').' Km':$medicine->distance.' meter'}}</span>
                    </p>
                </div>
                <!--<div class="button-group">!-->
                <div class="t col-md-6">
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
                <div class="pull-right">
                </div>
                <!--</div>!-->
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @else
    <div class="alert alert-danger">No Medicines found!</div>
    @endif
</div>
@endsection
