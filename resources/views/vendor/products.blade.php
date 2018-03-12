@extends('vendor.dashboard')

@section('content')

<div class="container">

<div class="row">
@foreach ($products as $product)
  <div id="{{$product->id}}" class="col-4">
  <div class="card" style="width: 18rem;">
  <img class="card-img-top" width="200px" height="300px" src="{{asset('storage/products/'.$product->img)}}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{substr($product->name , 0 , 22)}}</h5>
    <p class="card-text">{{substr($product->description,0 , 100)}}</p>
    <div class="row">
    <div class="col-6">
    <p class="card-text"><small>Vendor: {{$product->user->name}}</small></p>
    </div>
    <div class="col-6">
    <p class="card-text"><small>Category: {{$product->category->name}}</small></p>
    </div>
    <div class="col-6">
    <p class="card-text"><small>Brand: {{$product->brand->name}}</small></p>
        </div>
    <div class="col-6">

    <p class="card-text"><small>Quantity: {{$product->quantity}}</small></p>
        </div>
    <div class="col-6">

    <p class="card-text"><small>Price: {{$product->price}}</small></p>
</div></div>
  </div>
</div>

  </div>
@endforeach

</div>

</div>
{{$products->links('paginator')}}

@endsection