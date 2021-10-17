@extends('layouts.app')

@section('style')
<link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href=".{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="contentContainer">
    <div class="contentText">
        <div class="breadcrumbs">
            <a href="{{url('/')}}" class="headerNavigation"><i class="fa fa-home"></i></a>
            <a href="{{route('cart.show')}}">Shopping Cart</a>
        </div>
    </div>
    <div class="contentText">
        @include('layouts.alerts')
        <h1>Shopping Cart &nbsp;({{$cart['count']}} Medicines)
        </h1>
    </div>
    <div class="table-responsive margin-top">
        <table class="table table-bordered" id="datatable" style="width:100%">
            <thead>
                <tr>
                    <td class="text-center"></td>
                    <td class="text-left">PRODUCT NAME</td>
                    <td class="text-left">QUANTITY</td>
                    <td class="text-right">UNIT PRICE</td>
                    <td class="text-right">TOTAL</td>
                </tr>
            </thead>
            <tbody>
                @if(!$medicines->isEmpty())
                @foreach($medicines as $medicine)
                <tr>
                    <td class="text-center">
                        <a href="{{route('medicine.single',$medicine->id)}}">
                            <img title="ana" src="{{$medicine->image}}" style="width: 100px; height: 80px;">
                        </a>
                    </td>
                    <td class="text-left"><a href="{{route('medicine.single',$medicine->id)}}">{{$medicine->medicine_name}}</a>
                        <br>
                        <small>Shop Name: {{$medicine->shop->shop_name}}</small>
                    </td>
                    <td class="text-left"><br>
                        <div style="max-width: 200px;" class="input-group btn-block">
                            <input type="number" id="qty-{{$medicine->id}}" class="form-control input-sm" size="1"
                                value="{{$medicine->quantity}}" style="height:34px">
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-cart-update" type="submit"
                                    data-original-title="Update" data-id="{{$medicine->id}}"><i
                                        class="fa fa-refresh"></i></button>
                                <button class="btn btn-danger btn-cart-delete" type="button"
                                    data-original-title="Remove" data-id="{{$medicine->id}}"> <i
                                        class="fa fa-times-circle"></i> </button>
                            </span>
                        </div>
                        <form id="cart-update-{{$medicine->id}}" action="{{route('cart.update',$medicine->id)}}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="quantity" id="quantity">
                        </form>
                        <form id="cart-delete-{{$medicine->id}}" action="{{route('cart.delete',$medicine->id)}}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                    <td class="text-right"><br>{{$medicine->medicine_price}}</td>
                    <td class="text-right"><br>{{$medicine->subTotal}}</td>
                </tr>
                @endforeach
                @else
                <div class="alert alert-danger">No Medicines added to cart yet.</div>
                @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-6">
            <strong style="font-size: 30px;float: right">Pricing Details</strong>
            <table class="table table-bordered">
                <tbody>
                    <tr>

                        <td class="text-right"><strong>Sub-Total:</strong></td>
                        <td class="text-right">{{$cart['subTotal']}} BDT</td>
                    </tr>
                    <tr>
                        <td class="text-right">Shipping Charge (Per Shop):</td>
                        <td class="text-right">45 BDT</td>
                    </tr>
                    <tr>
                        <td class="text-right">Total Shops:</td>
                        <td class="text-right">{{$cart['shops']}}</td>
                    </tr>
                    <tr>
                        <td class="text-right">Total Shipping Cost:</td>
                        <td class="text-right">{{$shippingTotal = (45 * $cart['shops'])}} BDT</td>
                    </tr>

                    <tr>
                        <td class="text-right"><strong>Order Total:</strong></td>
                        <td class="text-right">{{$shippingTotal + $cart['subTotal']}} BDT</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="buttons">
        <div class="pull-left"><a class="btn btn-default" href="{{url('/')}}"><i
                    class="fa fa-caret-right"></i>&nbsp;Continue Shopping</a></div>
        <div class="pull-right"><a class="btn btn-primary reg_button"
                href="{{(Auth::guard('admin')->user())?route('admin.checkout') : route('user.checkout')}}">Checkout</a></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.btn-cart-update').on('click',function(){
        var id = $(this).data('id');
        var qty = $('#qty-'+id).val();
        $('#cart-update-'+id+' #quantity').val(qty);
        $('#cart-update-'+id).submit();
    });
    $('.btn-cart-delete').on('click',function(){
        var id = $(this).data('id');
        $('#cart-delete-'+id).submit();
    });
</script>
<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script>
function init_DataTables() {

    console.log('run_datatables');

    if( typeof ($.fn.DataTable) === 'undefined'){ return; }
    console.log('init_DataTables');

    var handleDataTableButtons = function() {
        if ($("#datatable-buttons").length) {
        $("#datatable-buttons").DataTable({
            dom: "Blfrtip",
            buttons: [
            {
                extend: "copy",
                className: "btn-sm"
            },
            {
                extend: "csv",
                className: "btn-sm"
            },
            {
                extend: "excel",
                className: "btn-sm"
            },
            {
                extend: "pdfHtml5",
                className: "btn-sm"
            },
            {
                extend: "print",
                className: "btn-sm"
            },
            ],
            responsive: true
        });
        }
    };

    TableManageButtons = function() {
        "use strict";
        return {
        init: function() {
            handleDataTableButtons();
        }
        };
    }();

    $('#datatable').dataTable();

    $('#datatable-keytable').DataTable({
        keys: true
    });

    $('#datatable-responsive').DataTable();

    $('#datatable-scroller').DataTable({
        ajax: "js/datatables/json/scroller-demo.json",
        deferRender: true,
        scrollY: 380,
        scrollCollapse: true,
        scroller: true
    });

    $('#datatable-fixed-header').DataTable({
        fixedHeader: true
    });

    var $datatable = $('#datatable-checkbox');

    $datatable.dataTable({
        'order': [[ 1, 'asc' ]],
        'columnDefs': [
        { orderable: false, targets: [0] }
        ]
    });
    $datatable.on('draw.dt', function() {
        $('checkbox input').iCheck({
        checkboxClass: 'icheckbox_flat-green'
        });
    });

    TableManageButtons.init();

};
init_DataTables();
</script>
@endsection
