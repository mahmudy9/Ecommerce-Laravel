@extends('app')

@section('content')

<div class="container">

<div class="row">
<h3>Settings Update</h3>
<div class="col-12">
@include('errors')
@include('flash')
<form action="{{url('user/storesettings')}}" method="post" >
@csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" name="email" value="{{$user->email}}" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Name</label>
      <input type="text" name="name" value="{{$user->name}}" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" name="address" value="{{$user->address}}" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" name="city" value="{{$user->city}}" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-6">
      <label for="inputCity">Phone</label>
      <input type="text" name="phone" value="{{$user->phone}}" class="form-control" id="inputCity">
    </div>

  

  <button type="submit" class="btn btn-primary">Update Data</button>
</form>

</div>

</div>


</div>








@endsection