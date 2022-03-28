<?php
	require "connect.php";
	$ID_TK = "1";
	$query = "SELECT * FROM san_pham WHERE TK_ID = '$ID_TK' ";

	$data = mysqli_query($dbconn,$query);


	//1. tao class dia phuong
	class Sanpham{
		function Sanpham($idsp,$tensp,$noiban,$sldk){
			$this->IdSP = $idsp;
			$this->TenSP = $tensp;
			$this->NoiBan = $noiban;
			$this->SLDK = $sldk;
		}
	}
	//2. tao mang
	$mangSP = array();
	//3. them phan tu vao mang
	while ($row = mysqli_fetch_assoc($data) ){
		array_push($mangSP, new Sanpham($row['SP_ID'],
											$row['SP_TEN'],
											$row['DP_ID'],
											$row['SP_SLDK']));
	}
	//4. chuyen dinh dang mang -> JSON
	echo json_encode($mangSP);
?>