@extends('app')

@section('content')
<div class="container" >
<h2>Market Blog</h2>

@if(!empty($posts))
@foreach($posts as $post)
<div class="card w-100">
  <div class="card-body">
    <h5 class="card-title">{{$post->title}}</h5>
    <p class="card-text">{{substr($post->body, 0 , 150)}}...</p>
    <a href="{{url('post/'.$post->id.'/'.$post->slug)}}" class="btn btn-primary">Read Post</a>
  </div>
</div>
@endforeach
@else
<h2> No Posts Yet</h2>
@endif
{{$posts->links('paginator')}}
</div>
@endsection