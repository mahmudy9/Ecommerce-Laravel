@extends('app')

@section('content')

<center><h2>User Dashboard</h2></center>

<div class="container">
<div class="row">
<div class="col-sm-3">
<ul>
<a class="btn btn-info" href="{{url('user/cart')}}">
  <li>
Cart Items <span class="badge badge-primary badge-pill">{{$count}}</span>
  </li>
  </a>
  <a class="btn btn-info" href="{{url('user/orders')}}">
  <li>
    My Orders 
    <span class="badge badge-primary badge-pill">2</span>
  </li>
  </a>
  <a class="btn btn-info" href="{{url('user/settings')}}">
  <li>
    My Settings 
  </li>
  </a>
</ul>
</div></div>
</div>

@endsection