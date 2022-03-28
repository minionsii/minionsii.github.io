
<?php
require_once ("db.php");
$commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : "";
$comment = isset($_POST['comment']) ? $_POST['comment'] : "";
$ID_SP = isset($_POST['name']) ? $_POST['name'] : "";
$commentIdtk =isset($_POST['commentIdtk']) ? $_POST['commentIdtk'] : "";
$date = date('Y-m-d H:i:s');

// echo $commentId;
// echo "noi_dung";
// echo $comment;
// echo "ID_sp";
// echo $ID_SP;

// echo "ID_TK";
// echo $commentIdtk;

$sql = "INSERT INTO binh_luan(TK_ID,SP_ID,PARENT_ID_BL,BL_NOIDUNG,BL_NGAYTAO) VALUES ('" . $commentIdtk . "','" . $ID_SP . "','" . $commentId . "','" . $comment . "','" . $date . "')";


$result = mysqli_query($dbconn, $sql);

if (! $result) {
    $result = mysqli_error($dbconn);
}
echo $result;
?>

