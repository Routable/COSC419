@extends('template')

@section('pageCSS') 
	<link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
@stop

@section('content')
<div class="jumbotron">
	<h1 class="display-4 jumbo-title">{{ $name }}</h1>
	<div class="messages" id="messageLog"></div>
	<div class="input-group mb-3">
		<input type="text" id="message" class="form-control" placeholder="Say Something!" aria-describedby="basic-addon2" required>
		<div class="input-group-append">
			<button id="sendMessage" class="btn btn-success">➜</button>
		</div>
	</div>
</div>
<script>
  var user = "{{ $user }}";
  var color = "{{ $color }}";
  var hash = "{{ $hash }}";
  var maxId = 0;
  var messageBox = document.getElementById("messageLog");
  
  function sendMessage(){
	var message = document.getElementById("message").value;
	var ajax = new XMLHttpRequest();
	ajax.open("POST", "/api/send", true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("message=" + message + "&user=" + user + "&color=" + color + "&hash=" + hash);
	document.getElementById("message").value = "";
  }
  
  function getMessages(){
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "/api/msgs/"+hash+"/"+maxId, true);
	ajax.onload = function(e) {
		if(ajax.readyState === 4 && ajax.status === 200){
			var json = this.responseText;
			var array = JSON.parse(json);
			for(var key in array){
				messageBox.innerHTML += array[key]
				if(parseInt(key) > maxId){
					maxId = parseInt(key);
				}
				messageBox.scrollTop = messageBox.scrollHeight;
			}
		}
	};
	ajax.send();
  }
  
  getMessages();
  setInterval(getMessages, 5000)
  document.getElementById("sendMessage").addEventListener("click", sendMessage);
  document.getElementById("message").addEventListener("keyup", function(event) {
	if(event.keyCode === 13)
		document.getElementById("sendMessage").click();
  });
</script>
@stop