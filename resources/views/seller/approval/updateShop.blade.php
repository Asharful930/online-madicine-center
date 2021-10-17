@extends('layouts.seller.app')
@section('content')
<div class="card">
    <div class="card-header"><h3>Edit Shop</h3></div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('update.shop',$shop->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="">Shop Name</label>
                <input type="text" class="form-control" name="shop_name" value="{{$shop->shop_name}}">
                @error('shop_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Manager Name</label>
                <input type="text" class="form-control" name="m_name"  value="{{$shop->m_name}}">
                @error('m_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Manager Email</label>
                <input type="email" class="form-control" name="m_email"  value="{{$shop->m_email}}">
                @error('m_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Password</label>
                 <input type="password" class="form-control" name="password"  value="{{null}}">
                 @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Shop Adress</label>
                 <input type="text" class="form-control" name="s_address"  value="{{$shop->s_address}}">
                 @error('s_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Shop contact</label>
                <input type="text" class="form-control" name="s_contact"  value="{{$shop->s_contact}}">
                @error('s_contact')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">    
                     <label for="">Ltitude</label>
                        <input type="text" class="form-control" name="latitude"  value="{{$shop->latitude}}">
                        @error('latitude')
                          <span class="invalid-feedback" role="alert">
                              <strong class="text-danger">{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
            <div class="form-group">
               <label for="">Longitude</label>                       
                <input type="text" class="form-control" name="longitude"  value="{{$shop->longitude}}">
                        @error('longitude')
                          <span class="invalid-feedback" role="alert">
                              <strong class="text-danger">{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection