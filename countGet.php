<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $_GET["email"];

if($conn){
	$sql_userid = "SELECT id FROM `users` WHERE email = '$email' LIMIT 1";
	$result = mysqli_query($conn,$sql_userid);
	$userid = $result->fetch_object()->id;
	
	$sql_count1 = "SELECT count(DISTINCT birdid) AS TotalCount, count(*) AS TotalEntries FROM `entries` INNER JOIN birdlist on birdlist.bird_id = entries.birdid WHERE userid = '$userid' LIMIT 1";
	$sql_count2 = "SELECT count(DISTINCT birdid) AS YearCount, count(*) AS YearEntries FROM `entries` INNER JOIN birdlist on birdlist.bird_id = entries.birdid WHERE userid = '$userid' AND YEAR(entries.date)= YEAR(CURDATE()) LIMIT 1";
	$sql_count3 = "SELECT count(DISTINCT birdid) AS MonCount, count(*) AS MonEntries FROM `entries` INNER JOIN birdlist on birdlist.bird_id = entries.birdid WHERE userid = '$userid' AND MONTH(entries.date)= MONTH(CURDATE()) LIMIT 1";
	if(mysqli_query($conn,$sql_count1)){
		$result = mysqli_query($conn,$sql_count1)->fetch_object();
		$result2 = mysqli_query($conn,$sql_count2)->fetch_object();
		$result3 = mysqli_query($conn,$sql_count3)->fetch_object();
		$obj = (object) array_merge((array) $result, (array) $result2, (array) $result3);
		$array = array();
		array_push($array, $obj);
		echo json_encode($array);
	}
	else {
		echo "Failed to get entry statistics";
			} 
	} else {
		echo "Connection Error";
		}
?>