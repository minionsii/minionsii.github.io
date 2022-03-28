<?php
if(isset($_REQUEST['act'])){
  if($_REQUEST['act']=='get_info'){
    $id = $_REQUEST['id'];
    $dbconnect = mysqli_connect('localhost','root','','webbanhang');
    mysqli_set_charset($dbconnect,'utf8');
    $sql = "SELECT * FROM hanghoa where MSHH = '$id'";
    $result1=mysqli_query($dbconnect,$sql);
    $row = mysqli_fetch_array($result1);
    echo json_encode(array("hinh" => $row['HINH'],"nhom" => $row['MANHOM'],"tenhh" => $row['TENHH'],"gia" => $row['GIA']
            ,"soluong" => $row['SOLUONGHANGHOA'],"mota" => $row['MOTAHH']
           ));
    exit();
  }

}
?>

<?php include("header.php"); ?>
<?php
if(isset($_REQUEST['act'])){
  $act = $_REQUEST['act'];
  switch ($act){
    case 'dangnhap':
        $username = $_REQUEST["username"];
        $password = md5($_REQUEST["password"]);

        if (empty($username) or empty($password)) {
                echo" <script> alert('username hoặc password bạn không được để trống!') </script>";
        }else{
            $sql = "SELECT * from khachhang where MSKH = '$username' and F_MATKHAU = '$password' ";

            $query = mysqli_query($dbconn,$sql);
            $num_rows = mysqli_num_rows($query);

            if ($num_rows<>0)
            {	

                    while ( $data = mysqli_fetch_array($query) ) {
                            $_SESSION['MSKH']          = $data["MSKH"];
                            $_SESSION['HOTENKH']	   = $data["HOTENKH"];
                            $_SESSION["F_MATKHAU"] 	   = $data["F_MATKHAU"];
                            $_SESSION["DIACHI"]        = $data["DIACHI"];
                            $_SESSION["SODIENTHOAI"]   = $data["SODIENTHOAI"];


                    }
                    // Thực thi hành động sau khi lưu thông tin vào session
                    echo "<script>location.href='index.php'</script>";
            }
            else{
                    echo" <script> alert('username hoặc password bạn không đúng') </script>";
            }
        }
    break;
    case 'dangxuat':
        session_destroy();
        echo "<script>location.href='index.php'</script>";
    break;

    case 'dangky':
        $username = $_REQUEST["username"];
        $password = md5($_REQUEST["password"]);
        $hoten = $_REQUEST["hoten"];
        $diachi = $_REQUEST["diachi"];
        $sodienthoai = $_REQUEST["sodienthoai"];

        if (empty($username) or empty($password) or empty($hoten)) {
                echo" <script> alert('Bạn chưa điền đầy đủ thông tin!') </script>";
        }else{
            $sql = "SELECT * from khachhang where MSKH = '$username'  ";
            $query = mysqli_query($dbconn,$sql);
            $num_rows = mysqli_num_rows($query);
            
            if ($num_rows<>0)
            {	
                echo "<script> alert('Username đã tồn tại') </script>";
            }
            else{
                $sql_add = "INSERT INTO khachhang(MSKH,HOTENKH,DIACHI,SODIENTHOAI,F_MATKHAU) 
                        values('$username','$hoten','$diachi','$sodienthoai','$password')";
                $result_add=mysqli_query($dbconn,$sql_add);

                if($result_add){
                  echo "<script> alert('Thêm mới thành công') </script>";
                }else{
                  echo "<script> alert('Thêm mới không thành công') </script>";
                }  
            }
        }
        echo "<script>location.href='index.php'</script>";
    break;
    
    case 'del':
        $id = $_REQUEST['id'];
        
        $sql_xoadh = "DELETE FROM DATHANG WHERE SODONDH ='$id' ";
        $sql_xoachitietdh = "DELETE FROM CHITIETHANGHOA WHERE SODONDH ='$id' ";
        
        $result_xoachitietdh=mysqli_query($dbconn,$sql_xoachitietdh);
        $result_xoadh=mysqli_query($dbconn,$sql_xoadh);

        if($result_xoadh){
            echo "<script> alert('Xóa đơn hàng [$id] thành công') </script>";
        }else{
            echo "<script> alert('Xóa thất bại') </script>";
        }

        echo "<script>location.href='index.php'</script>";
    break;
    
    case 'datmuasp':
        $mskh = $_SESSION['MSKH'];
        $masohh = $_POST['masohh'];
        $so_luong_can_mua = $_POST['so_luong_can_mua'];
        $don_gia_can_mua = $_POST['don_gia_can_mua'];
        
        $sql_getMaxSoDonDH = "SELECT MAX(SODONDH)+1 MAXSODONDH from chitiethanghoa ";
        $rs_getMaxSoDonD = mysqli_query($dbconn,$sql_getMaxSoDonDH);
        $row_getMaxSoDon = mysqli_fetch_array($rs_getMaxSoDonD);
        
        $sodondathang_next = $row_getMaxSoDon['MAXSODONDH'];
        
        $sql_adddh = "INSERT INTO dathang(SODONDH,MSNV,MSKH,NGAYDH,TRANGTHAI) 
                values('$sodondathang_next',null,'$mskh',SYSDATE(),0)";
//        echo $sql_adddh;die;
        $result_adddh=mysqli_query($dbconn,$sql_adddh);
        
        $sql_addchitiethh = "INSERT INTO chitiethanghoa(SODONDH,MSHH,SOLUONG,GIADATHANG) 
                values('$sodondathang_next','$masohh','$so_luong_can_mua','$don_gia_can_mua')";
        $result_aaddchitiethh=mysqli_query($dbconn,$sql_addchitiethh);
        
        if($result_adddh && $result_aaddchitiethh){
            echo "<script> alert('Đặt hàng sản phẩm [$masohh] thành công') </script>";
        }else{
            echo "<script> alert('Đặt hàng không thành công') </script>";
        }

        echo "<script>location.href='index.php'</script>";
    break;
    
    case 'capnhatthongtin':
        $mskh = $_SESSION['MSKH'];
        $hoten = $_POST["hoten"];
        $diachi = $_POST["diachi"];
        $sodienthoai = $_POST["sodienthoai"];
        
        if(!empty($hoten) && !empty($mskh) && !empty($diachi) && !empty($sodienthoai))
        {
            $updateSQL = sprintf("UPDATE khachhang SET HOTENKH ='{$hoten}',DIACHI ='{$diachi}',SODIENTHOAI = '{$sodienthoai}'
                        WHERE MSKH='{$mskh}'");
            $result_update=mysqli_query($dbconn,$updateSQL);
            if($result_update){
              echo "<script> alert('Cập nhật thành công. Bạn cần đăng nhập lại để thông tin được cập nhật lại') </script>";
            }else{
              echo "<script> alert('Cập nhật thất bại') </script>";
            }
        }else{
            echo "<script> alert('Vui lòng nhập đầy đủ thông tin') </script>";
        }
        echo "<script>location.href='index.php'</script>";
    break;
    
    case 'doimatkhau':
        $mskh = $_SESSION['MSKH'];
        
        $edit_matkhau_cu=md5($_POST['edit_matkhau_cu']);
        $edit_matkhau_moi=md5($_POST['edit_matkhau_moi']);
        $edit_matkhau_moi_2=md5($_POST['edit_matkhau_moi_2']);
        
        if($edit_matkhau_moi == $edit_matkhau_moi_2)
        {
            $sql_kt_mkcu = "SELECT MSKH FROM khachhang WHERE MSKH = '$mskh' AND F_MATKHAU = '$edit_matkhau_cu' ";
            $rs_kt_mkcu = mysqli_query($dbconn,$sql_kt_mkcu);
            $count = mysqli_num_rows($rs_kt_mkcu);
            if($count == 0){
                echo "<script> alert('Mật khẩu cũ không đúng') </script>";
            }else{
                $updateSQL = sprintf("UPDATE khachhang SET F_MATKHAU ='{$edit_matkhau_moi}'
                            WHERE MSKH='{$mskh}'");
                // echo $updateSQL;
                $result_update=mysqli_query($dbconn,$updateSQL);
                if($result_update){
                  echo "<script> alert('Cập nhật thành công') </script>";
                }else{
                  echo "<script> alert('Cập nhật thất bại') </script>";
                }
            }
        }else{
            echo "<script> alert('Mật khẩu và mật khẩu nhập lại không giống nhau') </script>";
        }

        echo "<script>location.href='index.php'</script>";
    break;
    
    default:{}
    break;
  }
}
?>
<?php

$search = isset($_POST['search']) ? $_POST['search'] : '';
$catIDloaiSP = isset($_REQUEST['catIDloaiSP']) ? $_REQUEST['catIDloaiSP'] :"";
//echo $catIDloaiSP;
if ($catIDloaiSP != ''){
    if($search != '' ){
        $sqlallsp = "SELECT * FROM hanghoa WHERE MANHOM = '$catIDloaiSP'  AND TENHH LIKE '%$search%' 
     ";
    }else{
        $sqlallsp = "SELECT * FROM hanghoa WHERE MANHOM = '$catIDloaiSP'  
     ";
    }
        
}else{
    if($search != '' ){
        $sqlallsp = "SELECT * FROM hanghoa WHERE TENHH LIKE '%$search%' 
     ";
    }else{
        $sqlallsp = "SELECT * FROM hanghoa 
        ";
    }
    
}

$kqsqlallsp = mysqli_query($dbconn,$sqlallsp);

$kqsqlspnb = mysqli_query($dbconn,$sqlallsp);


?>

<!-- top Products -->
<div class="ads-grid">
	<div class="container">

	<!--<div class="agileinfo-ads-display col-md-12">-->
		<div class="wrapper">
			<!-- first section (nuts) -->
			<div class="product-sec1">
				<h3 class="heading-tittle">
                                    <?php if ($catIDloaiSP != ''){
                                        $get_tennhomsp = "SELECT TENNHOM FROM nhomhanghoa WHERE manhom = '$catIDloaiSP' ";
                                        $rs_tennhomsp = mysqli_query($dbconn, $get_tennhomsp);
                                        $row_tennhomsp = mysqli_fetch_array($rs_tennhomsp);
                                        echo $row_tennhomsp['TENNHOM'];
                                    }else{
                                        echo " Sản phẩm ";
                                    }
                                    ?>
                                </h3>


				<?php 

				$demsp = 1;

				while(($row = mysqli_fetch_array($kqsqlallsp)) && ($demsp <=1000)){
				
						?>
						<!-- sp1 -->
                                                <div class="col-md-3 product-men" >
                                                    <div class="men-pro-item simpleCart_shelfItem" style="height: 270px;margin-bottom: 50px;">
								<div class="men-thumb-item">
                                                                        <img src="<?php echo $row['HINH']; ?>" width="100px" height="110px" />
									<!--<img src="images/<?php echo $row['HINH'];?>" alt="hinh anh" width="120" height="130">-->
<!--									<div class="men-cart-pro">
										<div class="inner-men-cart-pro">
											<a href="single.php?catIDSP=<?php echo $row['MSHH'];?>&ID_TK_SP=<?php echo $row['MSHH'];?>" class="link-product-add-cart">Xem</a>
										</div>
									</div>-->
									<span class="product-new-top">Nổi bật</span>
								</div>
                                                        <div class="item-info-product " style="height: 120px;">
                                                                <h5 >
                                                                        <b><?php echo $row['TENHH'];?></b>
                                                                </h5>	
                                                                <h5 style="margin-bottom: 5px">
                                                                        <i><span>Số lượng: <b><?php echo $row['SOLUONGHANGHOA'];?></b></span></i>
                                                                </h5>
                                                                <h5 style="margin-bottom: 5px">
                                                                    <i><span><ins>Mô tả</ins>: <?php echo $row['MOTAHH'];?></span></i>
                                                                </h5>



                                                        </div>
                                                        <center>
                                                            <div class="info-product-price " style="margin-bottom: 5px">
                                                                <span class="price" style="color:red;"><?php echo $row['GIA'];?></span>
                                                            </div>
                                                        </center>
                                                        <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out" >
                                                            <?php if (isset($_SESSION['MSKH'])) { 
                                                                ?>
                                                                <input id="<?=$row['MSHH']?>" type="button" value="Đặt mua" class="button datmuahang" />
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <input  type="button" value="Đặt mua" class="button dangnhap" />
                                                                <?php
                                                            }
                                                            ?>
                                                            
                                                            	
                                                        </div>
                                                    </div>
						</div>
						<!-- sp1 -->		
						<?php
					$demsp += 1;
                                    }
				?>
			<div class="clearfix"></div>
                    </div>
		</div>
	<!--</div>-->
</div>
</div>
<!-- //top products -->
<!-- special offers -->
<div class="featured-section" id="projects">

	<div class="container">
		<!-- tittle heading -->
		<h3 class="tittle-w3l">Sản phẩm nổi bật
			<span class="heading-style">
				<i></i>
				<i></i>
				<i></i>
			</span>
		</h3>
		<!-- //tittle heading -->
		<div class="content-bottom-in">
			<ul id="flexiselDemo1">

				<?php 
					while ($rowkqsqlspnb = mysqli_fetch_array($kqsqlspnb)) {
				?>
					<li>
						<div class="w3l-specilamk">
							<div class="speioffer-agile" style="height: 130px;">
                                                                <img src="<?php echo $rowkqsqlspnb['HINH']; ?>" width="100px" height="110px" />
							</div>
							<div class="product-name-w3l" style="height: 160px;">
								<h5 >
                                                                        <b><?php echo $rowkqsqlspnb['TENHH'];?></b>
                                                                </h5>	
                                                                <h5 style="margin-bottom: 5px">
                                                                        <i><span>Số lượng: <b><?php echo $rowkqsqlspnb['SOLUONGHANGHOA'];?></b></span></i>
                                                                </h5>
                                                                <h5 style="margin-bottom: 5px">
                                                                    <i><span><ins>Mô tả</ins>: <?php echo $rowkqsqlspnb['MOTAHH'];?></span></i>
                                                                </h5>
									
							</div>
                                                    <center>
                                                        <div class=" info-product-price " style="margin-bottom: 10px">
                                                                <span class="price" style="color:red;"><?php echo $rowkqsqlspnb['GIA'];?></span>
                                                            </div>
                                                    </center>
                                                        <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                            <?php if (isset($_SESSION['MSKH'])) { 
                                                                ?>
                                                                <input id="<?=$row['MSHH']?>"  type="button" value="Đặt mua" class="button datmuahang" />
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <input  type="button" value="Đặt mua" class="button dangnhap" />
                                                                <?php
                                                            }
                                                            ?>
                                                            
                                                        </div>
						</div>
					</li>
				
				<?php
					}
				?>

			</ul>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
  $(".datmuahang").click(function(){
    console.log(this.id);
    var id = this.id;
    $.ajax({
      url: "index.php?act=get_info&id=" + this.id,
      dataType: 'json',
      success:function(result){
        console.log(result);
 
        $(".masohh").val(id);  
        $(".tensanpham").text(result.tenhh);
        $(".don_gia_can_mua").val(result.gia);
        $(".don_gia_can_mua").text(result.gia);
        var nf = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
        $(".don_gia_can_mua").text(function(){
                return nf.format($(this).html());
        });
        document.getElementById("myImg").src = result.hinh; 
        
        $("#modaldatmuasp").modal("show");
      }
    });

  });

});
</script>
<!-- form đặt mua sản phẩm -->
<div id="modaldatmuasp" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                    <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                            </button>
                            <center>
                                    <h3 class="modal-title"><i class="hidden" aria-hidden="true"></i>Đặt mua sản phẩm
                                    </h3>
                            </center>

                    </div>
                    <div class="modal-body">
                            <div class="form_mess_shop">
                                    <form action="index.php?act=datmuasp" id="formdathang" class="form-horizontal" method="POST">
                                            <div class="form-group">
                                                    <label class="col-sm-5 control-label">Sản phẩm</label>
                                                    <div class="col-sm-7">
                                                        <div class="row"> 
                                                            <div class="col-sm-4 hidden-xs">
                                                                <img id="myImg" src="<?php echo $row['HINH']; ?>" width="90">
                                                                <input type="hidden" name="masohh" class="masohh"/>
                                                            </div> 
                                                            <div class="col-sm-8"> 
                                                                <label class="control-label tensanpham"></label>
                                                            </div> 
                                                        </div> 
                                                        
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                    <label class="col-sm-5 control-label">Số lượng cần mua</label>

                                                    <input type="hidden" value="0" id="quasoluong" name="quasoluong">
                                                    <div class="col-sm-7">
                                                            <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <input type="number" required=""  name="so_luong_can_mua" id="so_luong_can_mua" class="form-control" placeholder="0">
                                                                    </div>
                                                                   
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="form-group">

                                                    <div class="col-sm-5">

                                                    </div>
                                                    <div class="col-sm-7">
                                                            <span id="thongbaokqdh"></span>
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                    <label class="col-sm-5 control-label">Đơn giá</label>
                                                    <div class="col-sm-7">
                                                            <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <input type="number" name="don_gia_can_mua" id="don_gia_can_mua" min="1000" class="form-control price don_gia_can_mua" value="">
                                                                    </div>
                                                                    
                                                            </div>
                                                    </div>
                                            </div>
                                            <div>
                                                    <div class="form-group">
                                                            <label class="col-sm-5 control-label">Thành tiền</label>
                                                            <div class="col-sm-7">
                                                                    <label class="control-label">
                                                                            <span>
                                                                                    <strong id="thanh_tien" class="price" >
                                                                                    </strong> 
                                                                            </span>
                                                                    </label>
                                                            </div>
                                                    </div>
                                            </div>

                                            <div>
                                                    <div class="form-group">
                                                            <div class="col-sm-offset-3 col-sm-2">
                                                                    <button type="submit" class="btn btn-success btn_orange">Đặt mua</button>
                                                            </div>
                                                            <div class="col-sm-7">
                                                                    <label class="control-label">
                                                                            <strong class="blink_me" style="font-size:75%">Vui lòng nhập đơn giá từ
                                                                                    <span class="don_gia_can_mua red price ">
                                                                                    </span>&nbsp;trở lên 
                                                                                    <span class="hidden"></span>
                                                                            </strong>
                                                                    </label>
                                                            </div>
                                                    </div>
                                            </div>
                                    </form>
                            </div>
                    </div>
            </div>

    </div>

</div>
<script>
    $(document).ready(function(){
        $('#don_gia_can_mua').keyup(function(){
            var dongia = $('#don_gia_can_mua').val();
            var soluong  = $('#so_luong_can_mua').val();
            var thanhtien = dongia * soluong;
            console.log(thanhtien);
            $('#thanh_tien').html(thanhtien);

            var nf = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
            $("#thanh_tien").text(function(){
                    return nf.format($(this).html());
            });
        });
        $('#so_luong_can_mua').keyup(function(){
            var dongia = $('#don_gia_can_mua').val();
            var soluong  = $('#so_luong_can_mua').val();
            var thanhtien = dongia * soluong ;
            console.log(thanhtien);
            $('#thanh_tien').html(thanhtien);

            var nf = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
            $("#thanh_tien").text(function(){
                    return nf.format($(this).html());
            });
        });
        document.getElementById('so_luong_can_mua').addEventListener('change', function (e) {
            if(this.value < 0.01){
              this.value = '';
            } else {
              this.value = Math.round(+this.value * 100)/100;
            }
        });
    });
</script>
<!-- end form -->
<?php include("footer.php"); ?>