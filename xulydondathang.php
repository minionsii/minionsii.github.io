<?php
	$dbconn = mysqli_connect('localhost','root','','muabannongsan');
	if(!$dbconn){
	  echo "connect fail";
	}
	else{
	  mysqli_set_charset($dbconn,'utf8');
	}
	$DVT = $_REQUEST['dvt'];
	$SLCM = $_REQUEST['so_luong_can_mua'];
	$IDSP = $_REQUEST['id'];

	$sql = "SELECT san_pham.SP_SLDK * don_vi_tinh.DVT_TRISO AS KQ FROM san_pham 
	inner join don_vi_tinh ON don_vi_tinh.DVT_ID = san_pham.DVT_ID
	WHERE SP_ID = '$IDSP' ";
	$kqsql = mysqli_fetch_array(mysqli_query($dbconn,$sql))['KQ'];

	$sql2 = "SELECT $SLCM * don_vi_tinh.DVT_TRISO AS KQ2 FROM don_vi_tinh
	inner join don_dathang ON don_dathang.DVT_ID = don_vi_tinh.DVT_ID
	WHERE don_dathang.DVT_ID = '$DVT' ";
	$kqsql2 = mysqli_fetch_array(mysqli_query($dbconn,$sql2))['KQ2'];

	// var_dump($kqsql);
	// var_dump($kqsql2);
	if($kqsql2 > $kqsql){
		$result = array(0, "Vượt quá sản lượng lượng dự kiến của sản phẩm") ;
	}else{
		$result = array(1, "Số lượng hợp lệ") ;
	}
	echo json_encode($result);
?>