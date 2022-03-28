<?php
if(isset($_REQUEST['act'])){
  if($_REQUEST['act']=='get_info'){
    $id = $_REQUEST['id'];
    $dbconnect = mysqli_connect('localhost','root','','webbanhang');
    mysqli_set_charset($dbconnect,'utf8');
    $sql = "SELECT * FROM khachhang where MSKH = '$id'";
    $result1=mysqli_query($dbconnect,$sql);
    $row = mysqli_fetch_array($result1);
    echo json_encode(array("matkhau" => $row['F_MATKHAU'], "hoten" => $row['HOTENKH'], "diachi" => $row['DIACHI'], "sodienthoai" => $row['SODIENTHOAI']));
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
            $ma=$_POST['ma'];
            $ten=$_POST['ten'];
            $matkhau=md5($_POST['matkhau']);
            
            $diachi=$_POST['diachi'];
            $sodienthoai=$_POST['txtSodienthoai'];
            
            if(!empty($ten) && !empty($ma) && !empty($matkhau) && !empty($diachi) && !empty($sodienthoai))
            {
                $sql_kt_add = "SELECT MSKH FROM khachhang WHERE MSKH = '$ma' ";
                $rs_kt_add = mysqli_query($dbconn,$sql_kt_add);
                $count = mysqli_num_rows($rs_kt_add);
                if($count == 1){
                    echo "<script> alert('Mã khách hàng đã tồn tại') </script>";
                }else{
                    $sql_add = "INSERT INTO khachhang(MSKH,F_MATKHAU,HOTENKH,DIACHI,SODIENTHOAI ) 
                            values('{$ma}','$matkhau','{$ten}','{$diachi}','{$sodienthoai}')";
                     
                    $result_add=mysqli_query($dbconn,$sql_add);

                    if($result_add){
                      echo "<script> alert('Thêm mới thành công') </script>";
                    }else{
                      echo "<script> alert('Thêm mới không thành công') </script>";
                    }  
                }
            }else{
                echo "<script> alert('Vui lòng nhập đầy đủ thông tin') </script>";
            }
            
            echo "<script>location.href='quanlykhachhang.php'</script>";
        break;

        case 'edit':

            $ma=$_POST['edit_ma'];
            $ten=$_POST['edit_ten'];

            $diachi=$_POST['edit_diachi'];
            $sodienthoai=$_POST['edit_txtSodienthoai'];

           if(!empty($ten) && !empty($ma) && !empty($diachi) && !empty($sodienthoai))
            {
                $updateSQL = sprintf("UPDATE khachhang SET HOTENKH ='{$ten}',DIACHI ='{$diachi}',SODIENTHOAI = '{$sodienthoai}'
                            WHERE MSKH='{$ma}'");
                // echo $updateSQL;
                $result_update=mysqli_query($dbconn,$updateSQL);
                if($result_update){
                  echo "<script> alert('Cập nhật thành công') </script>";
                }else{
                  echo "<script> alert('Cập nhật thất bại') </script>";
                }
            }else{
                echo "<script> alert('Vui lòng nhập đầy đủ thông tin') </script>";
            }
            
            echo "<script>location.href='quanlykhachhang.php'</script>";
        break;
        
        case 'edit_matkhau':
            $ma=$_POST['edit_id'];
            $edit_matkhau=md5($_POST['edit_matkhau']);
            
           if(!empty($ma) && !empty($edit_matkhau) )
            {
                $updateSQL = sprintf("UPDATE khachhang SET F_MATKHAU ='{$edit_matkhau}'
                            WHERE MSKH='{$ma}'");
                // echo $updateSQL;
                $result_update=mysqli_query($dbconn,$updateSQL);
                if($result_update){
                  echo "<script> alert('Cập nhật thành công') </script>";
                }else{
                  echo "<script> alert('Cập nhật thất bại') </script>";
                }
            }else{
                echo "<script> alert('Vui lòng nhập đầy đủ thông tin') </script>";
            }
            
            echo "<script>location.href='quanlykhachhang.php'</script>";
        break;

        case 'del':

            $id = $_REQUEST['id'];
            $sql_KT_sd_mt = "SELECT MSKH FROM dathang WHERE MSKH ='$id' ";
            $rs_KT_sd_mt = mysqli_query($dbconn,$sql_KT_sd_mt);
            $count_mt = mysqli_num_rows($rs_KT_sd_mt);

            if($count_mt > 0 ){
                echo "<script> alert('Người dùng đang sử dụng không thể xóa') </script>";
            }else{
                if ($id == 'hotro'){
                    echo "<script> alert('Xóa thất bại') </script>";
                }else{
                    $sql_del = "DELETE FROM khachhang WHERE MSKH ='$id' ";
                    $result_del=mysqli_query($dbconn,$sql_del);
                    if($result_del){
                        echo "<script> alert('Xóa thành công') </script>";
                    }else{
                        echo "<script> alert('Xóa thất bại') </script>";
                    }
                }
                
            }
             echo "<script>location.href='quanlykhachhang.php'</script>";
        break;
        
  default:{}
  break;
}
}
?>

<section class="content">


  <!-- Noi dung -->
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
          <a href="quanlykhachhang.php">Danh sách khách hàng</a>
      </li>
    </ol>
    <!-- Example DataTables Card-->
    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
      <div class="card mb-3">
        <div class="card-header">
          <!--<i class="fa fa-table"></i> <b><?php echo $title; ?></b></div>-->
          <!--<br>-->
          <!--<button class="btn btn-success"><a href="themnguoidung.php" style="color: white;">Thêm</a></button>-->
          <button type="button" class="btn btn-success" id="them">Thêm</button>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="" width="100%" cellspacing="0">

                <thead>
                  <tr>
                    <th>Mã khách hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Tác Vụ</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM khachhang ";
                    $results = mysqli_query($dbconn,$sql);
                    while($row = mysqli_fetch_array($results)){
                        echo "<tr>";
                        ;
                        echo "<td>" .$row["MSKH"]. "</td>";
                        echo "<td>" .$row["HOTENKH"]. "</td>";
                      
                        echo "<td>" .$row["DIACHI"]. "</td>";
                        echo "<td>" .$row["SODIENTHOAI"]. "</td>";
                       
                        echo "<td>
                        <img id='$row[MSKH]' class='btnSua' src='images/sua_truong.jpg' width = '20'
                    height= '20' title='Cập nhật'>
                        <img id='$row[MSKH]' class='btnMatKhau' src='images/mokhoa.png' width = '20'
                    height= '20' title='Đổi mật khẩu'>
                        
                        <a href='quanlykhachhang.php?id=$row[MSKH]&act=del'>
                        <img class='icon_xoa' src='images/xoa_truong.jpg' title='Xóa'>
                        </a>
                        
                        </td>";
                        echo "</tr>";
                    }
                ?>

                </tbody>
              </table>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Cập nhật hôm nay</div> -->
        </div>
      </div>
    </form>
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
          url: "quanlykhachhang.php?act=get_info&id=" + this.id,
          dataType: 'json',
          success:function(result){
            console.log(result);  
            $("#edit_ma").val(id);
      
            $("#edit_diachi").val(result.diachi);
            $("#edit_ten").val(result.hoten);
            $("#edit_txtSodienthoai").val(result.sodienthoai);
            
            $("#modaldangky2").modal("show");
          }
        });

      });
      
      $(".btnMatKhau").click(function(){
          console.log(this.id);
        var id = this.id;
        $("#edit_id").val(id);
        $("#modaldangky3").modal("show");
      });
    });
  </script>

<!-- Form -->
<div id="modaldangky" class="modal fade" role="dialog" tabindex="-1">


  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form action="quanlykhachhang.php?act=add" id="formDemo" method="POST">
        <div class="modal-header">

          <h5 class="modal-title">From thêm khách hàng</h5>
          <!--<button class="close" data-dismiss="modal">&times;</button>-->
        </div>

        <div class="modal-body">
                <div class="form-group">
                  <label>Mã khách hàng</label>
                  <input class="form-control" name="ma" type="text" placeholder ="Vui lòng nhập mã" required="">
                </div> 
                <div class="form-group">
                  <label>Tên khách hàng</label>
                  <input class="form-control" name="ten" type="text" placeholder="Vui lòng nhập tên" required="">
                </div>
            
                <div class="form-group">
                  <label>Mật khẩu</label>
                  <input class="form-control" name="matkhau" type="password" placeholder="Vui lòng nhập mật khẩu" required="">
                </div>
            
           
                
                <div class="form-group">
                  <label>Địa chỉ</label>
                  <input class="form-control" name="diachi" type="text" placeholder="Vui lòng nhập địa chỉ" required="">
                </div>
            
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input class="form-control" name="txtSodienthoai" type="text" placeholder ="Vui lòng nhập số điện thoại" required="">
                </div> 
        </div>

        <div class="modal-footer">
            <input type="submit" id="dangky" name="dangky" class="btn btn-primary " value="Thêm">
            <button id="dongform" class="btn btn-danger " data-dismiss="modal">Trở về</button>
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

              <h5 class="modal-title">From cập nhật khách hàng </h5>
              <!--<button class="close" data-dismiss="modal">&times;</button>-->
            </div>
              <form  action="quanlykhachhang.php?act=edit" method="POST">
                <div class="modal-body">
                        <div class="form-group">
                          <label>Mã khách hàng</label>
                          <input class="form-control" name="edit_ma" id="edit_ma" readonly="" type="text" placeholder ="Vui lòng nhập mã" required="">
                        </div> 
                        <div class="form-group">
                          <label>Tên khách hàng</label>
                          <input class="form-control" name="edit_ten" id="edit_ten" type="text" placeholder="Vui lòng nhập tên" required="">
                        </div>

                        <div class="form-group">
                          <label>Địa chỉ</label>
                          <input class="form-control" name="edit_diachi" id="edit_diachi" type="text" placeholder="Vui lòng nhập địa chỉ" required="">
                        </div>

                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" name="edit_txtSodienthoai" id="edit_txtSodienthoai" type="text" placeholder ="Vui lòng nhập số điện thoại" required="">
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
  <!-- End noi dung -->
  <!-- Form 2 -->

       <div id="modaldangky3" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title">From cập nhật mật khẩu </h5>
              <!--<button class="close" data-dismiss="modal">&times;</button>-->
            </div>
              <form  action="quanlykhachhang.php?act=edit_matkhau" method="POST">
                <div class="modal-body">
                        <div class="form-group">
                          <label>Mật khẩu mới </label>
                          <input class="form-control" name="edit_matkhau" type="password" placeholder ="Vui lòng nhập mật khẩu mới" required="">
                          <input type="hidden" id="edit_id" name="edit_id" />
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
  <!-- End noi dung -->
  
  <?php include("footerquanly.php"); ?>