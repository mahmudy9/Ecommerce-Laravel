@extends('app')

@section('content')

<center><h2>User Dashboard</h2></center>

<div class="container">
<div class="row">
<div class="col-sm-3">
<ul>
<a class="btn btn-info" href="{{url('user/cart')}}">

Cart Items <span class="badge badge-primary badge-pill">{{$count}}</span>

  </a>
  <hr>
  <a class="btn btn-info" href="{{url('user/orders')}}">
  
    My Orders 
  
  </a>
  <hr>
  <a class="btn btn-info" href="{{url('user/settings')}}">
  
    My Settings 

  </a>
</ul>
</div></div>
</div>

@endsection