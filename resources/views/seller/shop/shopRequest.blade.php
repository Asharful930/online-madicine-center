@extends('layouts.seller.app')
@section('content')
<div class="card">
    <div class="card-header"><h3>Request New Shop</h3></div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('seller.shop.shopRequest.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Shop Name</label>
                <input type="text" class="form-control" name="shop_name" placeholder="enter the shop name" value="{{ old('shop_name') }}">
                @error('shop_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Manager Name</label>
                <input type="text" class="form-control" name="m_name" placeholder="enter the manager name" value="{{ old('m_name') }}">
                @error('m_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Manager Email</label>
                <input type="email" class="form-control" name="m_email" placeholder="enter the manager email" value="{{ old('m_email') }}">
                @error('m_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Password</label>
                 <input type="password" class="form-control" name="password" placeholder="enter the password">
                 @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Confirm Password</label>
                 <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                 @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Shop Adress</label>
                 <input type="text" class="form-control" name="s_address" placeholder="enter the shop address"  value="{{ old('s_address') }}">
                 @error('s_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Shop contact</label>
                <input type="text" class="form-control" name="s_contact" placeholder="enter the shop contact number"  value="{{ old('s_contact') }}">
                @error('s_contact')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection