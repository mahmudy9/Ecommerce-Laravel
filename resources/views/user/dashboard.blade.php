@extends('app')

@section('content')

<center><h2>User Dashboard</h2></center>


<div class="row">
<div class="col-4">
<ul class="list-group">
<a href="{{url('user/cart')}}">
  <li class="list-group-item d-flex justify-content-between align-items-center">
Cart Items<span class="badge badge-primary badge-pill">{{$count}}</span>
  </li>
  </a>
  <a href="{{url('user/orders')}}">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    My Orders
    <span class="badge badge-primary badge-pill">2</span>
  </li>
  </a>
  <a href="{{url('user/settings')}}">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    My Settings
    <span class="badge badge-primary badge-pill">1</span>
  </li>
  </a>
</ul>
</div></div>


@endsection