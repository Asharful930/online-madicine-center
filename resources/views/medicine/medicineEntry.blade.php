@extends('layouts.shop.app')
@section('content')
<div class="card">
    <div class="card-header"><h3>Enter medicine</h3></div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('medicine.store')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="">Medicine ID</label>
                <input type="text" class="form-control" name="medicine_id" placeholder="enter the Medicine id" value="{{ old('medicine_id') }}">
                @error('medicine_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Medicine Name</label>
                <input type="text" class="form-control" name="medicine_name" placeholder="enter the medicine name" value="{{ old('medicine_name') }}">
                @error('medicine_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Company Name</label>
                <input type="text" class="form-control" name="company_name" placeholder="enter the company name" value="{{ old('company_name') }}">
                @error('m_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Generic Name</label>
                 <input type="text" class="form-control" name="generic_name" placeholder="enter the generic name">
                 @error('generic_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Medicine Type</label>
                 <input type="text" class="form-control" name="medicine_type" placeholder="enter the medicine type">
                 @error('medicine_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">medicine_price</label>
                 <input type="number" class="form-control" name="medicine_price" placeholder="enter the medicine price">
                 @error('medicine_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea class="form-control" name="description" id="" cols="30" rows="5"></textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Image</label>
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
