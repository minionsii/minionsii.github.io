<?php

//$dbconn = mysqli_connect('localhost','root','','muabannongsan');
$dbconn = mysqli_connect('localhost','root','','webbanhang');
if(!$dbconn){
  echo "connect fail";
}
else{
  mysqli_set_charset($dbconn,'utf8');
}
?>