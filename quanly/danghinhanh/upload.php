<?php
//upload.php
$catIDSP = $_REQUEST['catIDSP'];

include('database_connection.php');
if(count($_FILES["file"]["name"]) > 0)
{
 //$output = '';
 sleep(1);
 for($count=0; $count<count($_FILES["file"]["name"]); $count++)
 {
  $file_name = $_FILES["file"]["name"][$count];
  $tmp_name = $_FILES["file"]['tmp_name'][$count];
  $file_array = explode(".", $file_name);
  $file_extension = end($file_array);
  if(file_already_uploaded($file_name, $dbconnect))
  {
   $file_name = $file_array[0] . '-'. rand() . '.' . $file_extension;
  }
  $location = '../../quanlynhansu/danghinhanh/'. $file_name;
  if(move_uploaded_file($tmp_name, $location))
  {
    if(get_old_ha_daidien($dbconnect)){

      $query = "
         INSERT INTO hinh_anh_sp (SP_ID,HA_URL,HA_MAT_DINH) 
         VALUES ('".$catIDSP."','".$file_name."','0') 
         ";
         $statement = $dbconnect->prepare($query);
         $statement->execute();
    }else{
       $query = "
         INSERT INTO hinh_anh_sp (SP_ID,HA_URL,HA_MAT_DINH) 
         VALUES ('".$catIDSP."','".$file_name."','1') 
         ";
         $statement = $dbconnect->prepare($query);
         $statement->execute();
    }
 }
 }
}

function file_already_uploaded($file_name, $dbconnect)
{
 $catIDSP = $_REQUEST['catIDSP'];
 $query = "SELECT * FROM hinh_anh_sp WHERE  (HA_URL='".$file_name."') AND (SP_ID='".$catIDSP."')";

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
