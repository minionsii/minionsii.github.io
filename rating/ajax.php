<?php
require_once 'config.php';

    if($_POST['act'] == 'rate'){
    	// $ip = $_SERVER["REMOTE_ADDR"];
    	$therate   = $_POST['rate'];
    	$thepostsp = $_POST['id_sp'];
        $theposttk = $_POST['id_tk_dg'];
        echo $theposttk;
        echo $thepostsp;

    	$query = mysqli_query($db,"SELECT * FROM danh_gia_sp where DGSP_NGAY= GETDATE() "); 
    	while($data = mysqli_fetch_assoc($query)){
    		$rate_db[] = $data;
    	}
        if(mysqli_fetch_array(mysqli_query($db,"SELECT * FROM danh_gia_sp where TK_ID = '$theposttk' AND SP_ID = '$thepostsp' "))){
            mysqli_query($db,"UPDATE danh_gia_sp SET DGSP_DIEM = '$therate' WHERE TK_ID = '$theposttk' AND SP_ID = '$thepostsp'");
        }else{
            if(@count($rate_db) == 0 ){
            mysqli_query($db,"INSERT INTO danh_gia_sp(TK_ID, SP_ID,DGSP_DIEM,DGSP_NGAY) VALUES('$theposttk','$thepostsp', '$therate',NOW() )");

            }else{
                mysqli_query($db,"UPDATE danh_gia_sp SET DGSP_DIEM = '$therate' WHERE TK_ID = '$theposttk' AND SP_ID = '$thepostsp'");
            }
        }
    	
    } 
    location('index.php');
            exit();
?>