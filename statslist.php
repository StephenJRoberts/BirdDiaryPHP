<?php
require('conn.php');

if($conn === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $_GET["email"];
$type = $_GET["type"];

if($conn){
	$sql_userid = "SELECT id FROM `users` WHERE email = '$email' LIMIT 1";
	$result = mysqli_query($conn,$sql_userid);
	$userid = $result->fetch_object()->id;
	
	if($type == "Life"){
		$sql_stats="SELECT DISTINCT english_name, COUNT(*) as totals, PictureURL from entries INNER JOIN birdlist on birdlist.bird_id = entries.birdid where entries.userid = '$userid' GROUP BY english_name ORDER BY `totals` DESC";
	} else if ($type == "Year") {
		$sql_stats="SELECT DISTINCT english_name, COUNT(*) as totals, PictureURL from entries INNER JOIN birdlist on birdlist.bird_id = entries.birdid where entries.userid = '$userid' and YEAR(entries.date)= YEAR(CURDATE()) GROUP BY english_name ORDER BY `totals` DESC";
	} else if ($type == "Mon") {
		$sql_stats="SELECT DISTINCT english_name, COUNT(*) as totals, PictureURL from entries INNER JOIN birdlist on birdlist.bird_id = entries.birdid where entries.userid = '$userid' and MONTH(entries.date)= MONTH(CURDATE()) GROUP BY english_name ORDER BY `totals` DESC";
	}
		
	if(mysqli_query($conn,$sql_stats)){
		$result = mysqli_query($conn,$sql_stats);
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