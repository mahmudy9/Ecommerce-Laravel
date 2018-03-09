@extends('app')

@section('content')


<div class="container">
<div class="row">
<div class="col-12">
</table>
<hr>
<h3>Orders Details</h3>
<table class="table">
<tr>
@php
$num = 1;
@endphp
<td>#</td>
<td>Product name</td>
<td>Vendor Name</td>
<td>Quantity</td>
<td>Product price</td>
<td>Review</td>
</tr>
@foreach($details->products as $order)
<tr>
<td>{{$num}}</td>
<td><a href="{{url('product/'.$order->id.'/'.$order->slug)}}">{{$order->name}}</a></td>
<td>{{$order->user->name}}</td>
<td>{{$order->pivot->quantity}}</td>
<td>{{$order->pivot->price}}</td>
<td><a href="{{url('/user/review/'.$order->id)}}" class="btn btn-info">Write Review</a></td>
</tr>
@php
$num++
@endphp
@endforeach
</table>
</div>
</div>
</div>


@endsection