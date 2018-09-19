@extends('template')

@section('pageCSS') 
	<link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
@stop

@section('content')
<div class="jumbotron">
	<h1 class="display-4 jumbo-title">No Frills</h1>
	<p class="lead">SimpleChat lets you create a temporary anonymous chat room with a single click. Want to chat with friends? Just send them a link.</p>
	<form action="/create" method="POST" style="width: 100%">
		@csrf
		<div class="input-group mb-3">
		  <input type="text" name="roomName" class="form-control" placeholder="New Chatroom Name" aria-describedby="basic-addon2" required>
		  <div class="input-group-append">
			<button type="submit" class="btn btn-success">➜</button>
		  </div>
		</div>
	</form>
</div>
@stop