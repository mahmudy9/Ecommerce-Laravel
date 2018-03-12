@extends('admin.dashboard')

@section('content')

<div class="container">
<div class="row">
<div class="col-9">
<h3>Update Post</h3>
@include('errors')
@include('flash')
<form action="{{url('admin/updatepost')}}" method="post" >
@csrf
<input type="hidden" name="id" value="{{$post->id}}" />
<div class="form-group">
<label for="title">Title</label>
<input type="text" name="title" class="form-control" value="{{$post->title}}" />
</div>
<div class="form-group">
<label for="body">Article Body</label>
<textarea name="body" id="mytext" >{{$post->body}}</textarea>
</div>
<div class="form-group">
<input type="submit" class="btn btn-success" value="Update Post" />
</div>
</form>
</div>
</div>


</div>


@endsection