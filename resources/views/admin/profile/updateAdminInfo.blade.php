@extends('layouts.admin.app')
@section('content')
@include('layouts.partial.flashMessage')
<div class="card">
    <div class="card-header"><h3>Add Admin Information</h3></div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('admin.updateAdmin',$admin->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="">Admin First Name</label>
                <input type="text" class="form-control" name="f_name" value="{{$admin->f_name}}">
                @error('f_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Admin Last Name</label>
                <input type="text" class="form-control" name="l_name" value="{{$admin->l_name}}">
                @error('st_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Admin Email</label>
                <input type="email" class="form-control" name="email"  value="{{$admin->email}}">
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
            <div class="form-group">
                 <label for="">Admin Contact</label>
                 <input type="text" class="form-control" name="contact" value="{{$admin->contact}}" placeholder="enter the student Contact">
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