@extends('admin.dashboard')

@section('content')
<div class="container">
<div class="row" >
<div class="col-8">
<h2>Add Category Page</h2>
<br>
@include('errors')
@include('flash')
<br>
<form action= "{{url('/admin/storebrand')}}" method = "post" >
@csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">Brand Name</label>
    <input type="text" name="name" value="{{old('name')}}"  class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Brand Description</label>
    <textarea class="form-control" name="description" rows="3">{{old('description')}} </textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Category</label>
    <select name="category"  class="form-control">
      <option selected>select...</option>
      @foreach($categories as $category)
      <option value="{{$category->id}}">{{$category->name}}</option>
      @endforeach
    </select>
  </div>
    <div class="form-group">
    <label for="exampleFormControlInput1"></label>
    <input type="submit" name="submit" class="btn btn-primary" value="Add Brand">
  </div>

</form>
    <div class="row">

@foreach ($brands as $brand)
  <div id="{{$brand->id}}" class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{$brand->name}}</h5>
        <p class="card-text">{{$brand->description}}</p>
        <p class="card-text"><small>{{$brand->category->name}}</small></p>
        <button onclick="deletebrand('{{$brand->id}}' , url='{{url('admin/destroybrand')}}')" class="btn btn-danger">delete brand</button>
      </div>
    </div>
  </div>
@endforeach
</div>

</div>
</div>
</div>
@endsection