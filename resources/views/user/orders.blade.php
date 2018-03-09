@extends('app')

@section('content')


<div class="container">
<div class="row">
<div class="col-12">
<h3>Orders</h3>
<table class="table">
<tr>
<td>Order</td>
<td>Order Total</td>
</tr>
@php
$num = 1;
@endphp
@foreach($orders as $order)
<tr>
<td>{{$num}}</td>
<td>{{$order->total}}</td>
<td><a href="{{url('/user'.'/orders/'.$order->id)}}" class="btn btn-info">Show Order Details</a></td>
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