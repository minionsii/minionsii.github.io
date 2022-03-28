<?php
if(isset($_REQUEST['act'])){
  if($_REQUEST['act']=='get_info'){
    $id = $_REQUEST['id'];
    $dbconnect = mysqli_connect('localhost','root','','webbanhang');
    mysqli_set_charset($dbconnect,'utf8');
    $sql = "SELECT * FROM hanghoa where MSHH = '$id'";
    $result1=mysqli_query($dbconnect,$sql);
    $row = mysqli_fetch_array($result1);
    echo json_encode(array("nhom" => $row['MANHOM'],"tenhh" => $row['TENHH'],"gia" => $row['GIA']
            ,"soluong" => $row['SOLUONGHANGHOA'],"mota" => $row['MOTAHH']
           ));
    exit();
  }
}
?>
<?php include("headerquanly.php"); ?>

<?php
if(isset($_REQUEST['act'])){
  $act = $_REQUEST['act'];
  switch ($act){
    case 'add':
        
        $name = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        $cmbLoaiHH=$_POST['cmbLoaiHH'];
        $ma=$_POST['ma'];
        $ten=$_POST['ten'];
        $soluong=$_POST['soluong'];
        $dongia=$_POST['dongia'];
        $mota=$_POST['mota'];
        
        if(!empty($ten) && !empty($ma) )
        {
            $sql_kt_add = "SELECT MANHOM FROM hanghoa WHERE MANHOM = '$ma' ";
            $rs_kt_add = mysqli_query($dbconn,$sql_kt_add);
            $count = mysqli_num_rows($rs_kt_add);
            if($count == 1){
                echo "<script> alert('Mã hàng hóa đã tồn tại') </script>";
            }else{
                 
                // Check extension
                if( in_array($imageFileType,$extensions_arr) ){
                    // Convert to base64 
                    $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
                    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                    // Insert record
      
                    $sql_add = "INSERT INTO hanghoa(MSHH,MANHOM,TENHH,GIA,SOLUONGHANGHOA,HINH,MOTAHH) 
                            values('$ma','$cmbLoaiHH','$ten','$dongia','$soluong','$image','$mota')";
                    $result_add=mysqli_query($dbconn,$sql_add);

                    if($result_add){
                      echo "<script> alert('Thêm mới thành công') </script>";
                    }else{
                      echo "<script> alert('Thêm mới không thành công') </script>";
                    }  
                    
                    // Upload file
                    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
                }
                
            }
        }else{
            echo "<script> alert('Vui lòng nhập đầy đủ thông tin') </script>";
        }
        echo "<script>location.href='danhsachhanghoa.php'</script>";
    break;
    case 'edit':
        $name= '';
        if(($_FILES['file']['name'])){
            $name = $_FILES['file']['name'];
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");
        }
        
        $cmbLoaiHH=$_POST['cmbLoaiHH'];
        $ma=$_POST['edit_ma'];
        $ten=$_POST['edit_ten'];
        $soluong=$_POST['edit_soluong'];
        $dongia=$_POST['edit_dongia'];
        $mota=$_POST['edit_mota'];
        
        if(!empty($ten) && !empty($ma)  )
        {
            if($name != ''){
                // Check extension
                if( in_array($imageFileType,$extensions_arr) ){
                    // Convert to base64 
                    $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
                    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                    // Insert record
                    $updateSQL = sprintf("UPDATE hanghoa 
                            SET MANHOM='{$cmbLoaiHH}',TENHH='{$ten}',GIA='{$dongia}',SOLUONGHANGHOA='{$soluong}'
                            ,HINH='{$image}',MOTAHH='{$mota}'
                             WHERE MSHH='{$ma}'");
                    // echo $updateSQL;
                    $result_update=mysqli_query($dbconn,$updateSQL);
                    if($result_update){
                      echo "<script> alert('Cập nhật thành công') </script>";
                    }else{
                      echo "<script> alert('Cập nhật thất bại') </script>";
                    }

                    // Upload file
                    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
                }
            }else{
                    $updateSQL = sprintf("UPDATE hanghoa 
                            SET MANHOM='{$cmbLoaiHH}',TENHH='{$ten}',GIA='{$dongia}',SOLUONGHANGHOA='{$soluong}'
                            ,MOTAHH='{$mota}'
                             WHERE MSHH='{$ma}'");
                    // echo $updateSQL;
                    $result_update=mysqli_query($dbconn,$updateSQL);
                    if($result_update){
                      echo "<script> alert('Cập nhật thành công') </script>";
                    }else{
                      echo "<script> alert('Cập nhật thất bại') </script>";
                    }
            }
            

        }else{
            echo "<script> alert('Vui lòng nhập đầy đủ thông tin') </script>";
        }
        echo "<script>location.href='danhsachhanghoa.php'</script>";
    break;
    
    case 'del':
        $id = $_REQUEST['id'];
        $sql_KT_sd_mt = "SELECT MSHH FROM chitiethanghoa WHERE MSHH ='$id' ";
        $rs_KT_sd_mt = mysqli_query($dbconn,$sql_KT_sd_mt);
        $count_mt = mysqli_num_rows($rs_KT_sd_mt);
    
        if($count_mt > 0 ){
            echo "<script> alert('Hàng hóa đang có khách hàng đặt không thể xóa') </script>";
        }else{
            $sql_del = "DELETE FROM hanghoa WHERE MSHH ='$id' ";

            $result_del=mysqli_query($dbconn,$sql_del);

            if($result_del){
                echo "<script> alert('Xóa thành công') </script>";
            }else{
                echo "<script> alert('Xóa thất bại') </script>";
            }
        }
        echo "<script>location.href='danhsachhanghoa.php'</script>";
    break;
    
    default:{}
    break;
  }
}
?>

<section class="content">
 <div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <ol class="breadcrumb">
        <!-- li><a href="#"><i class="fa fa-server"></i>&nbsp;Danh Mục</a></li> -->
        <a href="#"><li class="active">Danh sách hàng hóa</li></a>
      </ol>
       <!-- Example DataTables Card-->
    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
      <div class="card mb-3">
        <div class="card-header">
            
      <div class="card-body">
        
        <button type="button" class="btn btn-success" id="them">Thêm</button>
        <div class="table-responsive">
          <table class="display" id="" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Loại</th>
                <th>Hình ảnh</th>
                <th>Mã hàng hóa</th>
                <th>Tên hàng hóa</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tác Vụ</th>
              </tr>
            </thead>
            <?php
            $sql = "SELECT * FROM hanghoa";
            $results = mysqli_query($dbconn,$sql) ;
            ?>
            <tbody>
              <?php
              $stt = 1;
              while($row = mysqli_fetch_array($results)){ 
                  ?>
                <tr>
                  <td><?php echo $row['MANHOM']; ?></td>
                  <td>
                      <img src="<?php echo $row['HINH']; ?>" width="50px" height="50px" />
                  </td>
                  <td><?php echo $row['MSHH']; ?></td>
                  <td><?php echo $row['TENHH']; ?></td>
                  <td><?php echo $row['SOLUONGHANGHOA']; ?></td>
                  <td class="price"><?php echo $row['GIA']; ?></td>
                  <td>

                    <img id="<?=$row['MSHH']?>" class="btnSua" src="images/sua_truong.jpg" width = "20"
                    height= "20" title="Cập nhật">
                    
                    <a href="danhsachhanghoa.php?act=del&id=<?php echo $row['MSHH']; ?>" >
                      <img class="icon_xoa" src="images/xoa_truong.jpg" title="Xóa" >
                    </a>
      
                  </td>
                </tr>
                <?php $stt = $stt + 1; ?>
              <?php } ?>

              

            </tbody>
          </table>
        </div>
      </div>
        </div>
      </div>
    </form>
    </div>
      </section>
<script>
$(document).ready(function(){
  $("#them").click(function(){
    $("#modaldangky").modal("show");
  });
});
</script>
<script>
$(document).ready(function(){
  $(".btnSua").click(function(){
    console.log(this.id);
    var id = this.id;
    $.ajax({
      url: "danhsachhanghoa.php?act=get_info&id=" + this.id,
      dataType: 'json',
      success:function(result){
        console.log(result);
        $("#edit_ma").val(id);  
        $("#edit_ten").val(result.tenhh);
        $("#cmbLoaiHH").val(result.nhom);
        $("#edit_soluong").val(result.soluong);
        $("#edit_dongia").val(result.gia);
        $("#edit_mota").val(result.mota);
        
        $("#modaldangky2").modal("show");
      }
    });

  });

});
</script>
<?php
    //Lấy danh sách NhomHH
    $sql_getNhomHH= "SELECT * FROm nhomhanghoa";
    $rs_getNhomHH = mysqli_query($dbconn,$sql_getNhomHH);
    $rs_getNhomHH_2 = mysqli_query($dbconn,$sql_getNhomHH);
    
?>
<!-- Form -->
<div id="modaldangky" class="modal fade" role="dialog" tabindex="-1">


  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form action="danhsachhanghoa.php?act=add" method="POST" enctype='multipart/form-data'>
        <div class="modal-header">

          <h5 class="modal-title">From thêm hàng hóa</h5>
          <!--<button class="close" data-dismiss="modal">&times;</button>-->
        </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Loại hàng hóa</label><br>
                    <select name="cmbLoaiHH" style="width:310px">
                        <?php
                    while($row = mysqli_fetch_array($rs_getNhomHH_2)){
                        ?>
                        <option value="<?php echo $row['MANHOM']?>"><?php echo $row['MANHOM'] . " - " . $row['TENNHOM']?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type='file' name='file' required=""/>
                </div>
                <div class="form-group">
                    <label>Mã hàng hóa</label>
                    <input class="form-control" name="ma" type="text" placeholder="Vui lòng nhập mã" required="">
                </div>    

                <div class="form-group">
                    <label>Tên hàng hóa</label>
                    <input class="form-control" name="ten" type="text" placeholder ="Vui lòng nhập tên" required="">
                </div> 
                <div class="form-group">
                    <label>Số lượng</label>
                    <input class="form-control" name="soluong" type="number" maxlength="10" placeholder="Vui lòng nhập số lượng" required="">
                </div>

                <div class="form-group">
                    <label>Đơn giá</label>
                    <input class="form-control" name="dongia" type="text" maxlength="10" placeholder="Vui lòng nhập giá" required="">
                </div>
                
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" name="mota" cols="20" rows="6" placeholder="Mô tả hàng hóa"></textarea>
                </div>
              
            </div>

            <div class="modal-footer">
             <input type="submit" id="dangky" name="dangky" class="btn btn-primary " value="Thêm" s>
             <button id="dongform" class="btn btn-danger " data-dismiss="modal">Trở về</button>
             <input type="hidden" name="thucthi" value="add" /> 
           </div>
         </form>
       </div>

     </div>

   </div>
   <!-- end form -->
 <!-- Form 2 -->

<div id="modaldangky2" class="modal fade" role="dialog" tabindex="-1">
 <div class="modal-dialog">

   <div class="modal-content">

     <div class="modal-header">

       <h5 class="modal-title">From cập nhật hàng hóa </h5>
       <!--<button class="close" data-dismiss="modal">&times;</button>-->
     </div>
     <form  action="danhsachhanghoa.php?act=edit" method="POST" enctype='multipart/form-data'>
         <div class="modal-body">
                <div class="form-group">
                    <label>Loại hàng hóa</label><br>
                    <select id="cmbLoaiHH" name="cmbLoaiHH" style="width:310px">
                        <?php
                    while($row = mysqli_fetch_array($rs_getNhomHH)){
                        ?>
                        <option value="<?php echo $row['MANHOM']?>"><?php echo $row['MANHOM'] . " - " . $row['TENNHOM']?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type='file' name='file'/>
                </div>
                <div class="form-group">
                    <label>Mã hàng hóa</label>
                    <input class="form-control" name="edit_ma" id="edit_ma" type="text" placeholder="Vui lòng nhập mã" readonly="" required="">
                </div>    

                <div class="form-group">
                    <label>Tên hàng hóa</label>
                    <input class="form-control" name="edit_ten" id="edit_ten" type="text" placeholder ="Vui lòng nhập tên" required="">
                </div> 
             
                <div class="form-group">
                    <label>Số lượng</label>
                    <input class="form-control" name="edit_soluong" id="edit_soluong" type="number" maxlength="10" placeholder="Vui lòng nhập số lượng" required="">
                </div>

                <div class="form-group">
                    <label>Đơn giá</label>
                    <input class="form-control" name="edit_dongia" id="edit_dongia" type="text" maxlength="10" placeholder="Vui lòng nhập giá" required="">
                </div>
                
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" name="edit_mota" id="edit_mota" cols="20" rows="6" placeholder="Mô tả hàng hóa"></textarea>
                </div>
              
            </div>
           <div class="modal-footer">
             <input type="submit" id="dangky1" name="dangky" class="btn btn-primary " value="Cập nhật">
             <button id="dongform" class="btn btn-danger " data-dismiss="modal">Trở về</button>
         </div>
     </form>
   </div>
 </div>
</div>
    <!-- End Form 2 -->
 <?php include("footerquanly.php"); ?>