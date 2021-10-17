<?php
    $medicines = App\Medicine::latest()->take(10)->get();
?>
<div class="contentText">
        <div class="infoBoxHeading">Latest Medicines</div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!--                                        <div class="bg_best">-->
                <div class="bg_best">
                    <div class="owl-carousel">
                        @if(!$medicines->isEmpty())
                        @foreach($medicines as $medicine)
                        <div class="item">
                            <span>
                                <a href="{{route('medicine.single',$medicine->id)}}">
                                    <img class="carasoul_image" src="{{$medicine->image}}">
                                </a></span>
                            <a class="btn btn-default" href="{{route('medicine.single',$medicine->id)}}" role="button">
                                Show Details
                            </a>
                        </div>
                        @endforeach
                        @endif
                    <script>
                        $(document).ready(function () {
                                $('.owl-carousel').owlCarousel({
                                    loop: true,
                                    margin: 10,
                                    responsiveClass: true,
                                    responsive: {
                                        0: {
                                            items: 5,
                                            nav: true
                                        },
                                        600: {
                                            items: 5,
                                            nav: true
                                        },
                                        1000: {
                                            items: 5,
                                            nav: true,
                                            loop: true,
                                        }

                                    }
                                })
                            })
                    </script>
                </div>
            </div>
        </div>
    </div>
