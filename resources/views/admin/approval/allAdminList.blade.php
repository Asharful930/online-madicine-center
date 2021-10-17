@extends('layouts.admin.app')
    @section('style')
    <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    @endsection
    @section('content')
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">New Admin Requests</div>
          <div class="card-body">
          @if($admins->isEmpty())
            <div class="alert alert-danger">No Admin Requests yet!</div>
          @else
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr>
                  <th>Frist Name</th>
                  <th>Last name Name</th>
                  <th>Admin Email</th>
                  <th>Shop contact</th>
                </tr>
              </thead>


              <tbody>
                  @foreach($admins as $admin)
                  <tr>
                  <td>{{$admin->f_name}}</td>
                  <td>{{$admin->l_name}}</td>
                  <td>{{$admin->email}}</td>
                  <td>{{$admin->contact}}</td>
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
    @endsection


</body>
</html>