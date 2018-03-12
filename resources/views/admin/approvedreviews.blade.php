@extends('admin.dashboard')


@section('content')
<div class="container">
Approved Reviews
<div class="row">
<div class="col-8">
@php
$num =1;
@endphp
@foreach($reviews as $review)

<div class="card" id="{{$review->id}}" >
  <div class="card-header">
    #{{$num}}<br>
    userID: {{$review->user_id}}<br>
    {{$review->user->name}}
  </div>
  <div class="card-body">
    <h5 class="card-title"><a href="{{url('/admin/showproduct/'.$review->product_id)}}" class="btn btn-info">{{$review->product->name}}</a>
</h5>
    <p class="card-text">{{$review->body}}</p>
    <button onclick="disapprove_review('{{$review->id}}' , '{{url('/admin/disapprovereview/')}}')" class="btn btn-primary">Disapprove Review</button><hr>
  </div>
</div>
@php
$num++
@endphp
@endforeach
</div>
</div>


</div>


@endsection