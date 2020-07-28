<?php
$conn =mysqli_connect("localhost","root","","chatroom");
//check connection
if(!$conn){
	die("Failed to connect".mysqli_connect_error());
}
?>