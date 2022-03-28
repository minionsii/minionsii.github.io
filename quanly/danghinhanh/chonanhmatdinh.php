<?php
//update.php

include('database_connection.php');

$catIDSP = $_REQUEST['catIDSP'];
echo $_POST["image_id"];
if(isset($_POST["image_id"]))
{     
  if(get_old_ha_daidien($dbconnect)){
    sleep(1);
     $query = "
       UPDATE hinh_anh_sp 
       SET HA_MAT_DINH = 0
       WHERE (SP_ID='".$catIDSP."')
      ";
     $statement = $dbconnect->prepare($query);
     $statement->execute();    
  }
     sleep(1);
     $query = "
       UPDATE hinh_anh_sp 
       SET HA_MAT_DINH = 1
       WHERE (HA_ID = '".$_POST["image_id"]."' AND SP_ID='".$catIDSP."')
      ";
     $statement = $dbconnect->prepare($query);
     $statement->execute();   
}


function get_old_ha_daidien($dbconnect)
{
  $catIDSP = $_REQUEST['catIDSP'];
 $query = "
 SELECT * FROM hinh_anh_sp WHERE (HA_MAT_DINH='1') AND (SP_ID='".$catIDSP."')";
 $statement = $dbconnect->prepare($query);
 $statement->execute();
 $number_of_rows = $statement->rowCount();
 if($number_of_rows > 0)
 {
  return true;
 }
 else
 {
  return false;
 }
}
?>
