<?php 
	require "connect.php";
	$id = $_GET['id'];
	$hinhanh = $_GET['hinhanh'];
	if(strlen($id) > 0 && strlen($hinhanh) > 0){
		$query = "DELETE FROM sinhvien WhERE id = '$id' ";
		$data = mysqli_query($dbconn,$query);
		if($data){
			unlink("image".$hinhanh);
			echo "ok";
		}else{
			echo "fail";
		}
	}

?>