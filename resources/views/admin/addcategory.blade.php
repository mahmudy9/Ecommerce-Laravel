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
<form action= "{{url('/admin/createcategory2')}}" method = "post" >
@csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">Category Name</label>
    <input type="text" name="name" value="{{old('name')}}"  class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Category Description</label>
    <textarea class="form-control" name="description" rows="3">{{old('description')}} </textarea>
  </div>
    <div class="form-group">
    <label for="exampleFormControlInput1"></label>
    <input type="submit" name="submit" class="btn btn-primary" value="Add CAtegory">
  </div>

</form>
    <div class="row">

@foreach ($categories as $cat)
  <div id="{{$cat->id}}" class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{$cat->name}}</h5>
        <p class="card-text">{{$cat->description}}</p>
        <button onclick="deletecat('{{$cat->id}}' , url='{{url('admin/destroycategory')}}')" class="btn btn-danger">delete category</button>
      </div>
    </div>
  </div>
@endforeach
</div>

</div>
</div>
</div>
@endsection


