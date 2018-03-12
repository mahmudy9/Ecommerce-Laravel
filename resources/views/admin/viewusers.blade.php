@extends('admin.dashboard')

@section('content')
<div class="container">
<div class="row">
<div class="col-9">
<h2>Users List</h2>
<table class="table">
<tr>
<td>ID</td>
<td>Name</td>
<td>Email</td>
<td>City</td>
<td>Address</td>
<td>Phone</td>
<td>Created at</td>

</tr>

@foreach($users as $sub)
<tr id="{{$sub->id}}">
<td>{{$sub->id}}</td>
<td>{{$sub->name}}</td>
<td>{{$sub->email}}</td>
<td>{{$sub->city}}</td>
<td>{{$sub->address}}</td>
<td>{{$sub->phone}}</td>

<td>{{$sub->created_at}}</td>
</tr>


@endforeach

</table>
{{$users->links('paginator')}}
</div>

</div>


</div>


@endsection