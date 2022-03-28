<?php 

include ("../danghinhanh/connect.php");

         $catIDSPXOA = $_REQUEST['catIDSPXOA'];
         $queryktddh = "SELECT * FROM don_dathang WHERE SP_ID = '$catIDSPXOA' ";
         if (mysqli_num_rows(mysqli_query($dbconn,$queryktddh)) > 0) {
                echo "Không thể xóa sản phẩm này, do sản phẩm đã có người đặt";
         }else{
                $sqlxoabl = "DELETE FROM binh_luan WHERE SP_ID = '$catIDSPXOA'";
                $sqlxoadgsp = "DELETE FROM danh_gia_sp WHERE SP_ID = '$catIDSPXOA'";
                $sqlxoapdg = "DELETE FROM phieu_danh_gia WHERE SP_ID = '$catIDSPXOA'";
                $sqlxoaha = "DELETE FROM hinh_anh_sp WHERE SP_ID = '$catIDSPXOA'";
                $sqlxoqtpt = "DELETE FROM qua_trinh_phat_trien WHERE SP_ID = '$catIDSPXOA'";
                $sqlxoasp = "DELETE FROM san_pham WHERE SP_ID = '$catIDSPXOA'";
                $resultxoapdg    = mysqli_query($dbconn,$sqlxoapdg);
                $resultxoabl    = mysqli_query($dbconn,$sqlxoabl);
                $resultxoadgsp  = mysqli_query($dbconn,$sqlxoadgsp);
                $resultqtpt = mysqli_query($dbconn,$sqlxoqtpt);
                $resultha   = mysqli_query($dbconn,$sqlxoaha);
                $resultsp   = mysqli_query($dbconn,$sqlxoasp);
                if($resultsp){
                  echo "Sản phẩm đã bị xóa";  
                }else{
                  echo "SQL sai";
                }
          }
          // $url = "../danhsachsanpham.php?title=Danh sách sản phẩm";
          // location($url);

?>