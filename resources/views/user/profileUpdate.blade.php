@extends('layouts.user.app')
@section('content')
@include('layouts.partial.flashMessage')
<div class="card">
    <div class="card-header"><h3>Add Your Information</h3></div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('update.profile',$user->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="">Your First Name</label>
                <input type="text" class="form-control" name="f_name" value="{{$user->f_name}}">
                @error('f_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Your Last Name</label>
                <input type="text" class="form-control" name="l_name" value="{{$user->l_name}}">
                @error('l_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Your Email</label>
                <input type="email" class="form-control" name="email"  value="{{$user->email}}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Your Address</label>
                <input type="text" class="form-control" name="address"  value="{{$user->address}}">
                @error('address')
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
            <div class="form-group">
                 <label for="">Your Contact</label>
                 <input type="text" class="form-control" name="contact" value="{{$user->contact}}" placeholder="enter the student Contact">
                 @error('contact')
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