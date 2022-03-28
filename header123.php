<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
else
{
	session_destroy();
	session_start(); 
}


function get_param($param_name){
	$param_value = "";
	if(isset($_POST[$param_name]))
		$param_value = $_POST[$param_name];
	else if(isset($_GET[$param_name]))
		$param_value = $_GET[$param_name];
	return trim($param_value);
}

function location($url){
	echo '<script type="text/javascript">window.location = "'. $url . '";</script>';
}


if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
		if (PHP_VERSION < 6) {
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		}

		$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

		switch ($theType) {
			case "text":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;    
			case "long":
			case "int":
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			break;
			case "double":
			$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
			break;
			case "date":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
			case "defined":
			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
			break;
		}
		return $theValue;
	}
}
?>



<?php
$catID = $_SESSION['ID_TK'];
$dbconn = mysqli_connect('localhost','root','','muabannongsan');
if(!$dbconn){
	echo "connect fail";
}
else{
	mysqli_set_charset($dbconn,'utf8');
}
?>



<?php
	// Loại sản phẩm
$sqlloaisp = "SELECT * FROM loai_sp";
$kqsqlloaisp = mysqli_query($dbconn,$sqlloaisp);
	// Địa phương
$sqldiaphuong = "SELECT * FROM dia_phuong";
$kqsqldiaphuong = mysqli_query($dbconn,$sqldiaphuong);
?>





<?php
if (isset($_SESSION['ID_TK']) && $_SESSION['ID_LOAI_TK'] == "2" && $_SESSION['KHOA'] == "1") {

	?>

<?php
	$sqldonhangdanhan = "SELECT COUNT(don_dathang.DH_ID) AS SLDH 
	FROM don_dathang 
	inner join san_pham ON don_dathang.SP_ID = san_pham.SP_ID
	WHERE san_pham.TK_ID = '$_SESSION[ID_TK]' ";
	// echo $sqldonhangdanhan;
	$KQsqldonhangdanhan = mysqli_query($dbconn,$sqldonhangdanhan);
	$row_KQsqldonhangdanhan = mysqli_fetch_array($KQsqldonhangdanhan);
?>



	<!DOCTYPE html>
	<html lang="zxx">

	<head>
		<title>Sàn giao dịch nông sản</title>
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

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js1/jquery.min.js"></script>
		<script src="comments/jquery-3.2.1.min.js"></script>

		


	</head>
	<body>
		<!-- header-bot-->
		<div class="header-bot">
			<div class="header-bot_inner_wthreeinfo_header_mid">
				<!-- header-bot-->
				<div class="col-md-4 logo_agile">
					<div class="col-md-6">
						<h1>
							<a href="index2.php">
								<span>S</span>àn <span>G</span>iao <span>D</span>ịch
								<h3>Nông sản</h3>
							</a>
						</h1>
					</br>
					<center>
						<i>Luôn đồng hành cùng với người nông dân</i>
					</center>
				</div>
				<div class="col-md-6">
					<img id="logobandua" src="images/logonongsan.jpg" alt="logo" width="140" height="140">
				</div>

			</div>
			<!-- header-bot -->
			<div id="search" class="col-md-8 header logo_agile">
				<!-- header lists -->

				<div id="hinhadmin">

					<div class="col-md-8">
						<div class="pull-left image">
						</div>
					</div>

					<div class="col-md-4" id="testmauanh">
						<div class="dropdown">
							<img id="logobandua" width="60" height="60" src="../../web/Login/images/<?php echo $_SESSION['HINH_ANH_TK'];?>" class="img-circle" alt="User Image">
							<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<b><?php echo $_SESSION['HO_TEN'];?></b>
								<span>
									(<?=$row_KQsqldonhangdanhan['SLDH']?>)
								</span>
							</button>
							<div class="dropdown-menu" id="dropdownaccount" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="../../quanlynhansu/danhsachtaikhoan.php?catID=<?php echo $_SESSION['ID_TK'];?>">
									<b>Quản lý tài khoản</b>
								</a>
								</br>
								</br>	
								<a class="dropdown-item" href="../../quanlynhansu/danhsachsanpham.php?catID=<?php echo $_SESSION['ID_TK'];?>&title=Danh sách sản phẩm">
								<b>Quản lý sản phẩm</b>
								</a>
								</br>
								</br>
								<a class="dropdown-item" href="../../quanlynhansu/donhangtiepnhan.php?catID=<?php echo $_SESSION['ID_TK'];?>&title=Đơn hàng tiếp nhận">
									<b>Đơn hàng tiếp nhận</b>
									<span>
										(<?=$row_KQsqldonhangdanhan['SLDH']?>)
									</span>
								</a>
								</br>
								</br>
								<a class="dropdown-item" href="login/logout.php"><b>Đăng xuất</b></a>
	</div>
</div>
</div>
</div>
</br>	
</br>	
</br>		

<!-- //header lists -->

<!-- search -->
<div class="agileits_search">
	<form action="timkiemsp.php" method="post">
		<input name="search" type="search" placeholder="Sản phẩm ...." required="">
		<button type="submit" class="btn btn-default" aria-label="Left Align">
			<span class="fa fa-search" aria-hidden="true"> </span>
		</button>
	</form>

</div>

<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
</div>


<!-- navigation -->
<div class="ban-top">
	<div class="container">

		<div class="agileits-navi_search">


			<nav class="navbar navbar-default">
				<div class="container-fluid">

					<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav menu__list" >
							<a href="../../quanlynhansu/dangsanpham.php?title=Đăng sản phẩm"  >
								<button id="btn-dangsp" class="btn btn-success">Đăng sản phẩm</button>
							</a>
						</ul>
					</div>
				</div>
			</nav>

		</div>

		<div class="top_nav_left">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav menu__list">
							<li class="active">
								<a class="nav-stylehead" href="index2.php">Trang chủ
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
													<?php
													while ($row_kqsqlloaisp = mysqli_fetch_array($kqsqlloaisp)) {
														?>
														<a href="indexloaisp.php?catIDloaiSP=<?php echo $row_kqsqlloaisp['LSP_ID']?>"><li><?php echo $row_kqsqlloaisp['LSP_TEN']?></li></a>
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
							<li class="">
								<a class="nav-stylehead" href="sanphamdadat.php">
									Sản phẩm đã đặt
								</a>
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

<?php
}else{
	echo "<script> alert('Tài khoản của bạn bị khóa.') </script>";
	$url = "http://localhost:8080/web/Login/index.php";
	location($url);
	exit;
	// header('location: http://localhost:8080/web/Login/index.php');
}
?>