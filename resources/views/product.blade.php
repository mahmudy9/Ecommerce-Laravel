@include('layouts.header')

<br><br>

<div class="container">

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
<p><button class="btn btn-success" 
@auth onclick="addtocart('{{$product->id}}' , '{{url('addtocart')}}')" @else onclick="window.location.href='{{route('login')}}'" @endauth >Add To Cart</button>
</div>
</div>



</div>




@include('layouts.footer')