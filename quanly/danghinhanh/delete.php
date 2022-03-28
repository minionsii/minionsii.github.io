<?php
//delete.php

include('database_connection.php');

$catIDSP = $_REQUEST['catIDSP'];
// echo $_POST["image_id"];
if(isset($_POST["image_id"]))
{	
	$dbconn = mysqli_connect('localhost','root','','muabannongsan');
	if(!$dbconn){
		echo "connect fail";
	}
	else{
		mysqli_set_charset($dbconn,'utf8');
	}

	$queryktdk = "SELECT * FROM hinh_anh_sp 
	WHERE (HA_ID = '".$_POST["image_id"]."' AND HA_MAT_DINH = '1' AND SP_ID='".$catIDSP."') ";

	if(mysqli_num_rows(mysqli_query($dbconn,$queryktdk)) > 0)
	{
		echo "ERROR";
	}else
	{

		$file_path = '../../quanlynhansu/danghinhanh/'. $_POST["image_name"];
		if(unlink($file_path))
		{
			$query = "DELETE FROM hinh_anh_sp WHERE (HA_ID = '".$_POST["image_id"]."' AND SP_ID='".$catIDSP."')
			";
			$statement = $dbconnect->prepare($query);
			$statement->execute();
		}

	}
}

?>
