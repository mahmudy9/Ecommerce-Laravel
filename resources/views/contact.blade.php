@extends('app')

@section('content')

<div class="container">

<h2>This is Contact Page</h2>

<div class="row">
<div class="col-8">
@include('errors')
@include('flash')
<form method="post" action="{{url('storecontact')}}" >
@csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Name</label>
      <input type="text" name="name" class="form-control" id="inputEmail4" placeholder="Name...">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Email</label>
      <input type="email" name="email" class="form-control" id="inputPassword4" placeholder="Email...">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Message</label>
    <textarea name="message" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label for="inputAddress"></label>
    <input type="submit" class="btn btn-primary" name="submit" value="Send" />
  </div>
</form>

</div></div>
</div>

@endsection