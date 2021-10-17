@extends('layouts.user.app')
    @section('style')
    <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/smartphoto@1.1.0/css/smartphoto.min.css">
    @endsection
    @section('content')
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">Prescription Lists</div>
          <div class="card-body">
          @if(isset($prescriptions) && $prescriptions->isEmpty())
            <div class="alert alert-danger">No Prescription yet!</div>
          @else
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr >
                  <th class="text-center">Date</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Address</th>
                  <th class="text-center">Contact</th>
                  <th class="text-center">Course/Days</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">image</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>


              <tbody>
                  @foreach($prescriptions as $prescription)
                  <tr>
                  <td>{{$prescription->created_at->format('M d Y')}}</td>
                  <td>{{$prescription->name}}</td>
                  <td>{{$prescription->address}}</td>
                  <td>{{$prescription->contact}}</td>
                  <td>{{$prescription->course}}</td>
                  <td>{{$prescription->status}}</td>
                  <td>
                        <a href="{{$prescription->image}}" class="js-smartPhoto" data-caption="{{$prescription->name}}">
                            <img src="{{$prescription->image}}" style="max-width: 100px"/>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('edit.request',$prescription->id)}}" class="btn btn-primary btn-sm">update</a>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          @endif
          </div>
        </div>
      </div>

    @endsection
    @section('script')
    <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.min.js"></script>
    <script>
         window.addEventListener('DOMContentLoaded',function(){
        new SmartPhoto(".js-smartPhoto");
    });
    </script>
    <!-- Custom Theme Scripts -->
    @endsection


</body>
</html>
