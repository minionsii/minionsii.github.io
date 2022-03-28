<?php
    include "config.php";
    include "session.php";
    include "HamDungChung.php";
?>


<?php
	// Loại sản phẩm
$sqlloaisp = "SELECT * FROM nhomhanghoa";
$kqsqlloaisp = mysqli_query($dbconn,$sqlloaisp);
	// Địa phương
$sqldiaphuong = "SELECT * FROM dia_phuong";
$kqsqldiaphuong = mysqli_query($dbconn,$sqldiaphuong);
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Shop Online</title>
	<!--/tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Grocery Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--//tags -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<!--pop-up-box-->
	<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<!--//pop-up-box-->

	<!-- css riêng -->
	<link href="css/truong.css" rel="stylesheet" type="text/css"  />

	<!-- price range -->
	<link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">

	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
	<!-- fonts -->
	<!-- fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">

	<script src="js/bootstrap.min.js"></script>
	<script src="js1/jquery.min.js"></script>
	<script src="comments/jquery-3.2.1.min.js"></script>


</head>
<body>
	<!-- header-bot-->
	<div class="header-bot">
            <div class="row">
                
                    <div class="header-bot_inner_wthreeinfo_header_mid" >
                            <div class="col-md-2">
                                    <img id="logobandua" src="images/ban-hang-online.png" alt="logo" width="200" height="140">
                            </div>

                    </div>
                    <!-- header-bot -->
                    <div id="search" class="col-md-8 header logo_agile" style="float:right;">
                            <ul>
                                <?php if (isset($_SESSION['MSKH'])) { 
                                    $sql_getDsDonDH = "SELECT C.MSKH,c.HOTENKH,d.MSNV,d.HOTENNV,a.*,b.*,e.*,f.* FROM dathang A 
                                                        LEFT JOIN chitiethanghoa B ON A.SODONDH = B.SODONDH
                                                        LEFT JOIN khachhang C ON A.MSKH =C.MSKH
                                                        LEFT JOIN nhanvien D ON A.MSNV = D.MSNV
                                                        LEFT JOIN hanghoa E ON b.MSHH = e.MSHH
                                                        LEFT JOIN nhomhanghoa F ON e.MANHOM = f.MANHOM WHERE a.MSKH = '".$_SESSION['MSKH']."' " ;
                                    $results_getDsDonDH = mysqli_query($dbconn,$sql_getDsDonDH) ;
                                    $results_getDsDonDH_num = mysqli_query($dbconn,$sql_getDsDonDH) ;
                                    $num_rows = mysqli_num_rows($results_getDsDonDH_num);
                                    ?>
                                    <li>
                                        <!--<a href="Login/index.php" >-->
                                        <!--<p  >-->
                                        <span id="<?=$_SESSION['MSKH']?>" class="fa fa-user-circle-o thongtintaikhoan" aria-hidden="true" >
                                            <?php echo $_SESSION['HOTENKH']; ?></span> 
                                        <!--</p>-->
                                        <!--</a>-->
                                    </li>
                                    <li>
                                        <!--<a href="Login/index.php" >-->
                                        <!--<p  >-->
                                        <span id="<?=$_SESSION['MSKH']?>" class="fa fa-unlock doimatkhau" aria-hidden="true" >
                                            Đổi mật khẩu</span> 
                                        <!--</p>-->
                                        <!--</a>-->
                                    </li>
                                    
                                    <li>
                                        <a href="index.php?act=dangxuat" >
                                        <!--<p  >-->
                                        <span class="fa fa-user-circle-o" aria-hidden="true" ></span> Đăng xuất
                                        <!--</p>-->
                                        </a>
                                    </li>
                                    
                                    <li id="giohang">
                                        <!--<a href="Login/index2.php">-->
                                            <span class="fa fa-shopping-cart" aria-hidden="true">(<i style="color: black"><?php echo $num_rows;?></i>)</span>
                                            <!--</a>-->
                                    </li>
                                <?php } else{ ?>
                                    <li class="dangnhap">
                                        <!--<a href="Login/index.php" >-->
                                        <!--<p  >-->
                                        <span class="fa fa-unlock-alt" aria-hidden="true" ></span> Đăng nhập
                                        <!--</p>-->
                                        <!--</a>-->
                                    </li>
                                    <li id="dangky">
                                        <!--<a href="Login/index2.php">-->
                                        <span class="fa fa-pencil-square-o" aria-hidden="true"></span> Đăng ký 
                                        <!--</a>-->
                                    </li>
                                <?php } ?>
                                    
                            </ul>
                                            <!-- search -->
                            <div class="agileits_search">
                                    <form action="index.php" method="post">
                                            <input name="search" type="search" placeholder="Tìm kiếm sản phẩm ..." required="">
                                            <button type="submit" class="btn btn-default" aria-label="Left Align">
                                                    <span class="fa fa-search" aria-hidden="true"> </span>
                                            </button>
                                    </form>
                            </div>
                    </div>
            </div>
        </div>	
<!-- navigation -->
<div class="ban-top">
	<div class="container">
		<div class="top_nav_left">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav menu__list">
							<li class="active">
								<a class="nav-stylehead" href="index.php">Trang chủ
									<span class="sr-only">(current)</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle nav-stylehead" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sản phẩm
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu multi-column">
									<div class="agile_inner_drop_nav_info">
										<div class="row">
											<center>
												<ul class="multi-column-dropdown">
                                                                                                    <a href="index.php"><li>Tất cả</li></a>
													<?php
													while ($row_kqsqlloaisp = mysqli_fetch_array($kqsqlloaisp)) {
														?>
														<a href="index.php?catIDloaiSP=<?php echo $row_kqsqlloaisp['MANHOM']?>"><li><?php echo $row_kqsqlloaisp['TENNHOM']?></li></a>
														<?php
													}
													?>

												</ul>
											</center>
										</div>	
										<div class="clearfix"></div>
									</div>
								</ul>
							</li>
							<li class="">
								<a class="nav-stylehead" href="about.php">Giới thiệu</a>
							</li>
							
							<li class="">
								<a class="nav-stylehead" href="contact.php">Liên Hệ</a>
							</li>
	
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</div>
</div>
<!-- //navigation -->
<!-- banner -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">

	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1" class=""></li>
		<li data-target="#myCarousel" data-slide-to="2" class=""></li>
		<li data-target="#myCarousel" data-slide-to="3" class=""></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="item active">

		</div>
		<div class="item item2">

		</div>
		<div class="item item3">

		</div>
		<div class="item item4">
		</div>
	</div>
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<!-- //banner -->

<script>
    $(document).ready(function(){
      $(".dangnhap").click(function(){
        $("#modaldangnhap").modal("show");
      });
    });
</script>
<script>
    $(document).ready(function(){
      $("#dangky").click(function(){
            $("#modaldangky").modal("show");
      });
    });
</script>
<script>
    $(document).ready(function(){
      $("#giohang").click(function(){
            $("#modelgiohang").modal("show");
      });
    });
</script>
<script>
    $(document).ready(function(){
      $(".thongtintaikhoan").click(function(){
            $("#modalthongtintk").modal("show");
      });
    });
</script>
<script>
    $(document).ready(function(){
      $(".doimatkhau").click(function(){
            $("#modaldoimatkhau").modal("show");
      });
    });
</script>

<style>
    .clickdangnhap {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        height:10%;
        cursor: pointer;
        width: 100%;
      }
</style>

<!-- Form -->
<div id="modaldangnhap" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <form action="index.php?act=dangnhap" id="formDemo" method="POST">
            <div class="modal-body">
                <div class="form-group">
                  <label>Tài khoản</label>
                  <input class="form-control" name="username" type="text" placeholder ="Nhập tài khoản" required="">
                </div> 
                
                <div class="form-group">
                  <label>Mật khẩu</label>
                  <input class="form-control" name="password" type="password" placeholder="Nhập mật khẩu" required="">
                </div>
                
                <input type="submit" class="clickdangnhap" name="clickdangnhap" class="btn btn-primary " value="Đăng nhập">
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Nhớ tài khoản
                </label>
            </div>

            <div class="modal-footer">
                <button id="dongform" class="btn btn-danger " data-dismiss="modal">Trở về</button>
            </div>
        </form>
      </div>
  </div>
</div>
<!-- end form -->
   
<!-- Form 2 -->
<div id="modaldangky" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <form action="index.php?act=dangky" id="formDemo" method="POST">
            <div class="modal-body">
                <div class="form-group">
                  <label>Tài khoản</label>
                  <input class="form-control" name="username" type="text" placeholder ="Nhập tài khoản" required="">
                </div> 
                
                <div class="form-group">
                  <label>Mật khẩu</label>
                  <input class="form-control" name="password" type="password" placeholder="Nhập mật khẩu" required="">
                </div>
                
                <div class="form-group">
                  <label>Họ tên</label>
                  <input class="form-control" name="hoten" type="text" placeholder="Nhập họ tên" required="">
                </div>
                
                <div class="form-group">
                  <label>Địa chỉ</label>
                  <input class="form-control" name="diachi" type="text" placeholder="Nhập địa chỉ" required="">
                </div>
                
                <div class="form-group">
                  <label>Số điện thoại</label>
                  <input class="form-control" name="sodienthoai" type="text" placeholder="Nhập số điện thoại" required="">
                </div>
                
                <input type="submit" class="clickdangnhap" name="clickdanky" class="btn btn-primary " value="Đăng ký">
            </div>

            <div class="modal-footer">
                <button id="dongform" class="btn btn-danger " data-dismiss="modal">Trở về</button>
            </div>
        </form>
    </div>
    </div>     
</div>
<!-- End noi dung -->

<!-- Form 3 -->
<div id="modelgiohang" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="width:1210px;float: left;margin-left: -300px;">
        <form action="index.php?act=giodo" id="formDemo" method="POST">
            <div class="modal-body">
                <table id="cart" class="table table-hover table-condensed"> 
                    <thead> 
                        <tr> 
                            <th style="width:48%">Tên sản phẩm</th> 
                            <th style="width:10%">Giá</th> 
                            <th style="width:10%" class="text-center">Số lượng</th> 
                            <th style="width:22%" class="text-center">Thành tiền</th> 
                            <th style="width:5%">Trạng thái</th> 
                            <th style="width:5%"> </th> 
                        </tr> 
                    </thead> 
                    <tbody>
                        <?php 
                        $tongtien = 0;
                        while($row = mysqli_fetch_array($results_getDsDonDH)){ 
                            $gia = $row['GIA'] * $row['SOLUONG'];
                            $tongtien = $tongtien + $gia;
                            if ($row['TRANGTHAI'] == 0){
                                $trangthai = "Chờ duyệt";
                            } else if ($row['TRANGTHAI'] == 1){
                                $trangthai = "Duyệt (".$row['MSNV']. ")";
                            } else {
                                $trangthai = "Hủy (".$row['MSNV']. ")";
                            }
                        ?>
                        <tr>
                        
                            <td data-th="Product"> 
                                <div class="row"> 
                                    <div class="col-sm-2 hidden-xs">
                                        <img src="<?php echo $row['HINH']; ?>" width="90">
                                    </div> 
                                    <div class="col-sm-10"> 
                                        <h4 class="nomargin"><b><?php echo $row['TENHH']; ?></b></h4> 
                                        <p><span style="font-family: Time New Roman;font-size: 10px;font-weight: bold;"><?php echo $row['MOTAHH']; ?></span></p> 
                                    </div> 
                                </div> 
                            </td> 
                            <td data-th="Price" class="price ">
                                <?php echo $row['GIA']; ?>
                            </td> 
                            <td data-th="Quantity" class="text-center">
                                <?php echo $row['SOLUONG']; ?>
                                <!--<input class="form-control text-center" value="<?php echo $row['SOLUONG']; ?>" type="number">-->
                            </td> 
                            <td data-th="Subtotal" class="text-center price" >
                                 <?php echo $gia; ?>
                            </td> 
                            <td data-th="Product">
                                <?php echo $trangthai; ?>
                            </td>
                            <td class="actions" data-th="">
                                <?php if ($row['TRANGTHAI'] == 0) { ?>
                                
<!--                                    <button class="btn btn-danger btn-sm">
                                        
                                        <i class="fa fa-trash-o"></i>
                                        
                                    </button>-->
                                <a href="index.php?act=del&id=<?php echo $row['SODONDH']; ?>" >
                                    <input class="btn btn-danger btn-sm" type="button" value="X"/>
                                </a>
                               
                                <?php } ?>
                            </td> 
                        </tr> 
                        <?php } ?>
                        
                    </tbody>
                    
                    <tfoot> 
                        <tr> 
                            <td>
                                <span class="btn btn-warning" data-dismiss="modal">
                                    <i class="fa fa-angle-left" ></i> Tiếp tục mua hàng</span>
                            </td> 
                            
                            <td colspan="2" class="hidden-xs"> 
                            </td> 
                            <td class="hidden-xs text-center ">
                                <strong>Tổng tiền <span class="price"><?php echo $tongtien; ?></span></strong>
                            </td> 
<!--                            <td>
                                <a href="http://hocwebgiare.com/" class="btn btn-success btn-block">Đặt hàng <i class="fa fa-angle-right"></i></a>
                            </td> -->
                        </tr> 
                    </tfoot> 
                </table>
            </div>
        </form> 
        </div>
    </div>
</div>
<!-- End FORM -->

<!--modeldangky-->

<div id="modalthongtintk" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
    <!-- Modal content-->
    
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Thông tin tài khoản </h5>
         </div>
        <form action="index.php?act=capnhatthongtin" id="formDemo" method="POST">
            <div class="modal-body">
                <div class="form-group">
                  <label>Tài khoản</label>
                  <input class="form-control" name="username" type="text" placeholder ="Nhập tài khoản" disabled="">
                </div> 

                <div class="form-group">
                  <label>Họ tên</label>
                  <input class="form-control" name="hoten" type="text" value="<?php echo $_SESSION['HOTENKH'];?>" placeholder="Nhập họ tên" required="">
                </div>
                
                <div class="form-group">
                  <label>Địa chỉ</label>
                  <input class="form-control" name="diachi" type="text" value="<?php echo $_SESSION['DIACHI'];?>" placeholder="Nhập địa chỉ" required="">
                </div>
                
                <div class="form-group">
                  <label>Số điện thoại</label>
                  <input class="form-control" name="sodienthoai" type="text" value="<?php echo $_SESSION['SODIENTHOAI'];?>" placeholder="Nhập số điện thoại" required="">
                </div>
                
                <input type="submit" class="clickdangnhap" name="clickdanky" class="btn btn-primary " value="Cập nhật">
            </div>

            <div class="modal-footer">
                <button id="dongform" class="btn btn-danger " data-dismiss="modal">Trở về</button>
            </div>
        </form>
    </div>
    </div>     
</div>
<!--end-->
<div id="modaldoimatkhau" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title">From cập nhật mật khẩu </h5>
          <!--<button class="close" data-dismiss="modal">&times;</button>-->
        </div>
          <form  action="index.php?act=doimatkhau" method="POST">
            <div class="modal-body">
                    <div class="form-group">
                      <label>Mật khẩu cũ </label>
                      <input class="form-control" name="edit_matkhau_cu" type="password" placeholder ="Vui lòng nhập mật khẩu cũ" required="">
                      <input type="hidden" id="edit_id" name="edit_id" />
                    </div> 
                    <div class="form-group">
                      <label>Mật khẩu mới </label>
                      <input class="form-control" name="edit_matkhau_moi" type="password" placeholder ="Vui lòng nhập mật khẩu mới" required="">
                      <input type="hidden" id="edit_id" name="edit_id" />
                    </div> 
                    <div class="form-group">
                      <label>Nhập lại mật khẩu </label>
                      <input class="form-control" name="edit_matkhau_moi_2" type="password" placeholder ="Vui lòng nhập lại mật khẩu" required="">
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