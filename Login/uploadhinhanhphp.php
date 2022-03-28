<?php 
	//file chứa ha
	$file_path = "images/";
	//lay ra su dung
	$file_path = $file_path.basename($_FILES['uploaded_flie']['name']);
	// luu file tam thoi tmp_name
	if(move_uploaded_file($_FILES['uploaded_flie']['tmp_name'], $file_path)){
		echo $_FILES['uploaded_flie']['name'];
	}else{
		echo "Failed";
	}

?>