<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$entryId = $_POST["entryId"];

if($conn){
	$sql_del = "DELETE FROM `entries` WHERE entryid = '$entryId'";

	if(mysqli_query($conn,$sql_del)){
		echo "Entry Removed Successfully!";
	}else{
		echo "Failed to add entry";
	}
}else{
	echo "Connection Error";
}
?>