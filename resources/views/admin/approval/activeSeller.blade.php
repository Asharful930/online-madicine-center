
@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
        <div class="card">
          <div class="card-header">All Seller</div>
          <div class="card-body">
          @if($sellers->isEmpty())
            <div class="alert alert-danger">No seller Inactive yet!</div>
          @else
          <div class="x_content">
            <table id="inactive" class="table table-striped table-bordered" style="text-align:center; font-size:16px;  ">
              <thead>
                <tr>
                  <th>Frist Name</th>
                  <th>Last name Name</th>
                  <th>Seller Email</th>
                  <th>Seller contact</th>
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
                  <form  action="{{route('active.seller',$seller->id)}}" method="post" >
                  @csrf
                  @method('PATCH')
                  <input type="submit" value="Active" class="btn btn-primary">
                  </form>
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
@section('scripts')
    <script type="text/javascript">
        var $ = jQuery;
        $(document).ready(function() {
            $('#inactive').DataTable();
        } );
    </script>
@endsection