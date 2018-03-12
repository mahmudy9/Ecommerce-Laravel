@extends('admin.dashboard')

@section('content')

<div class="container">
<div class="row">
<div class="col-8">
<h2>Posts List</h2>

@foreach($posts as $post)

<div class="card w-100" id="{{$post->id}}">
  <div class="card-body">
    <h5 class="card-title"><a  href="{{url('post/'.$post->id.'/'.$post->slug)}}" >{{$post->title}}</a></h5>
    <small>{{$post->created_at}}</small>
    <p class="card-text">{!!substr(clean($post->body , ['HTML.Allowed' => '']),0,140)!!}</p>
    

    <hr>
    <a  class="btn btn-primary" href="{{url('admin/editpost/'.$post->id)}}" >Edit Post</a>
    <hr>
    <button onclick="delete_post('{{$post->id}}' , '{{url('/admin/deletepost')}}')" class="btn btn-primary">Delete Post</button>
  </div>
</div>

@endforeach
{{$posts->links('paginator')}}
</div>

</div>

</div>

@endsection