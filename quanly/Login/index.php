
<?php
include('../session.php');
include('../config.php');
?>

<?php

if(isset($_REQUEST['submit'])){

	$username = $_REQUEST["username"];
	$password = md5($_REQUEST["password"]);

	if (empty($username) or empty($password)) {
		echo" <script> alert('username hoặc password bạn không được để trống!') </script>";
	}else{
		$sql = "SELECT * from nhanvien where MSNV = '$username' and F_MATKHAU = '$password' ";
                
		$query = mysqli_query($dbconn,$sql);
		$num_rows = mysqli_num_rows($query);

		if ($num_rows<>0)
		{	
                    
			while ( $data = mysqli_fetch_array($query) ) {
				$_SESSION['MSNV']          = $data["MSNV"];
				$_SESSION['HOTENNV']	   = $data["HOTENNV"];
				$_SESSION["F_MATKHAU"] 	   = $data["F_MATKHAU"];
				$_SESSION["CHUCVU"] 	   = $data["CHUCVU"];
				$_SESSION["DIACHI"]        = $data["DIACHI"];
				$_SESSION["SODIENTHOAI"]   = $data["SODIENTHOAI"];

	
			}
	                // Thực thi hành động sau khi lưu thông tin vào session
                            header('Location: ../quanlynguoidung.php');
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
					<img src="images/img-01.png" alt="IMG">
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
<!--						<a href="index2.php">

							<p class="btn btn-success">Đăng ký</p>
						</a>-->
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