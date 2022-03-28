<?php
	$servername = "localhost";
	$database = "muabannongsan";
	$username = "root";
	$password = "";
	// Create connection
	$dbconn = mysqli_connect($servername, $username, $password, $database);
	// Check connection
	if (!$dbconn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else{
    mysqli_set_charset($dbconn,'utf8');
  }
?>