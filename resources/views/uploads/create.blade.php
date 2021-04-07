@extends('layouts.app')
@section('content')

@if($errors->any())
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<h3 class="jumbotron">Laravel Multiple File Upload</h3>
<form method="post" action="{{url('uploads')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="input-group control-group increment mb-2" >
    <input type="text" name="user_name" class="form-control" placeholder="Enter Username">
  </div>
        <div class="input-group control-group increment mb-2" >
          <input type="file" name="user_image[]" class="form-control" multiple >
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
  </form>      
@endsection