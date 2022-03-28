<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "muabannongsan";

	$dbconn = mysqli_connect($host,$username,$password,$database);
	if($dbconn){
		
	}else{
		echo "That bai";
	}
	mysqli_set_charset($dbconn,"utf8");
?>