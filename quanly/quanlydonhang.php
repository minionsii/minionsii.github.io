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
    case 'duyet':
        $msnv = $_SESSION['MSNV'];
        $id = explode("@@", $_REQUEST['id']);
        $sodondh = $id[0];
        $mshh = $id[1];
        $soluong = $id[2];
        $sql_kt_soluonghh = "SELECT SOLUONGHANGHOA FROM hanghoa WHERE MSHH = '$mshh' ";
        $rs_kt_soluonghh = mysqli_query($dbconn,$sql_kt_soluonghh);
        $row = mysqli_fetch_array($rs_kt_soluonghh);
        $soluonghanghoa = $row['SOLUONGHANGHOA'];
        if($soluonghanghoa<$soluong){
            echo "<script> alert('Số lượng hàng hóa không đủ cho số lượng của đơn đặt hàng') </script>";
        }else{
            $soluongconlai = $soluonghanghoa - $soluong;
            $sql_duyet_hanghoa = "UPDATE hanghoa SET SOLUONGHANGHOA = '$soluongconlai' WHERE MSHH ='$mshh' ";
            $result_duyet_hanghoa=mysqli_query($dbconn,$sql_duyet_hanghoa);
            
            $sql_duyet = "UPDATE DATHANG SET TRANGTHAI = 1 ,MSNV = '$msnv' WHERE SODONDH ='$sodondh' ";
            $result_duyet=mysqli_query($dbconn,$sql_duyet);

            if($result_duyet && $result_duyet_hanghoa){
                echo "<script> alert('Duyệt thành công') </script>";
            }else{
                echo "<script> alert('Duyệt thất bại') </script>";
            }
        }
       

        echo "<script>location.href='quanlydonhang.php'</script>";
    break;
    
    case 'del':
        $msnv = $_SESSION['MSNV'];
        $id = $_REQUEST['id'];
        
        $sql_huyduyet = "UPDATE DATHANG SET TRANGTHAI = 2 , MSNV = '$msnv' WHERE SODONDH ='$id' ";

        $result_huyduyet=mysqli_query($dbconn,$sql_huyduyet);

        if($result_huyduyet){
            echo "<script> alert('Hủy thành công') </script>";
        }else{
            echo "<script> alert('Hủy thất bại') </script>";
        }

        echo "<script>location.href='quanlydonhang.php'</script>";
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
        <a href="#"><li class="active">Danh sách đơn hàng</li></a>
      </ol>
       <!-- Example DataTables Card-->
    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
      <div class="card mb-3">
        <div class="card-header">
      <div class="card-body">
        <div class="table-responsive">
          <table class="display" id="" width="100%" cellspacing="0">
            <thead>
              <tr>
                  <th>Số<br>ĐH</th>
                <th>Khách hàng</th>  
                <!--<th>Loại</th>-->
                <!--<th>Hình ảnh</th>-->
                <th>Hàng hóa</th>
                <th>Số lượng</th>
                <th>Giá đặt</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Tác Vụ</th>
              </tr>
            </thead>
            <?php
            $sql = "SELECT C.MSKH,c.HOTENKH,d.MSNV,d.HOTENNV,a.*,b.*,e.*,f.* FROM dathang A 
                LEFT JOIN chitiethanghoa B ON A.SODONDH = B.SODONDH
                LEFT JOIN khachhang C ON A.MSKH =C.MSKH
                LEFT JOIN nhanvien D ON A.MSNV = D.MSNV
                LEFT JOIN hanghoa E ON b.MSHH = e.MSHH
                LEFT JOIN nhomhanghoa F ON e.MANHOM = f.MANHOM";
            $results = mysqli_query($dbconn,$sql) ;
            ?>
            <tbody>
              <?php
              $stt = 1;
              while($row = mysqli_fetch_array($results)){ 
                  if ($row['TRANGTHAI'] == 0){
                      $trangthai = "Chờ duyệt";
                  } else if ($row['TRANGTHAI'] == 1){
                      $trangthai = "Duyệt (".$row['MSNV']. ")";
                  } else {
                      $trangthai = "Hủy (".$row['MSNV']. ")";
                  }
                  ?>
                <tr>
                    <td><?php echo $row['SODONDH']; ?></td>
                  <td><?php echo $row['MSKH'].'-'.$row['HOTENKH']; ?></td>
                  <!--<td><?php echo $row['TENNHOM']; ?></td>-->
                  <td><img src="<?php echo $row['HINH']; ?>" width="50px" height="50px" />
                      <?php echo $row['MSHH'].'-'.$row['TENHH']; ?></td>
                  <td><?php echo $row['SOLUONG']; ?></td>
                  <td class="price"><?php echo $row['GIADATHANG']; ?></td>
                  <td><?php echo $row['NGAYDH']; ?></td>
                  <td><?php echo $trangthai; ?></td>
                  <td>
                      <?php if ($row['TRANGTHAI'] != 1){
                     ?>
                    <a href="quanlydonhang.php?act=duyet&id=<?php echo $row['SODONDH'].'@@'.$row['MSHH'].'@@'.$row['SOLUONG']; ?>" >
                      <img class="icon_xoa" src="images/duyet.png" title="Duyệt" >
                    </a>
                    
                      <a href="quanlydonhang.php?act=del&id=<?php echo $row['SODONDH']; ?>" >
                        <img class="icon_xoa" src="images/xoa_truong.jpg" title="Không duyệt" >
                      </a>
                      <?php
                    }
                    ?>
      
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



 <?php include("footerquanly.php"); ?>