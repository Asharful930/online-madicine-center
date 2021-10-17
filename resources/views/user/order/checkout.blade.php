@extends('layouts.nosidebar-app')

@section('content')
<div class="contentContainer">
    <div class="contentText">
        <div class="breadcrumbs">
            <a href="{{url('/')}}" class="headerNavigation"><i class="fa fa-home"></i></a>
            <a href="{{route('user.checkout')}}">Checkout</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Order Details</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="text-left">Product Name</td>
                                <td class="text-right">Quantity</td>
                                <td class="text-right">Unit Price</td>
                                <td class="text-right">Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$medicines->isEmpty())
                            @foreach($medicines as $medicine)
                            <tr>
                                <td class="text-left"><a
                                        href="{{route('medicine.single',$medicine->id)}}">{{$medicine->medicine_name}}</a>
                                    <br>
                                    <small>Shop Name: {{$medicine->shop->shop_name}}</small>
                                </td>
                                <td class="text-right">
                                    <br>
                                    {{$medicine->quantity}}
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
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Shipping Details</h3>
                </div>
                <div class="panel-body">
                    <form action="{{route('user.order.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}" />
                        <p> <strong> Orderd By:</strong></p>
                        <div class="form-group col-md-6">
                            <label class="sr-only" for="user_name">Ordered By</label>
                            <input type="text" class="form-control" name="user_name" id="user_name"
                                value="{{auth()->user()->f_name}} {{auth()->user()->l_name}}" disabled />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="sr-only" for="user_contact">Contact</label>
                            <input type="text" class="form-control" name="user_contact" id="user_contact"
                                placeholder="User Contact" value="{{auth()->user()->contact}}" disabled>
                        </div>
                        <p> <strong>Shipped To:</strong></p>
                        <div class="alert alert-info">If the shipping is to the user, there is no need to add
                            <strong>Shipped to </strong>and <strong> Contact </strong> bellow</div>
                        <div class="radio">
                            <label style="margin-right: 10px">
                                <input type="radio" name="type" id="self" value="self" checked>
                                Self
                            </label>
                            <label>
                                <input type="radio" name="type" id="other" value="other">
                                Other
                            </label>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="sr-only" for="shipped_to">Shipped To</label>
                            <input type="text" class="form-control" name="shipped_to" id="shipped_to"
                                placeholder="Shipped To" value="{{old('shipped_to')}}">
                            @error('shipped_to')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="sr-only" for="contact">Contact</label>
                            <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact"
                                value="{{old('contact')}}">
                            @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label class="sr-only" for="contact">Address</label>
                            <input type="text" class="form-control" name="shipping_address" placeholder="Address"
                                id="address" value="{{old('shipping_address') ?? auth()->user()->address}}">
                            @error('shipping_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div style="float: right;margin-right: 1em;">
                            <button class="btn btn-success" type="submit">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Pricing Details</h3>
                </div>
                <div class="panel-body">
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
        </div>
    </div>
</div>
@endsection

@section('scripts')

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

    $('#usertable').dataTable();

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

$('.btn-user-add').on('click',function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var address = $(this).data('address');
    var contact = $(this).data('contact');
    $('#user_id').val(id);
    $('#user_name').val(name);
    $('#user_contact').val(contact);
    $('#address').val(address);
});
</script>
@endsection
