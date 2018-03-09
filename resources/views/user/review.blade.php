@extends('app')

@section('content')


<div class="container">

<div class="row">

<div class="col-4">

<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="{{asset('storage/products/'.$product->img)}}" alt="Card image cap">
  <div class="card-body">
    <p class="card-text">{{$product->name}}</p>
  </div>
</div>

</div>
<div class="col-8">
@include('errors')
<form method="post" action="{{url('/user/postreview')}}">
@csrf
    <div class="form-group" >
        <label for="review" >Write Review</label>
        <textarea name="review" class="form-control" cols="30" rows="6" >{{old('review')}}</textarea>
    </div>
    <input type="hidden" value="{{$product->id}}" name="product_id" >
    <div class="form-group" >
        <button type="submit" class="btn btn-success">Submit Review</button>
    </div>
</form>
</div>

</div>

</div>


@endsection