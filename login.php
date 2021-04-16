<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $_POST["email"];
$password = $_POST["password"];

if($conn){
$sql_login = "SELECT password FROM `users` WHERE email='$email'";
if(mysqli_query($conn,$sql_login)){
$result = mysqli_query($conn,$sql_login);
	while($row = mysqli_fetch_array($result)) {
		$pass = $row['password']; 
	}
	if($pass == $password){
	echo "Login";
	} else {
		echo $pass;
	//echo "Login Details Incorrect";
	}	
}else{
echo "Failed to check login details";
}
}
else{
echo "Connection Error";
}
?>