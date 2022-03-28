<?php 
	require "connect.php";
	
	$query = "SELECT * FROM don_vi_tinh";

	$data = mysqli_query($dbconn,$query);


	//1. tao class dia phuong
	class Donvitinh{
		function Donvitinh($iddvt,$tendonvitinh){
			$this->IDdvt = $iddvt;
			$this->TenDonViTinh = $tendonvitinh;
		}
	}
	//2. tao mang
	$mangDVT = array();
	//3. them phan tu vao mang
	while ($row = mysqli_fetch_assoc($data) ){
		array_push($mangDVT, new Donvitinh($row['DVT_ID'],
											$row['DVT_TEN']));
	}
	//4. chuyen dinh dang mang -> JSON
	echo json_encode($mangDVT);
?>