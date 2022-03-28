<?php 
	require "connect.php";
	
	$query = "SELECT * FROM dia_phuong";

	$data = mysqli_query($dbconn,$query);


	//1. tao class dia phuong
	class Diaphuong{
		function Diaphuong($id,$tendiaphuong){
			$this->ID = $id;
			$this->TenDiaPhuong = $tendiaphuong;
		}
	}
	//2. tao mang
	$mangDP = array();
	//3. them phan tu vao mang
	while ($row = mysqli_fetch_assoc($data) ){
		array_push($mangDP, new Diaphuong($row['DP_ID'],
											$row['DP_TEN']));
	}
	//4. chuyen dinh dang mang -> JSON
	echo json_encode($mangDP);
?>