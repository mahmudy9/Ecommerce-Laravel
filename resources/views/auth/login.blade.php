@extends('app')

@section('content')
<div class="container" >
<div class="row justify-content-center">
<div class = "col-8">
<h2>LogIn</h2>
@include('errors')
<form method="POST" action="{{ route('login') }}">
                        @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" name="remember" for="exampleCheck1">Keep me</label>
  </div>
    <p><small>
    <a href="{{route('password.request')}}" >Forgot Password</a>
</small></p>
    <div class="text-center">
        <button class="btn btn-primary">Login</button>
    </div>
</form>
</div></div></div>


@endsection
