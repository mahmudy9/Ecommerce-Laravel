@include('layouts.header')

<br><br>

<div class="container">
<h2>{{$product->name}}</h2>
<div class="row">
<div class="col-4">
<img src="{{asset('storage/products/'.$product->img)}}" width="350px" height="300px" />
</div>
<div class = "col-4">
<p>{{$product->description}}</p>
</div>

<div class="col-4">
<p>Vendor: {{$product->user->name}}</p>
<p>Category: {{$product->category->name}}</p>
<p>Brand: {{$product->brand->name}}</p>
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
</div>



</div>




@include('layouts.footer')