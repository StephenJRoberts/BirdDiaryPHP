<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$id = $_POST["entryID"];
$birdID = $_POST["birdID"];
$date = $_POST["date"];
$gender = $_POST["gender"];
$location = $_POST["location"];
$adinfo = $_POST["additionalinfo"];

if($conn){
	if($location == "true"){
		if($birdID == "false"){
			$sql_entry = "UPDATE entries SET date = '$date',gender = '$gender',adinfo = '$adinfo',latitude = '0',longitude = '0' WHERE entryid = '$id';";
		} else {
			$sql_entry = "UPDATE entries SET date = '$date',gender = '$gender',adinfo = '$adinfo',latitude = '0',longitude = '0',birdid = '$birdID' WHERE entryid = '$id';";
		}
	} else {
		if($birdID == "false"){
			$sql_entry = "UPDATE entries SET date = '$date',gender = '$gender',adinfo = '$adinfo' WHERE entryid = '$id';";
		} else {
			$sql_entry = "UPDATE entries SET date = '$date',gender = '$gender',adinfo = '$adinfo',birdid = '$birdID' WHERE entryid = '$id';";
		}
	}
	if(mysqli_query($conn,$sql_entry)){
		echo "Entry Updated Successfully!";
	}else{
		echo "Failed to update entry";
	}
}else{
	echo "Connection Error";
}
?>