@extends('vendor.dashboard')

@section('content')
<div class="container">
<div class="row" >
<div class="col-8">
<h2>Edit Product Page</h2>
<br>
@include('errors')
@include('flash')
<br>
<form action= "{{url('/vendor/updateproduct/'.$product->id)}}" method = "post"  enctype="multipart/form-data" >
@csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">Product Name</label>
    <input type="text" name="name" value="{{$product->name}}"  class="form-control" required>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Product Description</label>
    <textarea class="form-control" name="description" rows="3" required>{{$product->description}}</textarea>
  </div>
  <div class="row">
  <div class="form-group col-sm-6">
    <label for="category">Category</label>
    <select name="category" required>
      <option>Select category..</option>
      @foreach($categories as $category)
        <option value="{{$category->id}}" @if($category->id == $product->category_id)
        selected
        @endif >{{$category->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-sm-6">
    <label for="brand">brand</label>
    <select name="brand" required>
      <option>Select brand..</option>
      @foreach($brands as $brand)
        <option value="{{$brand->id}}" 
        @if($brand->id == $product->brand_id)
        selected
        @endif
        >{{$brand->name}}</option>
      @endforeach
    </select>
  </div>
  </div>
  <div class="row">
    <div class="form-group col-sm-6">
    <label for="exampleFormControlInput1">Product price</label>
    <input type="text" name="price" value="{{$product->price}}"  class="form-control" required>
  </div>
  <div class="form-group col-sm-6">
    <label for="exampleFormControlInput1">Product Quantity</label>
    <input type="number" min="1" name="quantity" value="{{$product->quantity}}"  class="form-control" required>
  </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Product Image (If You want the old image keep it blank)</label>
    <input type="file" name="image" value="{{$product->img}}" class="form-control" />
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1"></label>
    <input type="submit" name="submit" class="btn btn-primary" value="Update Product">
  </div>

</form>


</div>
</div>
</div>
@endsection


