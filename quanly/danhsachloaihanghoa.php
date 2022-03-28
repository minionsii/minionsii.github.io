<?php
if(isset($_REQUEST['act'])){
  if($_REQUEST['act']=='get_info'){
    $id = $_REQUEST['id'];
    $dbconnect = mysqli_connect('localhost','root','','webbanhang');
    mysqli_set_charset($dbconnect,'utf8');
    $sql = "SELECT * FROM nhomhanghoa where MANHOM = '$id'";
    $result1=mysqli_query($dbconnect,$sql);
    $row = mysqli_fetch_array($result1);
    echo json_encode(array("tenhh" => $row['TENNHOM']));
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
        if(!empty($ten) && !empty($ma) )
        {
            $sql_kt_add = "SELECT MANHOM FROM nhomhanghoa WHERE MANHOM = '$ma' ";
            $rs_kt_add = mysqli_query($dbconn,$sql_kt_add);
            $count = mysqli_num_rows($rs_kt_add);
            if($count == 1){
                echo "<script> alert('Mã loại hàng hóa đã tồn tại') </script>";
            }else{
                $sql_add = "INSERT INTO nhomhanghoa(MANHOM,TENNHOM) 
                        values('$ma','{$ten}')";
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
        echo "<script>location.href='danhsachloaihanghoa.php'</script>";
//        sprintf("Location: %s", "danhsachloaihanghoa.php");
    break;
    case 'edit':
        $ma=$_POST['ma'];
        $ten=$_POST['ten'];
        if(!empty($ten) && !empty($ma)  )
        {
            $updateSQL = sprintf("UPDATE nhomhanghoa 
                    SET TENNHOM='{$ten}' WHERE MANHOM='{$ma}'");
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
        echo "<script>location.href='danhsachloaihanghoa.php'</script>";
    break;
    
    case 'del':
        $id = $_REQUEST['id'];
        $sql_KT_sd_mt = "SELECT MANHOM FROM hanghoa WHERE MANHOM ='$id' ";
        $rs_KT_sd_mt = mysqli_query($dbconn,$sql_KT_sd_mt);
        $count_mt = mysqli_num_rows($rs_KT_sd_mt);
    
        if($count_mt > 0 ){
            echo "<script> alert('Loại hàng hóa đang được sử dụng') </script>";
        }else{
            $sql_del = "DELETE FROM nhomhanghoa WHERE MANHOM ='$id' ";

            $result_del=mysqli_query($dbconn,$sql_del);

            if($result_del){
                echo "<script> alert('Xóa thành công') </script>";
            }else{
                echo "<script> alert('Xóa thất bại') </script>";
            }
        }
        echo "<script>location.href='danhsachloaihanghoa.php'</script>";
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
        <a href="#"><li class="active">Danh sách loại hàng hóa</li></a>
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
                <th>Mã loại hàng hóa</th>
                <th>Tên loại hàng hóa</th>
                <th>Tác Vụ</th>
              </tr>
            </thead>
            <?php
            $sql = "SELECT MANHOM ,TENNHOM FROM nhomhanghoa";
            $results = mysqli_query($dbconn,$sql) ;
            ?>
            <tbody>
              <?php
              $stt = 1;
              while($row = mysqli_fetch_array($results)){ 
                  ?>
                <tr>
                  <td><?php echo $row['MANHOM']; ?></td>
                  <td><?php echo $row['TENNHOM']; ?></td>
             
                  <td>

                    <img id="<?=$row[0]?>" class="btnSua" src="images/sua_truong.jpg" width = "20"
                    height= "20" title="Cập nhật">
                    
                    <a href="danhsachloaihanghoa.php?act=del&id=<?php echo $row['MANHOM']; ?>" >
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
      url: "danhsachloaihanghoa.php?act=get_info&id=" + this.id,
      dataType: 'json',
      success:function(result){
        console.log(result);
        $("#edit_ma").val(id);
        $("#edit_ten_1").val(result.tenhh);
        $("#modaldangky2").modal("show");
      }
    });

  });

});
</script>
    <!-- Form -->
<div id="modaldangky" class="modal fade" role="dialog" tabindex="-1">


  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form action="danhsachloaihanghoa.php?act=add" id="formDemo" method="POST">
        <div class="modal-header">

          <h5 class="modal-title">From thêm loại hàng hóa</h5>
          <!--<button class="close" data-dismiss="modal">&times;</button>-->
        </div>

        <div class="modal-body">
           <div class="form-group">
                <label>Mã loại hàng hóa</label>
                <input class="form-control" name="ma" id="ma" type="text" placeholder ="Vui lòng nhập mã" >
              </div> 
              <div class="form-group">
                <label>Tên loại hàng hóa</label>
                <input class="form-control" name="ten" id="ten" type="text" placeholder="Vui lòng nhập tên" >
              </div>
              
            </div>

            <div class="modal-footer">
             <input type="submit" id="dangky" name="dangky" class="btn btn-primary " value="Thêm">
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

       <h5 class="modal-title">From cập nhật loại hàng hóa </h5>
       <!--<button class="close" data-dismiss="modal">&times;</button>-->
     </div>
     <form  action="danhsachloaihanghoa.php?act=edit" method="POST">
         <div class="modal-body">
             <div class="form-group">
               <label>Mã loại hàng hóa</label>
               <input class="form-control" id="edit_ma" name="ma" type="text" readonly="readonly">
             </div>
             <div class="form-group">
               <label>Tên loại hàng hóa</label>
               <input class="form-control" id="edit_ten_1" name="ten" type="text"  >
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