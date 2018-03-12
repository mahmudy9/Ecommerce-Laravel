@extends('app')

@section('content')

<div class="container">
<div class="row">
<div class="col-8">
<h3>Contact Information</h3>
@include('errors')
<form method="post" action="{{url('user/confirminfo')}}" >
@csrf
  <div class="form-group">
    <label for="inputAddress">City</label>
    <input type="text" name="city" value="{{$user->city}}" class="form-control" id="inputAddress">
  </div>
    <div class="form-group">
      <label for="inputCity">Address</label>
      <input type="text" name="address" value="{{$user->address}}" class="form-control" id="inputCity">
  </div>
  <div class="form-group">
      <label for="inputCity">Phone</label>
      <input type="text" name="phone" value="{{$user->phone}}"  class="form-control" id="inputCity">
  </div>
    <div class="form-group">
      <label for="inputCity"></label>
      <input type="submit" name="submit"  class="btn btn-primary" value="Confirm Contact Info" id="inputCity">
  </div>

  </form>

</div>
</div>
</div>





@endsection