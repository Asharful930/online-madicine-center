@if ($message = Session::get('status'))
<div class="container mt-5">
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
    <strong>{{ $message }}</strong>
</div>
</div>
@endif
@if ($message = Session::get('error'))
<div class="container mt-5">
<div class="alert alert-danger alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>	
    <strong>{{ $message }}</strong>
</div>
</div>
@endif
@if ($message = Session::get('warning'))
<div class="container mt-5">
<div class="alert alert-warning alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>{{ $message }}</strong>
</div>
</div>
@endif