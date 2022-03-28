<?php
$dbconn = mysqli_connect("localhost","root","","muabannongsan");
if(!$dbconn){
	echo "connect fail";
}
else{
	mysqli_set_charset($dbconn,'utf8');
}
?>