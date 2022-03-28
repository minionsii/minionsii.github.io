<?php 
	require "connect.php";
	$ID_TK = $_POST['ID_TK'];
	$ID_LOAI_TK = "2";
	$MAT_KHAU = md5($_POST['MAT_KHAU']);
	$HINH_ANH_TK = $_POST['HINH_ANH_TK'];
	$HO_TEN = $_POST['HO_TEN'];

	$gioi_tinh = $_POST['GIOI_TINH'];
	if($gioi_tinh == "Nam"){
		$gioi_tinh = "1";
	}else if($gioi_tinh == "Nữ"){
		$gioi_tinh = "0";
	}
	$CMND = $_POST['CMND'];
	$DIA_CHI = $_POST['DIA_CHI'];
	if($DIA_CHI == "Cần Thơ"){
		$DIA_CHI = "1";
	}else if($DIA_CHI == "Long An"){
		$DIA_CHI = "2";
	}else if($DIA_CHI == "Tiền Giang"){
		$DIA_CHI = "3";
	}else if($DIA_CHI == "Bến Tre"){
		$DIA_CHI = "4";
	}else if($DIA_CHI == "Vĩnh Long"){
		$DIA_CHI = "5";
	}else if($DIA_CHI == "Trà Vinh"){
		$DIA_CHI = "6";
	}else if($DIA_CHI == "Hậu Giang"){
		$DIA_CHI = "7";
	}else if($DIA_CHI == "Sóc Trăng"){
		$DIA_CHI = "8";
	}else if($DIA_CHI == "Đồng Tháp"){
		$DIA_CHI = "9";
	}else if($DIA_CHI == "An Giang"){
		$DIA_CHI = "10";
	}else if($DIA_CHI == "Kiên Giang"){
		$DIA_CHI = "11";
	}else if($DIA_CHI == "Bạc Liêu"){
		$DIA_CHI = "12";
	}else if($DIA_CHI == "Cà Mau"){
		$DIA_CHI = "13";
	}
	$SO_DIEN_THOAI = $_POST['SO_DIEN_THOAI'];
	$EMAIL = $_POST['EMAIL'];

	$KHOA = "1";


	if (strlen($ID_TK) > 0 && strlen($MAT_KHAU) > 0  ) {
		$query = "INSERT INTO tai_khoan VALUES ('$ID_TK','$DIA_CHI','$ID_LOAI_TK','$MAT_KHAU','$HO_TEN','$gioi_tinh','$CMND','$SO_DIEN_THOAI','$EMAIL',NOW(),'$KHOA','$HINH_ANH_TK')";
		$data = mysqli_query($dbconn,$query);
		if($data){
			echo "SUCCESS";
		}else{
			echo "FAILED";
		}
	}else{
		echo "Null";
	}
?>