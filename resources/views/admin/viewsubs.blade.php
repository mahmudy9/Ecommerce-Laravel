@extends('admin.dashboard')

@section('content')
<div class="container">
<div class="row">
<div class="col-9">
<h2>Subscribers List</h2>
<table class="table">
<tr>
<td>id</td>
<td>email</td>
<td>name</td>
<td>created at</td>
<td>Delete</td>

</tr>

@foreach($subs as $sub)
<tr id="{{$sub->id}}">
<td>{{$sub->id}}</td>
<td>{{$sub->email}}</td>
<td>{{$sub->name}}</td>
<td>{{$sub->created_at}}</td>
<td><button class="btn btn-danger" onclick="delete_sub('{{$sub->id}}' , '{{url('/admin/deletesubscriber')}}')" >Delete Subscriber</button></td>
</tr>


@endforeach

</table>


</div>

</div>


</div>


@endsection