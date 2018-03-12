@extends('vendor.dashboard')

@section('content')
<div class="container">
<div class="row">
<div class="col-8">
<br><br>
@php
$num = 1;
@endphp
@foreach($requests as $req)
<div class="card">
  <div class="card-header">
    #{{$num}}<br>
    Customer: {{$req->user->name}}
  </div>
  <div class="card-body">
      <p>Product: <a href="{{url('product/'.$req->product->id.'/'.$req->product->slug)}}" class="btn btn-info">{{$req->product->name}}</a></p>
      <p>Quantity: {{$req->quantity}}</p>
      <p>City: {{$req->user->city}}</p>
      <p>Phone: {{$req->user->phone}}</p>
      <p>Address: {{$req->user->address}}</p>
  </div>
</div>
@php
$num++
@endphp
@endforeach
{{$requests->links('paginator')}}
</div>
</div>

</div>

@endsection