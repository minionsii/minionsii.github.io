

<?php 

if (isset($_POST["btn_submit"])) {
	// lấy thông tin người dùng
	$username = $_POST["username"];
	$password = $_POST["password"];
	//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
	//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
	$username = strip_tags($username);
	$username = addslashes($username);
	$password = strip_tags($password);
	$password = addslashes($password);
	if ($username == "" || $password =="") {
		
		alert("username hoặc password bạn không được để trống!");
	}else{
		
		$sql = "SELECT * from account where username = '$username' and password = '$password' ";

		$query = mysqli_query($dbconn,$sql);
		$num_rows = mysqli_num_rows($query);
		if ($num_rows == 0) {
			alert("username hoặc password bạn không đúng !");
		}else{
			// Lấy ra thông tin người dùng và lưu vào session
			while ( $data = mysqli_fetch_array($query) ) {
	    		$_SESSION["user_id"] = $data["id"];
				$_SESSION['username'] = $data["username"];
				// $_SESSION["email"] = $data["email"];
				// $_SESSION["fullname"] = $data["fullname"];
				// $_SESSION["is_block"] = $data["is_block"];
				// $_SESSION["permision"] = $data["permision"];
	    	}
			
                // Thực thi hành động sau khi lưu thông tin vào session
                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
			header('Location: dangsp.html');
		}
		exit;
	}
}
?>
	