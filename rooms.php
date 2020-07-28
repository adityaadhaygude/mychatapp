<?php
$roomname=$_GET['roomname'];
include 'dbcon.php';
$sql="SELECT * FROM rooms WHERE roomname='$roomname'";
$result=mysqli_query($conn, $sql);
if($result){
	//check if room exist
	if(mysqli_num_rows($result)==0)
	{
		$message="This room does not exist try creating new room";
	echo '<script>alert("'.$message.'");window.location="http://localhost/chatapp/index.php";</script>';
	}

}
?>


<!DOCTYPE html>
<html>
<head>
<title>MyChatApp</title>
<link rel="icon" href="img/chat.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/product/">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->

<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}
.anyclass{
	height: 350px;
	overflow-y: scroll;
}
.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>
</head>
<body>
	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">MyChatApp.com</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="index.php">Home</a>
  </nav>
</div>

<h2>Chat Messages - <?php  echo $roomname; ?></h2>

<div class="container">
	<div class="anyclass"> 
		<img src="img/avatar.png"alt="Avatar" > 
		<p>Hello. How are you today?</p> 
		<span class="time-right">11:00</span> 
	</div> 
</div> 
<input type="text"
class="form-control" name="usermsg" id="usermsg" placeholder="Add message">
<button class="btn btn-primary" name="submitmsg" id="submitmsg"
style="margin-top: 2px;">Send</button> 

<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script> 
<script type="text/javascript"> 
//check for new messages 
setInterval(runFunction,1000); 
function runFunction() {
$.post("htcon.php",{room:'<?php echo $roomname?>'},
	function(data,status){
		document.getElementsByClassName('anyclass')[0].innerHTML= data;
	})
}

//send on pressing enter Credits:w3schools
	var input = document.getElementById("usermsg");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("submitmsg").click();
    }
});
	
	$("#submitmsg").click(function(){
		var clientmsg = $("#usermsg").val();
  $.post("postmsg.php", {text:clientmsg,room:'<?php echo $roomname;?>',ip:'<?php echo $_SERVER['REMOTE_ADDR']?>'},
  function(data,status){
  	document.getElementsByClassName('anyclass')[0].innerHTML= data;});
  $("#usermsg").val("");
  return false;
  });
</script>
</body>
</html>
