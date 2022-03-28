<?php 
	//file chứa ha
	$file_path = "../../quanlynhansu/danghinhanh/";
	//lay ra su dung
	$file_path = $file_path.basename($_FILES['uploaded_file']['name']);
	// luu file tam thoi tmp_name
	if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)){
		echo $_FILES['uploaded_file']['name'];
	}else{
		echo "Failed";
	}

?>