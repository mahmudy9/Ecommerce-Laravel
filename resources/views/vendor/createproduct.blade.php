@extends('vendor.dashboard')

@section('content')
<div class="container">
<div class="row" >
<div class="col-8">
<h2>Add Product Page</h2>
<br>
@include('errors')
@include('flash')
<br>
<form action= "{{url('/vendor/storeproduct')}}" method = "post"  enctype="multipart/form-data" >
@csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">Product Name</label>
    <input type="text" name="name" value="{{old('name')}}"  class="form-control" required>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Product Description</label>
    <textarea class="form-control" name="description" rows="3" required>{{old('description')}} </textarea>
  </div>
  <div class="row">
  <div class="form-group col-sm-6">
    <label for="category">Category</label>
    <select name="category" required>
      <option selected>Select category..</option>
      @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-sm-6">
    <label for="brand">brand</label>
    <select name="brand" required>
      <option selected>Select brand..</option>
      @foreach($brands as $brand)
        <option value="{{$brand->id}}">{{$brand->name}}</option>
      @endforeach
    </select>
  </div>
  </div>
  <div class="row">
    <div class="form-group col-sm-6">
    <label for="exampleFormControlInput1">Product price</label>
    <input type="text" name="price" value="{{old('price')}}"  class="form-control" required>
  </div>
  <div class="form-group col-sm-6">
    <label for="exampleFormControlInput1">Product Quantity</label>
    <input type="number" min="1" name="quantity" value="{{old('quantity')}}"  class="form-control" required>
  </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Product Image</label>
    <input type="file" name="image"  class="form-control" required />
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1"></label>
    <input type="submit" name="submit" class="btn btn-primary" value="Add Product">
  </div>

</form>


</div>
</div>
</div>
@endsection


