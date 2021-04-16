<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $_POST["email"];
$birdID = (int) $_POST["birdID"];
$date = $_POST["date"];
$gender = $_POST["gender"];
$lon =  floatval($_POST["lon"]);
$lat = floatval($_POST["lat"]);
$adinfo = $_POST["additionalinfo"];

if($conn){
	$sql_userid = "SELECT id FROM `users` WHERE email = '$email' LIMIT 1";
	$result = mysqli_query($conn,$sql_userid);
	$userid = $result->fetch_object()->id;

	$sql_entry = "INSERT INTO entries (userid,birdid,date,gender,adinfo,latitude,longitude) VALUES ($userid,$birdID,'$date','$gender','$adinfo','$lat',$lon)";
	if(mysqli_query($conn,$sql_entry)){
		echo "Entry Successfully!";
	}else{
		echo "Failed to add entry";
	}
}else{
	echo "Connection Error";
}
?>