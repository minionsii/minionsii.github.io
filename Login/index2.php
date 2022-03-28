
<?php
session_start();
include('../connection.php');
?>

<?php


if(isset($_REQUEST['submit'])){
	$hinh_anh_tk = $_REQUEST["hinh_anh_tk"];
	$username = $_REQUEST["username"];
	$password = md5($_REQUEST["password"]);
	$password2 = md5($_REQUEST["password2"]);
	$hoten = $_REQUEST["hoten"];
	$gioitinh = $_REQUEST["gioitinh"];
	$cmnd = $_REQUEST["cmnd"];
	$diachi = $_REQUEST["diachi"];
	$sodienthoai = $_REQUEST["sodienthoai"];
	$email = $_REQUEST["email"];
	$khoa = "1";
	$id_loai_tk = "2";

	if (empty($username) or empty($password) or empty($password2)) {
		echo" <script> alert('bạn không được phép để trống!') </script>";
	}else{
		if($password == $password2){
			if(mysqli_num_rows(mysqli_query($dbconn,"SELECT * from tai_khoan where TK_ID = '$username' ")) > 0){
				echo" <script> alert('Tài khoản đã tồn tại!') </script>";
			}else{
				$sql = "
				INSERT INTO tai_khoan (TK_ID , LTK_ID , TK_MATKHAU, TK_HOTEN , TK_GOITINH , TK_CMND ,
				DP_ID , TK_SDT , TK_EMAIL , TK_NGAYTAO , TK_KHOA , TK_HA)
				VALUE ('{$username}','{$id_loai_tk}','{$password}','{$hoten}','{$gioitinh}',
				'{$cmnd}','{$diachi}','{$sodienthoai}','{$email}',now(),'{$khoa}','$hinh_anh_tk')";
				echo $sql;
				$query = mysqli_query($dbconn,$sql);
				
				if ($query)
				{	
					echo " <script> alert('Đăng ký thành công') </script>";
				}
				else{
					echo " <script> alert('SQL sai') </script>";
				}

			}

		}else{
			echo" <script> alert('password hoặc confirm password bạn không khớp. Vui lòng nhập lại') </script>";
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

				<div class="">
					<button onclick="chonanh()" class="validate-input">
						<img src="images/anhdaidien.png" alt="IMG">
					</button>
					
				</div>
				<form class="login100-form validate-form">
					<div style="display: none;">
						<input id="chonanhtk" type="file" name="hinh_anh_tk">
					</div>
					<span class="login100-form-title">
						Đăng Ký
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Vui lòng điền tên tài khoản">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Vui lòng điền mật khẩu">
						<input class="input100" type="password" name="password" placeholder="Password" required="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Vui lòng nhập lại mật khẩu">
						<input class="input100" type="password" name="password2" placeholder="Confirm Password" required="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="hoten" placeholder="Họ tên">
						
						<span class="symbol-input100">
							<i class="fa fa-user-circle-o" ></i>
						</span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Vui lòng điền vào trường này">
						<center>
							<input type="radio" name="gioitinh" value="1" checked="checked" />Nam
							&nbsp;
							<input type="radio" name="gioitinh" value="0" />Nữ
						</center>

					</div>

					<div class="wrap-input100 validate-input" data-validate = "Vui lòng điền vào trường này">
						<input class="input100" type="text" name="cmnd" placeholder="Chứng minh nhân dân">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-address-book" aria-hidden="true"></i>
						</span>
					</div>
					
					

					<div class="wrap-input100 validate-input" data-validate = "Vui lòng điền vào trường này">
						<select name="diachi" class="form-control input100 " >
							<?php
							$sqldiaphuong = "SELECT * FROM dia_phuong";
							$resultsdp = mysqli_query($dbconn,$sqldiaphuong) ;
							while($row = mysqli_fetch_array($resultsdp)){ 
							?>
								<option value="<?php echo $row[0];?>"><?php echo $row[1]; ?></option>
							<?php
							}
							?>
						</select>
						<!-- <input class="input100" type="text" name="diachi" placeholder="Địa chỉ">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-address-card" aria-hidden="true"></i>
						</span> -->
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Vui lòng điền vào trường này">
						<input class="input100" type="text" name="sodienthoai" placeholder="Số điện thoại">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 " data-validate = "Email có dạng ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>
						</span>
					</div>
					
					

					<div class="container-login100-form-btn">
						<a href="index.php">
							<p class="btn btn-success">Đăng nhập</p>
						</a>
						&nbsp;
						<input class="btn btn-success"  name="submit" type="submit" value="Đăng ký" />
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
	
	<script>
		function chonanh(){
			$('#chonanhtk').click();
		}
	</script>
</body>
</html>