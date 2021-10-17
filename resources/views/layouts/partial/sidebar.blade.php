<div class="col-md-3 col-sm-4 col-xs-12 left_sidebar1">
    <div id="left_part">
        <div class="bs-example">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="infoBoxHeading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">What's New?</a>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <i id="accordan_plus"
                                    class="indicator glyphicon glyphicon-chevron-up  pull-right accordan_plus"></i>
                            </a>
                        </div>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="infoBoxContainer">
                                <?php $latestMedicine = App\Medicine::latest()->first()?>
                                @if(isset($latestMedicine))
                                <div class="infoBoxHeading">
                                    <a>What's New?</a>
                                </div>
                                <div class="infoBoxContents" id="sidebar">
                                    <div style="max-width:150px; margin:0px auto">
                                        <a href="{{route('medicine.single',$latestMedicine->id)}}">
                                            <img src="{{$latestMedicine->image}}" class="img-responsive" />
                                        </a>
                                    </div>
                                    <a
                                        href="{{route('medicine.single',$latestMedicine->id)}}">{{$latestMedicine->medicine_name}}</a><br />{{$latestMedicine->medicine_price}}
                                    BDT per Unit
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="infoBoxHeading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Information</a>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <i id="accordan_plus" class="indicator glyphicon glyphicon-chevron-up  pull-right"></i>
                            </a>
                        </div>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="infoBoxContents">
                                <a href="{{route('shippingPayment')}}">Shipping &amp; Returns</a><br />
                                <a href="{{route('privacyPolicy')}}">Privacy Notice</a><br />
                                <a href="{{route('termsAndConditons')}}">Conditions of Use</a><br />
                                <a href="#">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script>
        function toggleChevron(e) {
        $(e.target)
            .prev('.panel-heading')
            .find("i.indicator")
            .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
        }
        $('#accordion').on('hidden.bs.collapse', toggleChevron);
        $('#accordion').on('shown.bs.collapse', toggleChevron);
    </script>

</div>
