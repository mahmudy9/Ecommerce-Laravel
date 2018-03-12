@extends('admin.dashboard')

@section('content')

<div class="container">
<div class="row">
<div class="col-9">
@include('errors')
@include('flash')
<form action="{{url('admin/storepost')}}" method="post" >
@csrf
<div class="form-group">
<label for="title">Title</label>
<input type="text" name="title" class="form-control" value="{{old('title')}}" />
</div>
<div class="form-group">
<label for="body">Article Body</label>
<textarea name="body" id="mytext" >{{old('body')}}</textarea>
</div>
<div class="form-group">
<input type="submit" class="btn btn-success" value="Submit Post" />
</div>
</form>
</div>
</div>


</div>


@endsection