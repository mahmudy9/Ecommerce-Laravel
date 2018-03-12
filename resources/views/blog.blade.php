@extends('app')

@section('content')
<div class="container" >
<h2>Market Blog</h2>
<div class="row">
<div class="col-8">
@foreach($posts as $post)
<div class="card w-100">
  <div class="card-body">
    <h5 class="card-title">{{$post->title}}</h5>
    <small>{{$post->created_at}}
    <p class="card-text">{!!substr(clean($post->body , ['HTML.Allowed' => '']), 0 , 150)!!}...</p>
    <a href="{{url('post/'.$post->id.'/'.$post->slug)}}" class="btn btn-primary">Read Post</a>
  </div>
</div>
@endforeach

{{$posts->links('paginator')}}
</div>
</div>
</div>
@endsection