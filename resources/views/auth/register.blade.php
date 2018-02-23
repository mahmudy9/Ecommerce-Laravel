@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">

                <h2> Register As Customer </h2>
                @include('errors')
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                          <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Name</label>
      <input type="text" value="{{old('name')}}" class="form-control" id="inputEmail4" name="name" placeholder="Name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" value="{{old('email')}}" class="form-control" name="email" id="inputEmail4" name="email" placeholder="Email">
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


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
