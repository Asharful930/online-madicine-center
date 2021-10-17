@extends('layouts.user.app')
@section('content')
<div class="card">
    <div class="card-header"><h3>Upload Prescription</h3></div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('update.prescrpiton',$prescription->id)}}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for=""> Name</label>
                <input type="text" class="form-control" name="name"  value="{{$prescription->name}}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Contact</label>
                 <input type="number" class="form-control" name="contact"  value="{{$prescription->contact}}">
                 @error('contact')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for=""> Your Address</label>
                <input type="text" class="form-control" name="address" value="{{$prescription->address}}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Course/Days</label>
                <input type="number" class="form-control" name="course" value="{{$prescription->course}}">
                @error('course')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for=""> Prescription Image</label>
                <input type="file" class="form-control" name="image" value="{{$prescription->image}}">
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