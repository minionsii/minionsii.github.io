<?php include("header.php") ?>


<?php
$catID = $_SESSION['ID_TK'];
$title = get_param('title');



// show danh sách sản phẩm đã gửi theo tk
$sqldagui =" SELECT hinh_anh_sp.HA_URL, don_vi_tinh.DVT_NHOM,don_vi_tinh.DVT_TEN,don_vi_tinh.DVT_TRISO,don_dathang.DH_ID,san_pham.SP_TEN,san_pham.TK_ID,san_pham.SP_ID,don_dathang.DH_NGAYTAO,don_dathang.TT_ID,tinh_trang.TT_TEN,don_dathang.DH_SANLUONG,don_dathang.DH_DONGIA,tai_khoan.TK_HOTEN,tai_khoan.TK_SDT FROM don_dathang 
inner join tinh_trang on tinh_trang.TT_ID = don_dathang.TT_ID 
inner join don_vi_tinh on don_vi_tinh.DVT_ID = don_dathang.DVT_ID 
inner join san_pham on san_pham.SP_ID = don_dathang.SP_ID 
inner JOIN hinh_anh_sp ON san_pham.SP_ID = hinh_anh_sp.SP_ID
inner join tai_khoan on san_pham.TK_ID = tai_khoan.TK_ID
WHERE don_dathang.TK_ID ='$catID'and hinh_anh_sp.HA_MAT_DINH = 1 ORDER BY don_dathang.DH_NGAYTAO DESC ";
$resultsdagui = mysqli_query($dbconn,$sqldagui);
// ECHO $sqldagui;




?>
<?php
if(isset($_REQUEST['act'])){
	$act = $_REQUEST['act'];
	switch ($act){
		case 'trangthaituchoi':
		{
			$ID_DH = $_REQUEST['ID_DH'];
			$sqltuchoi = "UPDATE don_dathang set TT_ID ='8' WHERE DH_ID='$ID_DH' ";
			$resultsqltuchoi=mysqli_query($dbconn,$sqltuchoi) or die("QUERY {$sql} \n <br/> Mysql error: ".mysqli_error($dbconn));

			if($resultsqltuchoi){
				echo "<script> alert('Đơn hàng bị hủy') </script>";
				$url = "sanphamdadat.php";
				location($url);
				exit;
			}else{
				echo "<script> alert('SQL sai') </script>";
			}
			break;
		}

		case 'vietdanhgia':{
			$ID_TK = $_SESSION['ID_TK'];
			$idsp = $_REQUEST['idsp'];
			$idnguoi = $_REQUEST['idnguoi'];
			$rating = $_REQUEST['rating'];
			$noi_dung_dg = $_REQUEST['noi_dung_dg'];
			$vai_tro_dg = $_REQUEST['vai_tro_dg'];
			if($vai_tro_dg == "Người mua đánh giá người bán"){
				$vai_tro_dg = "0";
			}else if($vai_tro_dg == "Người bán đánh giá người mua"){
				$vai_tro_dg = "1";
			}
			$kqshowpdg = mysqli_query($dbconn,"SELECT * from phieu_danh_gia where TK_ID = '$ID_TK' AND SP_ID = '$idsp' ");
			if(mysqli_num_rows($kqshowpdg) > 0){
				$row = mysqli_fetch_array($kqshowpdg);
				$sqlupdatedanhgia= "UPDATE phieu_danh_gia SET PDG_DIEM = '$rating',PDG_NOIDUNG = '$noi_dung_dg'  WHERE PDG_ID = '$row[PDG_ID]' ";
				$kqsqlupdatedanhgia = mysqli_query($dbconn,$sqlupdatedanhgia);
				if($kqsqlupdatedanhgia){
					echo "<script> alert('Cập nhật thành công') </script>";
					$url = "sanphamdadat.php";
					location($url);
					exit;
				}else{
					echo "<script> alert('SQL sai') </script>";
				}


			}else{
				$sqldanhgia = "INSERT INTO phieu_danh_gia(SP_ID,TK_ID,ID_TK_DUOC_DG,PDG_DIEM,PDG_NOIDUNG,PDG_VAITRO) 
				values( '$idsp','{$ID_TK}','{$idnguoi}','{$rating}','{$noi_dung_dg}','{$vai_tro_dg}') ";
				$resultsqldanhgia=mysqli_query($dbconn,$sqldanhgia) or die("QUERY {$sql} \n <br/> Mysql error: ".mysqli_error($dbconn));

				if($resultsqldanhgia){
					echo "<script> alert('Đánh giá thành công') </script>";
					$url = "sanphamdadat.php";
					location($url);
					exit;
				}else{
					echo "<script> alert('SQL sai') </script>";
				}
			}

			
			break;
		}
		default:{}
		break;
	}
}
?>







<!-- page -->
<div class="services-breadcrumb">
	<div class="agile_inner_breadcrumb">
		<div class="container">
			<ul class="w3_short">
				<li>
					<a href="index2.php">Trang chủ</a>
					<i>|</i>
				</li>
				<li>Sản phẩm đã đặt</li>
			</ul>
		</div>
	</div>
</div>
<!-- //page -->
<!-- contact page -->
<div class="contact-w3l">
	<div class="container">
		<div class="example">
			<div class="container">
				<div class="row">
					<h3 class="tittle-w3l">Danh sách sản phẩm nông sản đã đặt
						<span class="heading-style">
							<i></i>
							<i></i>
							<i></i>
						</span>
					</h3>
					
					<table class="table table-striped" border="0">
						<thead>
							<tr>
								<th>Mã đh</th>
								<th>Sản phẩm</th>
								<th>Trạng thái</th>
								<th>Số lượng đặt</th>
								<th>Đơn giá</th>
								<th>Thành tiền</th>
								<th>Người nhận</th>
								<th>Điện thoại</th>
								<th>Tác vụ</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($row = mysqli_fetch_array($resultsdagui)) {
								?>
								<tr>
									<td>
										<?php echo $row['DH_ID']; ?>
									</td>
									<td id="testmautable">
										<div class="col-md-4">
											<img src="../../quanlynhansu/danghinhanh/<?php echo $row["HA_URL"];?>" id="hinhanhtrongban">
										</div>
										<div class="col-md-8">
											<p><a href=""><span class="sanphamtable"><?php echo $row["SP_TEN"];?></span></a></p>
											<p><span><i>Ngày gửi: <?php echo $row["DH_NGAYTAO"];?></i></span></p>
										</div>
									</td>
									<td>
										<?php 
										if($row["TT_ID"] == '6'){
											?>
											<p><span class="trangthaichoxuly"><?php echo $row["TT_TEN"];?></span></p>
											<?php
										}else if($row["TT_ID"] == '7'){
											?>
											<p><span class="trangthaidongy"><?php echo $row["TT_TEN"];?></span></p>
											<?php
										}else if($row["TT_ID"] == '8'){
											?>
											<p><span class="trangthaidahuy"><?php echo $row["TT_TEN"];?></span></p>
											<?php
										}else if($row["TT_ID"] == '9'){
											?>
											<p><span class="trangthaidongy"><?php echo $row["TT_TEN"];?></span></p>
											<?php
										}
										?>           

									</td>
									<td>
										<?php echo $row["DH_SANLUONG"]; ?>
										<?php echo $row["DVT_TEN"]; ?>
									</td>
									<td>
										<p>
											<?php 
											echo $row['DH_DONGIA']; 
											if($row['DVT_NHOM'] == 1)
											{
												echo "/KG";
											}else{
												echo "/Trái";
											}
											?>

										</p>
									</td>
									<td>
										<?php 
										$triso = $row["DVT_TRISO"];
										$sanluong = $row["DH_SANLUONG"];
										$dongia = $row["DH_DONGIA"];
										$thanhtien = $sanluong * $dongia * $triso;
										echo $thanhtien;
										?>
									</td>
									<td>
										<?php echo $row['TK_HOTEN']; ?>
									</td>
									<td>
										<?php echo $row['TK_SDT']; ?>
									</td>
									<td>
										<?php
										if(($row["TT_ID"] == '6') OR ($row["TT_ID"] == '7')){
											?>
											<button class="trangthaidahuy"><a href="sanphamdadat.php?act=trangthaituchoi&ID_DH=<?php echo $row['DH_ID']?>" style="color: white;">Hủy</a></button>
											<?php
										}else if(($row["TT_ID"] == '9') OR ($row["TT_ID"] == '8')){
											?>
											<button class="trangthaichoxuly vietdanhgia" tennguoidung="<?php echo $row['TK_HOTEN']; ?>" idnguoidcdg="<?php echo $row['TK_ID']; ?>" idsp1="<?php echo $row["SP_ID"];?>">Đánh giá</button>
											<?php
										}
										?>
									</td>
								</tr>
								<?php
							}
							?>
							<script>
								$(document).ready(function(){
									$(".vietdanhgia").click(function(){
										var tennd    = $(this).attr('tennguoidung');
										var idsp    = $(this).attr('idsp1');
										var idnguoi = $(this).attr('idnguoidcdg');
										$('#tennd').val(tennd);
										$('#idnguoi').val(idnguoi);
										$('#idsp').val(idsp);
										$("#myModal1").modal("show");
									});
								});
							</script>

						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="myModal1" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">


			<form action="sanphamdadat.php?act=vietdanhgia" id="" method="POST">
				<div class="modal-header">
					<center><h5 class="modal-title">Đánh giá người dùng</h5></center>
					<button class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idsp" id="idsp" value="">
					<input type="hidden" name="idnguoi" id="idnguoi" value="">
					<label>Người dùng</label>
					<input class="form-control" type="" name="tennd" id="tennd" value="" disabled="">

					<label>Số điểm</label>
					<div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" >
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1" checked="">
							<label for="rating1">1</label>
						</span>
					</div>  

					<label>Nội dung</label>
					<input class="form-control" name="noi_dung_dg" type="text" placeholder="Nội dung" >

					<label>Vai trò</label>
					<input class="form-control" name="vai_tro_dg" type="text" value="<?php echo 'Người mua đánh giá người bán';?>" readonly="" >
				</div>

				<div class="modal-footer">
					<button name="submit_qtpt" class="btn btn-primary">Xác nhận</button>
					<button id="dongform" class="btn btn-danger " data-dismiss="modal">Hủy</button>
				</div>
			</form>
		</div>

	</div>
</div>



<!-- newsletter -->

<?php include("footer.php")?>