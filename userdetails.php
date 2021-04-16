<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $_GET["email"];

if($conn){
	$sql_user = "SELECT firstname , lastname FROM `users` WHERE email = '$email' LIMIT 1 ";
	if(mysqli_query($conn,$sql_user)){
		$result = mysqli_query($conn,$sql_user);
		$resultArray = array();
		$tempArray = array();
		while($row = $result->fetch_object()){
			$tempArray = $row;
			array_push($resultArray, $tempArray);
			}
			echo json_encode($resultArray);
			} 
	else {
		echo "Failed to get requested user";
			} 
	} else {
		echo "Connection Error";
		}
?>