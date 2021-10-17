@extends('layouts.shop.app')
@section('content')
@include('layouts.partial.flashMessage')
<div class="card">
    <div class="card-header"><h3>Add Admin Information</h3></div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('manager.update',$shop->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="">Your Name</label>
                <input type="text" class="form-control" name="m_name" value="{{$shop->m_name}}">
                @error('f_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Your Email</label>
                <input type="email" class="form-control" name="m_email"  value="{{$shop->m_email}}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Password</label>
                 <input type="password" class="form-control" name="password" value="{{null}}" placeholder="enter the  password">
                 @error('password')
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