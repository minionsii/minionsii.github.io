<?php
    include "config.php";
    include "session.php";
    include "HamDungChung.php";
?>

<?php
if (isset($_SESSION['MSNV'])) {

  ?>

  <?php
  //dem dssp cho duyet
//  $sqlchoduyet = "SELECT COUNT(SP_ID) AS SLSPCD FROM san_pham WHERE TT_ID = 3";
//  $kqsqlchoduyet = mysqli_query($dbconn,$sqlchoduyet);
//  $row_kqsqlchoduyet = mysqli_fetch_assoc($kqsqlchoduyet);

  
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản trị</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">



    <link rel="icon" type="image/png" href="images/nguoiquanly_truong.jpg" />
    <link rel="stylesheet" href="bootstrap1/css/bootstrap.min.css">


    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="datatables/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="datatables/css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="datatables/css/jquery.dataTables.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">



    <link rel="stylesheet" href="Admin2/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="Admin2/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="Admin2/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="Admin2/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="Admin2/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="Admin2/plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="Admin2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">




    <link rel="stylesheet" type="text/css" href="css_truong/css_truong.css">


    <link rel='stylesheet prefetch' href='jqueryvalidation/dist/bootstrapValidator.min.css'>
    <script src="js1/jquery.min.js"></script>

    



    <style type="text/css">
      div.dataTables_wrapper {
        margin-bottom: 3em;
      }
    </style>


  </head>
  <body  class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header  class="main-header">
        <!-- Logo -->
        <a href="nhanvien.php?title=Quản lý người dùng" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>AD</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Trang quản trị</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav  class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!--user -->
              <li class="dropdown user user-menu">

                <a >
                  <div class="text-center">
                    <span>
                      <small> Cần Thơ, <?php echo Date("l F d, Y"); ?></small> 

                    </span>

                  </div>

                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- end head -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left ">
                <img src="Login/images/nguoiquanly_truong.jpg" width="55" height="60" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><b><?php echo $_SESSION['MSNV'];?></b></p>
              <a href="login/logout.php"><button class="btn btn-danger">Đăng xuất</button></a>
            </div>
          </div>
        </br>
        
        <ul class="sidebar-menu">
      
            <li class="header" style="color:white;font-size: 15px;"><b>QUẢN LÝ NGƯỜI DÙNG</b></li>
            <li>
                <a href="quanlynguoidung.php"> <i class="fa fa-table"></i> <span>Quản lý nhân viên</span></a>
            </li>
            <li>
                <a href="quanlykhachhang.php"> <i class="fa fa-table"></i> <span>Quản lý khách hàng</span></a>
            </li>

         <li class="header" style="color:white;font-size: 15px;"><b>QUẢN LÝ HÀNG HÓA</b></li>
          <li>
            <a href="danhsachloaihanghoa.php">
              <i class="fa fa-table"></i> <span>Danh sách loại hàng hóa</span>&nbsp;<i style="color: red;"></i>
            </a>
          </li>
          
          <li>
              <a href="danhsachhanghoa.php">
              <i class="fa fa-table"></i> <span>Danh sách hàng hóa</span>&nbsp;<i style="color: red;"></i>
            </a>
          </li>
          <li>
              <a href="quanlydonhang.php">
              <i class="fa fa-table"></i> <span>Đơn hàng</span>&nbsp;<i style="color: red;"></i>
            </a>
          </li>
        </ul>
      </section>
  

      <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
      <?php
    }else{
      header('location: Login/index.php');
    }
    ?>