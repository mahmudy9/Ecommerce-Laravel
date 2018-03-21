@extends('admin.dashboard')


@section('content')
<div class="container">
Approve Reviews
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
    <div class="row">
    <div class="col-6">
    <button onclick="approve_review('{{$review->id}}' , '{{url('/admin/approvereview/')}}')" class="btn btn-primary">Approve Review</button>
    </div>
    <div class="col-6">
    <button onclick="delete_review('{{$review->id}}' , '{{url('/admin/deletereview/')}}')" class="btn btn-danger">Delete Review</button>
    </div>
    </div>
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