@include('layouts.header')

<br><br>

<div class="container">
<h2>{{$product->name}}</h2>
<div class="row justify-content-center">
<div class="col-4">
<img src="{{asset('storage/products/'.$product->img)}}" width="350px" height="300px" />
</div>
<div class = "col-4">
<p>{{$product->description}}</p>
</div>

<div class="col-4">
@php
$cslug = strtolower(str_replace( ' ' , '-' ,$product->category->name));
$bslug = strtolower(str_replace( ' ' , '-' ,$product->brand->name));

@endphp
<p>Vendor: <a href="{{url('vendor/'.$product->user->id)}}">{{$product->user->name}}</a></p>
<p>Category: <a href="{{url('category/'.$product->category->id.'/'.$cslug)}}" >{{$product->category->name}}</a></p>
<p>Brand: <a href="{{url('brand/'.$product->brand->id.'/'.$bslug)}}" >{{$product->brand->name}}</a></p>
<p><h3>Price: {{$product->price}} $</h3></p>
<p>
@auth
@if(Auth::user()->isadmin == 0 && Auth::user()->isvendor == 0 )
<button class="btn btn-success" 

 onclick="addtocart('{{$product->id}}' , '{{url('addtocart')}}')" >Add To Cart</button>
 @endif
 @else
 <button class="btn btn-success" onclick="window.location.href='{{route('login')}}'"  >Add To Cart</button>


@endauth
</div>
<div class="col-8">
@foreach ($reviews as $review )
    
<div class="card">
  <div class="card-header">
  </div>
  <div class="card-body">
    <h5 class="card-title">User: {{$review->user->name}}</h5>
    <p class="card-text">{{$review->body}}</p>
    <!--a href="#" class="btn btn-primary">Go somewhere</a-->
  </div>
</div>
<br>
@endforeach

</div>
</div>



</div>



@include('layouts.footer')