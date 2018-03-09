@extends('app')

@section('content')
<div class="container">
<div class="row">
<div class="col-12">
@if($carty)
<table class="table">
@php
$num = 1;
$total = 0;
@endphp
<tr>
<td>#</td>
<td>Name</td>
<td>Price</td>
<td>Quantity</td>
<td>Delete</td>
</tr>
@foreach($carty->products as $item)

  <tr id="{{$item->pivot->uniqid}}">
    <td>#{{$num}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->pivot->price}}</td>
    <td>{{$item->pivot->quantity}}</td>
    <td><a class="btn btn-danger" style="color:white" onclick="destroy_cart_item('{{$item->pivot->uniqid}}' , '{{url('/cart/destroy')}}')" >Delete</a></td>
  </tr>
@php
$num++;
$total = $total + $item->pivot->price;
@endphp
@endforeach
</table>
<h3>Total = {{$total}}</h3>
<hr>
<br>
@if($total > 0)
<a href="{{url('user/checkout')}}" class="btn btn-success">Proceed To Checkout</a>
@endif
@endif

</div>
</div>
</div>
@endsection