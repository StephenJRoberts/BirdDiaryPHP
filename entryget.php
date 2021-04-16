<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$entryId = $_GET["entryId"];

if($conn){
	$sql_entries = "SELECT entries.date , entries.created_at , birdlist.english_name , birdlist.family_english , birdlist.scientific_name , entries.gender , entries.adinfo, birdlist.PictureURL, entries.latitude, entries.longitude FROM entries, birdlist where entries.birdid = birdlist.bird_id  AND entries.entryid = '$entryId' LIMIT 1";
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