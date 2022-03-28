<?php 
require "connect.php";
$ID_TINHTRANG = "3";

$ID_TK = $_POST['MA_TK'];


$ID_LOAI_SP = $_POST['TEN_LOAI_SP'];
if($ID_LOAI_SP == "Bưởi"){
	$ID_LOAI_SP = "1";
}else if($ID_LOAI_SP == "Cam"){
	$ID_LOAI_SP = "2";
}else if($ID_LOAI_SP == "Quýt"){
	$ID_LOAI_SP = "3";
}else if($ID_LOAI_SP == "Thanh Long"){
	$ID_LOAI_SP = "4";
}else if($ID_LOAI_SP == "Dưa Hấu"){
	$ID_LOAI_SP = "5";
}else if($ID_LOAI_SP == "Bơ"){
	$ID_LOAI_SP = "6";
}else if($ID_LOAI_SP == "Dừa"){
	$ID_LOAI_SP = "7";
}else if($ID_LOAI_SP == "Sầu Riêng"){
	$ID_LOAI_SP = "8";
}else if($ID_LOAI_SP == "Táo"){
	$ID_LOAI_SP = "9";
}else if($ID_LOAI_SP == "Dưa gang"){
	$ID_LOAI_SP = "10";
}else if($ID_LOAI_SP == "Nho"){
	$ID_LOAI_SP = "11";
}else if($ID_LOAI_SP == "Khoai"){
	$ID_LOAI_SP = "12";
}


$ID_DVT = $_POST['DON_VI_TINH'];
if($ID_DVT == "KG"){
	$ID_DVT = "1";
}else if($ID_DVT == "Tấn"){
	$ID_DVT = "2";
}else if($ID_DVT == "Chục 10"){
	$ID_DVT = "3";
}else if($ID_DVT == "Chục 12"){
	$ID_DVT = "4";
}else if($ID_DVT == "Trái"){
	$ID_DVT = "5";
}
$TEN_SP = $_POST['TEN_SP'];
$MO_TA= $_POST['MO_TA'];
$NGAY_HET_HAN = $_POST['NGAY_HET_HAN'];
$SAN_LUONG_DU_KIEN = $_POST['SAN_LUONG_DU_KIEN'];
$HOA_HONG = $_POST['HOA_HONG'];


$NOI_BAN = $_POST['NOI_BAN'];
	if($NOI_BAN == "Cần Thơ"){
		$NOI_BAN = "1";
	}else if($NOI_BAN == "Long An"){
		$NOI_BAN = "2";
	}else if($NOI_BAN == "Tiền Giang"){
		$NOI_BAN = "3";
	}else if($NOI_BAN == "Bến Tre"){
		$NOI_BAN = "4";
	}else if($NOI_BAN == "Vĩnh Long"){
		$NOI_BAN = "5";
	}else if($NOI_BAN == "Trà Vinh"){
		$NOI_BAN = "6";
	}else if($NOI_BAN == "Hậu Giang"){
		$NOI_BAN = "7";
	}else if($NOI_BAN == "Sóc Trăng"){
		$NOI_BAN = "8";
	}else if($NOI_BAN == "Đồng Tháp"){
		$NOI_BAN = "9";
	}else if($NOI_BAN == "An Giang"){
		$NOI_BAN = "10";
	}else if($NOI_BAN == "Kiên Giang"){
		$NOI_BAN = "11";
	}else if($NOI_BAN == "Bạc Liêu"){
		$NOI_BAN = "12";
	}else if($NOI_BAN == "Cà Mau"){
		$NOI_BAN = "13";
	}


if (strlen($SAN_LUONG_DU_KIEN) > 0 && strlen($TEN_SP) > 0 && strlen($MO_TA) > 0 ) {
	$query = "INSERT INTO san_pham VALUES (null,'$NOI_BAN','$ID_TK','$ID_TINHTRANG','$ID_LOAI_SP','$ID_DVT','$TEN_SP','$MO_TA',NOW(),'$NGAY_HET_HAN','$SAN_LUONG_DU_KIEN','$HOA_HONG')";

	$data = mysqli_query($dbconn,$query);
	if($data){
		$id_sp_dang = mysqli_insert_id($dbconn);
		echo $id_sp_dang;
		// $url = "test.php?id_sp_dang=$id_sp_dang";
		// location($url);
		// exit;
		//echo $id_sp_dang;
	}else{
		echo "FAILED";
	}
}else{
	echo "Null";
}
?>