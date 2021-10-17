@extends('layouts.user.app')
@section('content')
<div class="card">
    <div class="card-header"><h3>Upload Prescription</h3></div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('store.prescription')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for=""> Name</label>
                <input type="text" class="form-control" name="name" placeholder="enter the your name" value="{{auth()->user()->f_name}} {{auth()->user()->l_name}}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Contact</label>
                 <input type="number" class="form-control" name="contact" placeholder="Phone Number" value="{{auth()->user()->contact}}">
                 @error('contact')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for=""> Your Address</label>
                <input type="text" class="form-control" name="address" placeholder="enter the your address" value="{{auth()->user()->address}}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Course/Days</label>
                <input type="number" class="form-control" name="course" placeholder="Medicine Course or days">
                @error('course')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for=""> Prescription Image</label>
                <input type="file" class="form-control" name="image">
                @error('image')
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