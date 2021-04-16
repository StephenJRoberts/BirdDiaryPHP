<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$passwordOld = $_POST["passwordOld"];
$passwordNew = $_POST["passwordNew"];
$email = $_POST["email"];

if($conn){
	$sql_password = "SELECT password FROM `users` WHERE email = '$email' LIMIT 1";
	$result = mysqli_query($conn,$sql_password);
	$passwordCur = $result->fetch_object()->password;
	
	if($passwordCur == $passwordOld){
	$sql_password = "UPDATE users SET password = '$passwordNew' WHERE email = '$email'";
	if(mysqli_query($conn,$sql_password)){
		echo "Account Password Updated!";
	}else{
		echo "Failed to update your account details.";
	}
	} else {
		echo "Old Password Incorrect.";
	}
} else {
	echo "Connection Error";
}
?>