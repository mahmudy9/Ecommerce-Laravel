@extends('app')

@section('content')

<div class="container">

<div class="row">

<div class="col-12">
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
</tr>
@foreach($carts->products as $item)

  <tr id="{{$item->pivot->uniqid}}">
    <td>#{{$num}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->pivot->price}}</td>
    <td>{{$item->pivot->quantity}}</td>
  </tr>
@php
$num++;
$total = $total + $item->pivot->price;
@endphp
@endforeach
</table>
<h3>Total = {{$total}}</h3>


<hr>

<form action="/user/charge" method="POST">
@csrf
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_73s935MgzVyQ4ogR9lzkZwYs"
    data-amount="{{$total * 100}}"
    data-name="Demo Site"
    data-description="Example charge"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto">
  </script>
</form>


</div>

</div>

</div>

@endsection