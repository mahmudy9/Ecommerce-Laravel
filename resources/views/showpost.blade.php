@extends('app')

@section('content')

<div class="container">
<div class="row">
<div class="col-8">
<h2>{{$post->title}}</h2>

<small>{{$post->created_at}}</small>
<hr>
<p>{!!clean($post->body)!!}</p>
</div>
</div>
</div>

@endsection