<?php
require_once ("db.php");
$ID_SP = $_REQUEST['ID_SP'];

$sql = "SELECT * FROM binh_luan  
		inner join tai_khoan on tai_khoan.TK_ID = binh_luan.TK_ID
		WHERE binh_luan.SP_ID = '$ID_SP'
		ORDER BY binh_luan.PARENT_ID_BL asc, binh_luan.BL_ID asc";


$result = mysqli_query($dbconn, $sql);
$record_set = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($record_set, $row);
}
mysqli_free_result($result);

mysqli_close($dbconn);
echo json_encode($record_set);
?>