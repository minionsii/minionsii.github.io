<?php  require_once('include/get_param.php');?>
<?php
  // $quanlynhansu = "quanlynhansu";
  $dbconnect = mysqli_connect('localhost','root','','quanlynhansu');
  if(!$dbconnect){
    echo "connect fail";
  }
  else{
    mysqli_set_charset($dbconnect,'utf8');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="images/nguoiquanly_truong.jpg" />
  <title>Admin</title>
  <!-- Bootstrap core CSS-->
  

  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="datatables/css/dataTables.bootstrap.css">
  <link rel="stylesheet" href="datatables/css/jquery.dataTables.css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="metisMenu.min.css">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
 <!--  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> -->
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  

  
  



  <link rel="stylesheet" type="text/css" href="css_truong/css_admin.css">
  
  <link rel="stylesheet" type="text/css" href="css_truong/css_truong.css">

<!-- 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="js1/jquery.min.js"></script>
 <!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

  <link rel="stylesheet" type="text/css" href="bootstrap-3/css/bootstrap.css">

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">WEBSITE QUẢN LÝ NHÂN VIÊN - CHUYÊN MÔN</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Admin</span>
          </a>
        </li>
<!--         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="charts.html">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Charts</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="tables.html">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Tables</span>
          </a>
        </li> -->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Nhân viên">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Nhân Viên</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              
              <a href="nhanvien.php">Hồ sơ nhân viên</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_quoctich&title=Quốc tịch&column=quoc_tich&action=new">Quốc tịch</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_tinhthanh&title=Tỉnh thành&column=tinh_thanh&action=new">Tỉnh thành</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_tongiao&title=Tôn giáo&column=ton_giao&action=new">Tôn giáo</a>
            </li>
            <!-- <li>
              <a href="cards.html">Cards</a>
            </li> -->
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Danh mục 1">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Danh Mục 1</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="them_danh_muc.php?bang=tlb_tablecap&title=Bằng cấp&column=table_cap&action=new"?>Chuyên môn/bằng cấp</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_chucvu&title=Chức vụ&column=chuc_vu&action=new">Chức vụ</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_phongban&title=Phòng ban&column=phong_ban&action=new">Phòng ban</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_ctcongviec&title=Công việc&column=cong_viec&action=new">Công việc</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_dantoc&title=Dân tộc&column=dan_toc&action=new">Dân tộc</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_hopdong&title=Hợp đồng&column=loai_hop_dong&action=new">Hợp đồng</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Danh mục 2">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Danh Mục 2</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="them_danh_muc.php?bang=tlb_hinhanh&title=Hình ảnh&column=hinh_anh&action=new">Hình ảnh</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_hocvan&title=Học vấn&column=hoc_van&action=new">Học vấn</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_ngoaingu&title=Ngoại ngữ&column=ngoai_ngu&action=new">Ngoại ngữ</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_tinhoc&title=Tin học&column=tin_hoc&action=new">Tin học</a>
            </li>
            
            <li>
              <a href="them_danh_muc.php?bang=tlb_quatrinhluong&title=Qúa trình tăng lương&column=qua_trinh_tang_luong&action=new">Quá trình tăng lương</a>
            </li>
            <li>
              <a href="them_danh_muc.php?bang=tlb_quatrinhcongtac&title=Qúa trình công tác&column=qua_trinh_cong_tac&action=new">Quá trình công tác</a>
            </li>
            
          </ul>
        </li>
        
        <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
          </a>
        </li> -->
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <?php
      //     $require = get_param('require');
      // if($require ==""){$require = "them_danh_muc.php";}
      //     require_once $require;
           ?>



   