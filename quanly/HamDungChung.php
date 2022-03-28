<?php
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
  
  
 function ChuyenTenThuTiengViet($thu){
    if($thu == 'Monday'){
        return "Mon";
    }else if($thu == 'Tuesday'){
        return "Tue";
    }else if($thu == 'Wednesday'){
        return "Web";
    }else if($thu == 'Thursday'){
        return "Thu";
    }else if($thu == 'Friday'){
        return "Fri";
    }else if($thu == 'Saturday'){
        return "Sat";
    }else {
        return "Sun";
    }
}
?>