<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];

if($conn){
	$sql_user = "UPDATE users SET firstname = '$firstname',lastname = '$lastname' WHERE email = '$email'";
	if(mysqli_query($conn,$sql_user)){
		echo "Account Details Updated!";
	}else{
		echo "Failed to update your account details.";
	}
} else {
	echo "Connection Error";
}
?>