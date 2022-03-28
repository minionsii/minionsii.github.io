<?php 
	require "connect.php";
	
	$query = "SELECT * FROM loai_sp";

	$data = mysqli_query($dbconn,$query);


	//1. tao class dia phuong
	class LoaiSP{
		function LoaiSP($idloaisp,$tenloaisanpham){
			$this->IDloaisp = $idloaisp;
			$this->TenLoaiSanPham = $tenloaisanpham;
		}
	}
	//2. tao mang
	$mangLSP = array();
	//3. them phan tu vao mang
	while ($row = mysqli_fetch_assoc($data) ){
		array_push($mangLSP, new LoaiSP($row['LSP_ID'],
											$row['LSP_TEN']));
	}
	//4. chuyen dinh dang mang -> JSON
	echo json_encode($mangLSP);
?>