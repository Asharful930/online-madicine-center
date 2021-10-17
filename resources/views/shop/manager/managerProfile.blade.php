@extends('layouts.shop.app')
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
          <div class="card-header">Your Profile</div>
          <div class="card-body">
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr>
                  <th>Your Name</th>
                  <th>Your Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                  <td>{{$shop->m_name}}</td>
                  <td>{{$shop->m_email  }}</td>
                  <td>
                    <a href="{{route('manager.edit',$shop->id)}}" class="btn btn-success btn-sm">Edit</a> 
                      @csrf
                      @method('PATCH')
                  </td>
                  </tr>
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
  
    @endsection


</body>
</html>