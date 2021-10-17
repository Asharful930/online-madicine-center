@extends('layouts.app')
@section('style')
<style>
    .content ul li {
        margin: 10px;
    }
</style>
@endsection
@section('content')
<div class="col-md-12" id="content">
    <div class="row justify-content-center">
        <div class="breadcrumbs">
            <a href="url(/)"><i class="fa fa-home"></i></a>
            <a href="">{{$about ?? 'Contact Us'}}</a>
        </div>
        <div class="col-md-12 content">
            <div class="supervisor">
                <div class="col-lg-3" style="text-align: center;">
                    <div class="developer-img">
                        <img width="100%" src="http://diu-routine.test/img/tanvir-sir.jpg" alt="Tanvir Rahman">
                    </div>
                    <h3>Md. Tanvir Rahman</h3>
                    <span style="font-size:12px; font-weight:normal;">Lecturer (Senior Scale)</span>
                    <p>Daffodil International University</p>
                    <p><strong>-Supervisor &amp; Development Head</strong></p>
                </div>
                <div class="col-lg-3" style="text-align: center;">
                    <div class="developer-img">
                        <img width="100%" src="http://diu-routine.test/img/tanvir-sir.jpg" alt="Tanvir Rahman">
                    </div>
                    <h3>Md. Tanvir Rahman</h3>
                    <span style="font-size:12px; font-weight:normal;">Lecturer (Senior Scale)</span>
                    <p>Daffodil International University</p>
                    <p><strong>-Supervisor &amp; Development Head</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection