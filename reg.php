<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$email = $_POST["email"];
$password = $_POST["password"];

if($conn){
	$sql_check = "SELECT EXISTS(SELECT email FROM users WHERE email = '$email') as result";
	$result = mysqli_query($conn,$sql_check);
	$exist = $result->fetch_object()->result;
	if($exist == 0){
		$sql_register = "INSERT INTO users (firstname,lastname,email,password) VALUES ('$fname','$lname','$email','$password')";
		if(mysqli_query($conn,$sql_register)){
			echo "Registered Successfully!";
		}else{
			echo "Failed to register you account";
		}
	}else{
		echo "Email already in use.";
	}
}else{
	echo "Connection Error";
}
?>