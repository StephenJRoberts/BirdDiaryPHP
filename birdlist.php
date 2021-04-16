<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

if($conn){
$sql_login = "SELECT * FROM `birdlist`";
if(mysqli_query($conn,$sql_login)){
$result = mysqli_query($conn,$sql_login);
$resultArray = array();
$tempArray = array();
 
 while($row = $result->fetch_object()){
 $tempArray = $row;
     array_push($resultArray, $tempArray);
 }
	echo json_encode($resultArray);
} else {
		echo "Failed to check login details";
} 
} else {
echo "Connection Error";
}
?>