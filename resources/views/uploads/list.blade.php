@extends('layouts.app')
@section('content')
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="float-left">
            <h2>All Images</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-success" href="{{ route('uploads.create') }}"> Upload new Images</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif   
    <table class="table table-bordered">
    <thead>
        <tr>
          <td>Sl No</td>
          <td>Filename</td>
          <td>Image</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @php $i = 1 @endphp
        @foreach($images as $image)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$image->file_name}}</td>
            <td><img src="{{url('/images').'/'.$image->file_name}}" alt="{{$image->file_name}}" width="100" height="100"></td>
            <td>
                <form action="{{ route('uploads.destroy', $image->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection