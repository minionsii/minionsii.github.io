
<?php
session_start();
include('../connection.php');
?>

<?php


if(isset($_REQUEST['submit'])){
	$username = $_REQUEST["username"];
	$password = md5($_REQUEST["password"]);

	if (empty($username) or empty($password)) {
		echo" <script> alert('username hoặc password bạn không được để trống!') </script>";
	}else{
		$sql = "SELECT * from tai_khoan where TK_ID = '$username' and TK_MATKHAU = '$password' ";
		$query = mysqli_query($dbconn,$sql);
		$num_rows = mysqli_num_rows($query);
		
		if ($num_rows<>0)
		{	
			while ( $data = mysqli_fetch_array($query) ) {
				$_SESSION['ID_TK'] 		   = $data["TK_ID"];
				$_SESSION['ID_LOAI_TK']	   = $data["LTK_ID"];
				$_SESSION["HO_TEN"] 	   = $data["TK_HOTEN"];
				$_SESSION["GIOI_TINH"] 	   = $data["TK_GOITINH"];
				$_SESSION["CMND"] 		   = $data["TK_CMND"];
				$_SESSION["DIA_CHI"] 	   = $data["DP_ID"];
				$_SESSION["SO_DIEN_THOAI"] = $data["TK_SDT"];
				$_SESSION["EMAIL"] 		   = $data["TK_EMAIL"];
				$_SESSION["NGAY_THAM_GIA"] = $data["TK_NGAYTAO"];
				$_SESSION["KHOA"]		   = $data["TK_KHOA"];
				$_SESSION["HINH_ANH_TK"]   = $data["TK_HA"];
			}

	                // Thực thi hành động sau khi lưu thông tin vào session
	                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
	                
	        if($_SESSION["ID_LOAI_TK"] == 1){
	        	header('Location: http://localhost:8080/quanlynhansu2/danhsachtaikhoan.php?title=Danh sách tài khoản');
	        }else{
	        	header('Location: ../index2.php');
	        }
			
		}
		else{
			echo" <script> alert('username hoặc password bạn không đúng') </script>";
		}
	}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> -->

	<link rel="icon" type="image/png" href="images/nguoiquanly_truong.jpg" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">


	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="http://localhost:8080/web/login/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form">
					<span class="login100-form-title">
						Đăng Nhập
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input class="btn btn-success"  name="submit" type="submit" value="Đăng nhập" />
						&nbsp;
						<a href="index2.php">

							<p class="btn btn-success">Đăng ký</p>
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>
	
	

	
	<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>