@extends('layouts.admin.app')
    @section('style')
    <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href=".{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    @endsection
    @section('content')
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">New seller Requests</div>
          <div class="card-body">
          @if($sellers->isEmpty())
            <div class="alert alert-danger">No seller Requests yet!</div>
          @else
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr>
                  <th>Frist Name</th>
                  <th>Last name Name</th>
                  <th>Seller Email</th>
                  <th>Shop contact</th>
                  <th>Seller  NID</th>
                  <th>Action</th>
                </tr>
              </thead>


              <tbody>
                  @foreach($sellers as $seller)
                  <tr>
                  <td>{{$seller->f_name}}</td>
                  <td>{{$seller->l_name}}</td>
                  <td>{{$seller->email}}</td>
                  <td>{{$seller->contact}}</td>
                  <td>{{$seller->nid}}</td>
                  <td>
                    <form action="{{route('edit.seller.activation',$seller->id)}}" method="post">
                      @csrf
                      @method('PATCH')
                      <input type="submit" value="Accept" class="btn btn-success">
                    </form>
                    <form action="{{route('edit.seller.reject',$seller->id)}}" method="post">
                      @csrf
                      @method('PATCH')
                      <input type="submit" value="Reject" class="btn btn-danger">
                    </form>
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
    @endsection


</body>
</html>