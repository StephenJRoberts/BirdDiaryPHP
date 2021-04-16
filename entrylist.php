<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $_GET["email"];
$date = $_GET["date"];

if($conn){
	$sql_userid = "SELECT id FROM `users` WHERE email = '$email' LIMIT 1";
	$result = mysqli_query($conn,$sql_userid);
	$userid = $result->fetch_object()->id;
	
	$sql_entries = "SELECT entries.entryid , entries.userid , entries.birdid , entries.date , entries.created_at , birdlist.english_name , birdlist.family_english, birdlist.PictureURL FROM entries, birdlist where entries.birdid = birdlist.bird_id  AND userid = '$userid' AND date = '$date' ORDER BY entries.entryid DESC";
	if(mysqli_query($conn,$sql_entries)){
		$result = mysqli_query($conn,$sql_entries);
		$resultArray = array();
		$tempArray = array();
		while($row = $result->fetch_object()){
			$tempArray = $row;
			array_push($resultArray, $tempArray);
			}
			echo json_encode($resultArray);
			} 
	else {
		echo "Failed to check login details";
			} 
	} else {
		echo "Connection Error";
		}
?>