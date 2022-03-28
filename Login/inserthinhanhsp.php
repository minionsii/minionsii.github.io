<?php 
	require "connect.php";
	$ID_SP = $_POST['ID_SP'];
	// $ID_SP = "67";
	$URL = $_POST['URL'];
	$HA_MAT_DINH = "1";

	if (strlen($URL) > 0 ) {
		$query = "INSERT INTO hinh_anh_sp VALUES (null,'$ID_SP','$URL','$HA_MAT_DINH')";
		$data = mysqli_query($dbconn,$query);
		if($data){
			echo "SUCCESSSP";
		}else{
			echo "FAILED";
		}
	}else{
		echo "Null";
	}
?>