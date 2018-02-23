@extends('app')
@section('content')   
<div class="container"> 
<div class="row justify-content-center">   
<div class="col-8"  >
<h2>Register As Vendor</h2>
@include('errors')
@include('flash')
<form method="POST" action="{{ route('vendor.post.register') }}">
@csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Name</label>
      <input type="text" value="{{old('name')}}" class="form-control" id="inputEmail4" name="name" placeholder="Name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" value="{{old('email')}}" class="form-control" id="inputEmail4" name="email" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" class="form-control" name="password_confirmation" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" value="{{old('address')}}" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" value=" {{old('city')}} " class="form-control" name="city" id="inputCity">
    </div>
    <div class="form-group col-md-6">
      <label for="inputCity">Phone</label>
      <input type="text" value=" {{old('phone')}} " class="form-control" name="phone" id="inputCity">
    </div>

  </div>
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
</div>
</div>
</div>
@endsection