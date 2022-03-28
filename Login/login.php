<?php 
	require "connect.php";
	$ID_TK = $_POST['ID_TK'];
	$MAT_KHAU = md5($_POST['MAT_KHAU']);

	class Sinhvien{
		function Sinhvien($user,$password,$hinhanh){
			$this->Taikhoan = $user;
			$this->Matkhau = $password;
			$this->Hinhanh = $hinhanh;
		}
	}

	if (strlen($ID_TK) > 0 && strlen($MAT_KHAU) >0 ) {
		$mangsinhvien = array();
		$query = "SELECT * FROM tai_khoan WHERE FIND_IN_SET('$ID_TK',TK_ID) and FIND_IN_SET('$MAT_KHAU',TK_MATKHAU) ";
		$data = mysqli_query($dbconn,$query);
		if($data){
			while ($row = mysqli_fetch_assoc($data) ){
				array_push($mangsinhvien, new Sinhvien($row['TK_ID']
														,$row['TK_MATKHAU']
														,$row['TK_HA'])); 
			}
			if(count($mangsinhvien) > 0){
				echo json_encode($mangsinhvien);
			}else{
				echo "Fail";
			}
		}
	}else{
		echo "Null";
	}
?>