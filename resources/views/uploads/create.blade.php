@extends('layouts.app')
@section('content')

@if (count($errors) > 0)
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
          <input type="file" name="file_name[]" class="form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-success" type="button" onclick="addRows();"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
  </form>      
@endsection
@section('script')
<script type="text/javascript">

var new_row = 0;
function addRows() {   
    
    html = '<div id="new-row' + new_row + '" class="input-group control-group mb-2" >';
    html += '<input type="file" name="file_name[]" class="form-control">';
    html += '<div class="input-group-btn">';
    html += '<button class="btn btn-danger" type="button" onclick="$(\'#new-row' + new_row + '\').remove();"><i class="fa fa-trash"></i> Delete</button>';
    html += '</div>'
    html += '</div>';

$('.increment').after(html);

new_row++;
}
</script>
@endsection