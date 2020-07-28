<?php
$room=$_POST['room'];
if (strlen($room)>20) {
	$message="Please choose a name less than 20 characters";
	echo '<script>alert("'.$message.'");window.location="http://localhost/chatapp/index.php";</script>';
}
else if(!ctype_alnum($room))
{
	$message="Please choose a alphanumeric room name";
	echo '<script>alert("'.$message.'");window.location="http://localhost/chatapp/index.php";</script>';

}
else{
	include 'dbcon.php';
	echo "Lets chat now";

//check room already exist
$sql = "SELECT * FROM rooms WHERE roomname='$room'";
$result=mysqli_query($conn,$sql);
if($result){
	if (mysqli_num_rows($result)>0) {
		$message="User already exist take choose another name";
	echo '<script>alert("'.$message.'");window.location="http://localhost/chatapp/index.php";</script>';
	}
	else{
		$sql1="INSERT INTO `rooms`(`sn`, `roomname`, `stime`) VALUES ('','$room',CURRENT_TIMESTAMP)";
		if (mysqli_query($conn,$sql1)) {
			$message="Room is ready to chat";
	echo '<script>alert("'.$message.'");window.location="http://localhost/chatapp/rooms.php?roomname='.$room.'"</script>';
		}
	}
 }
}
?>