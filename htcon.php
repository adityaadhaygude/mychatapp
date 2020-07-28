<?php
$room=$_POST['room'];
include 'dbcon.php';

$sql= "SELECT * FROM msgs WHERE roomname = '$room'";
$res="";
$result = $conn->query($sql);
if($result->num_rows>0){
	while ($row = $result->fetch_assoc())
	{
		$res=$res.'<div class="container">';
		$res=$res.'<img src="img/avatar.png"alt="Avatar" > ';
		$res=$res."<p>".$row['msg'];
		$res=$res.'</p><span class="time-right">'.$row["stime"].'</span></div>';
	}
}
echo $res;
?>

