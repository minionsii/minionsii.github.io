<?php
$catIDSP = $_REQUEST['catIDSP'];
include('database_connection.php');
$query = "SELECT * FROM hinh_anh_sp WHERE SP_ID='$catIDSP' ORDER BY HA_ID DESC ";
$statement = $dbconnect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$number_of_rows = $statement->rowCount();
$output = '';
$output .= '
<div>
 <table class="display" id="#" >
  <tr>
  
  </tr>
';
if($number_of_rows > 0)
{
   // <td><img src="files/'.$row["image_name"].'" class="img-thumbnail" width="100" height="100" /></td>
 $count = 0;
 foreach($result as $row)
 {
  $count = $count + 1; 
  
  $output .= '
  <tr>
   <td><img src="../../quanlynhansu/danghinhanh/'.$row["HA_URL"].' " class="img-thumbnail" alt="Hình ảnh" width="100" height="100" /></td>
   <td>
      ';if($row['HA_MAT_DINH']==1){
          $output .='<input type="radio" id="'.$row["HA_ID"].'" class="chonanh" name="gender" value="'.$row["HA_ID"].'" checked> Chọn ảnh đại diện<br>';
        }else{
          $output .='<input type="radio" id="'.$row["HA_ID"].'" class="chonanh" name="gender" value="'.$row["HA_ID"].'"> Chọn ảnh đại diện<br>'
          ;}$output .='
     
      <button type="button" class="btn btn-danger btn-xs delete" id="'.$row["HA_ID"].'" data-image_name="'.$row["HA_URL"].'">Delete
      </button>
   </td>
  </tr>
  ';
 }
}
else
{
 $output .= '
  <tr>
   <td colspan="6" align="center">Không có hình nào được chọn</td>
  </tr>
 ';
}
$output .= '</table>
</div>';
echo $output;
?>