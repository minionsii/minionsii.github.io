<?php
require "connect.php";
$id_sp_dang = $_Request['id_sp_dang'];
class Sanpham{
	function Sanpham($idsp){
		$this->IDSP = $idsp;
	}
}

		// if (strlen($id_sp_dang) > 0 ) {
$mangsanpham = array();
$queryidsp = "SELECT * FROM san_pham WHERE FIND_IN_SET('$id_sp_dang',ID_SP)";
$dataidsp = mysqli_query($dbconn,$queryidsp);
if($dataidsp){
	while ($row = mysqli_fetch_assoc($dataidsp) ){
		array_push($mangsanpham, new Sanpham($row['ID_SP'])); 
	}
	if(count($mangsanpham) > 0){
		echo json_encode($mangsanpham);
	}else{
		echo "Fail";
	}
}
		// }else{
		// 	echo "Null";
		// }
?>
