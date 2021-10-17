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
          <div class="card-header">Medicine List</div>
          <div class="card-body">
          @if(isset($medicines) && $medicines->isEmpty())
            <div class="alert alert-danger">No Medicine yet!</div>
          @else
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr>
                  <th>Medicine ID</th>
                  <th>Medicine Name</th>
                  <th>Company Name</th>
                  <th>Geeneric Name</th>
                  <th>Medicine Type</th>
                  <th>Medicine  price</th>
                  <th>Shop Name</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>


              <tbody>
                  @foreach($medicines as $medicine)
                  <tr>
                  <td>{{$medicine->medicine_id}}</td>
                  <td>{{$medicine->medicine_name}}</td>
                  <td>{{$medicine->company_name}}</td>
                  <td>{{$medicine->generic_name}}</td>
                  <td>{{$medicine->medicine_type}}</td>
                  <td>{{$medicine->medicine_price}} BDT/Pcs</td>
                  <td>{{$medicine->shop->shop_name}}</td>
                  <td>{{substr($medicine->description,0,16)}}....</td>
                  <td><img src="{{$medicine->image}}" style="height:60px;width:100px;"/></td>
                  <td>
                  <form action="{{route('admin.deletemedicine',$medicine->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <input type="submit" value="delete" class="btn btn-danger btn btn-sm">
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
    <!-- Custom Theme Scripts -->
    @endsection


</body>
</html>
