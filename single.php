
<?php include("header.php") ?>



<?php
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
$catIDSP   = $_REQUEST['catIDSP'];
$ID_TK_SP  = $_REQUEST['ID_TK_SP'];

$query_RChinhanh_sp = "SELECT * FROM hinh_anh_sp where SP_ID='$catIDSP'";
$RChinhanh_sp = mysqli_query($dbconn,$query_RChinhanh_sp) ;

$query_RCsanpham = "SELECT * FROM san_pham 
inner join tinh_trang on san_pham.TT_ID = tinh_trang.TT_ID 
inner join loai_sp on loai_sp.LSP_ID = san_pham.LSP_ID 
inner join don_vi_tinh on don_vi_tinh.DVT_ID = san_pham.DVT_ID 
inner join tai_khoan on tai_khoan.TK_ID = san_pham.TK_ID
inner join dia_phuong on dia_phuong.DP_ID = dia_phuong.DP_ID
inner join hinh_anh_sp on hinh_anh_sp.SP_ID = san_pham.SP_ID
where san_pham.SP_ID = '$catIDSP'";
$RCtlb_sanpham = mysqli_query($dbconn,$query_RCsanpham);
$row_RCtlb_sanpham = mysqli_fetch_array($RCtlb_sanpham);


//bien xac dinh san pham cung loai
$sanphamcungloai =  $row_RCtlb_sanpham['LSP_ID'];

$query_RCctcongviec = "SELECT * FROM san_pham 
inner join tinh_trang on san_pham.TT_ID = tinh_trang.TT_ID
inner join don_vi_tinh on don_vi_tinh.DVT_ID = san_pham.DVT_ID 
inner join hinh_anh_sp on hinh_anh_sp.SP_ID = san_pham.SP_ID
WHERE san_pham.LSP_ID = '$sanphamcungloai' AND hinh_anh_sp.HA_MAT_DINH = 1 AND ((san_pham.TT_ID = 1) or (san_pham.TT_ID = 2))";

$RCctcongviec = mysqli_query($dbconn,$query_RCctcongviec) ;
// $row_RCctcongviec = mysqli_fetch_assoc($RCctcongviec); // ham loai bo 1 dong dau tien 



$query_RCtinhtrang = "SELECT * FROM tinh_trang WHERE TT_NHOM = '1'";
$RCtinhtrang = mysqli_query($dbconn,$query_RCtinhtrang) ;
$row_RCtinhtrang = mysqli_fetch_assoc($RCtinhtrang);

$sql = "SELECT * FROM qua_trinh_phat_trien WHERE SP_ID='$catIDSP'";
$kq_qtpt = mysqli_query($dbconn,$sql);


?>

<?php 
if(isset($_REQUEST['act'])){
	$act = $_REQUEST['act'];
	switch ($act){
		case 'datmuasp':{
			$catIDSP		    = $_REQUEST['catIDSP'];
			$ID_TK_SP		    = $_REQUEST['ID_TK_SP'];
			$ID_TK			    = $_SESSION['ID_TK'];
			$dathang_tinh_trang = '6';
			$don_gia_can_mua	= $_REQUEST['don_gia_can_mua'];
			$so_luong_can_mua	= $_REQUEST['so_luong_can_mua'];
			$dat_don_vi_tinh	= $_REQUEST['dat_don_vi_tinh'];
			$dat_ghi_chu		= $_REQUEST['dat_ghi_chu'];
			if (!empty($so_luong_can_mua) ){
				$sqldangsp = "INSERT INTO 
				don_dathang(TT_ID, TK_ID, SP_ID, DVT_ID, DH_SANLUONG, DH_DONGIA, DH_NGAYTAO, DH_GHICHU) 
				VALUES ('$dathang_tinh_trang','$ID_TK','$catIDSP','$dat_don_vi_tinh','$so_luong_can_mua','$don_gia_can_mua',now(),'$dat_ghi_chu')";
			// echo $sqldangsp;

				$resultdatsp=mysqli_query($dbconn,$sqldangsp);

				if($resultdatsp){
					echo "<script> alert('Bạn đã đặt hàng thành công') </script>";

					$url = "single.php?catIDSP=$catIDSP&ID_TK_SP=$ID_TK_SP";
					location($url);
					exit();
				}else{
					echo "<script> alert('SQL sai') </script>";
				}
			}else{
				echo "<script> alert('Bạn chưa nhập số lượng') </script>";
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
				<li>Thông tin chi tiết về sản phẩm</li>
			</ul>
		</div>
	</div>
</div>
<!-- //page -->
<!-- Single Page -->
<div class="banner-bootom-w3-agileits">
	<div class="container">
		<!-- tittle heading -->
		<h3 class="tittle-w3l">Thông tin chi tiết về sản phẩm
			<span class="heading-style">
				<i></i>
				<i></i>
				<i></i>
			</span>
		</h3>
		<!-- //tittle heading -->
		<div class="col-md-5 single-right-left ">
			<div class="grid images_3_of_2">
				<div class="flexslider">
					<ul class="slides">
						<?php 
						while ($row_RChinhanh_sp = mysqli_fetch_array($RChinhanh_sp)) {
							?>
							<li data-thumb="../../quanlynhansu/danghinhanh/<?php echo $row_RChinhanh_sp['HA_URL'];?>">
								<div class="thumb-image">
									<img src="../../quanlynhansu/danghinhanh/<?php echo $row_RChinhanh_sp['HA_URL'];?>" data-imagezoom="true" class="img-responsive" alt=""> 
								</div>
							</li>
							<?php
						}
						?>



					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="col-md-7 single-right-left simpleCart_shelfItem">
			<h3><?php echo $row_RCtlb_sanpham['SP_TEN']?></h3>

			<p>
				<span>
					<i class="thuoctinhchitietsp">Được đăng bời: </i>
					<b><?php echo $row_RCtlb_sanpham['TK_HOTEN'];?></b>
				</span>
				<span>
					<i class="thuoctinhchitietsp">, ngày: </i>
					<b><?php echo $row_RCtlb_sanpham['SP_NGAYTAO'];?></b>
				</span>
			</p>

			<p>
				<p>
					<span> 
						<i >Sản lượng: </i>
					</span>
					<span class="item_price">
						<?php echo $row_RCtlb_sanpham['SP_SLDK'];?>	
					</span> 
					<span><?php echo $row_RCtlb_sanpham['DVT_TEN'];?></span>
				</p>
				<p><span> <i>Tình trạng: </i></span>
					<?php 
					if($row_RCtlb_sanpham['TT_ID'] == '1'){
						?>
						<span class="trangthaidongy"><?php echo $row_RCtlb_sanpham['TT_TEN'];?></span>
						<?php
					}else if($row_RCtlb_sanpham['TT_ID'] == '2'){
						?>
						<span class="trangthaidahuy"><?php echo $row_RCtlb_sanpham['TT_TEN'];?></span></p>
						<?php
					}
					?>





				</p>


				<div class="product-single-w3l">
					<p>
						<i class="fa fa-hand-o-right" aria-hidden="true"></i><label>Mô tả sản phẩm</label>
						<ul>
							<?php 
							echo $row_RCtlb_sanpham['SP_MOTA'];
							?>

						</ul>
					</p>
					<p>
						<i class="fa fa-refresh" aria-hidden="true"></i>Sản phẩm sẽ 
						<label>không thể hoàn trả lại</label>
					</p>
				</div>
				<div class="occasion-cart">
					<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">

						<?php 
						if($row_RCtlb_sanpham['TK_ID'] == $catID){

						}else{
							?>
							<div class="col-md-6">
								<input  type="submit" id="iddatmuasp" value="Đặt mua" class="iddatmuasp button btn_orange" />
							</div>
							<div class="col-md-6">
								<!-- 	Liên hệ -->
								<a href="#lienhe" ><input type="submit" value="Liên hệ" class="button" /></a>
							</div>

							<?php
						}
						?>

					</div>
				</div>

				<script>
					$(document).ready(function(){
						$("#iddatmuasp").click(function(){
							$("#modaldatmuasp").modal("show");
						});
					});
				</script>
				<!-- form đặt mua sản phẩm -->
				<div id="modaldatmuasp" class="modal fade" role="dialog" tabindex="-1">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<center>
									<h3 class="modal-title"><i class="hidden" aria-hidden="true"></i>Đặt mua
									</h3>
								</center>

							</div>
							<div class="modal-body">
								<div class="form_mess_shop">
									<form action="single.php?act=datmuasp&catIDSP=<?php echo $catIDSP;?>&ID_TK_SP=<?php echo $ID_TK_SP; ?>" id="formdathang" class="form-horizontal" method="POST">
										<div class="form-group">
											<label class="col-sm-5 control-label ">Người bán</label>
											<div class="col-sm-7 ">
												<label class="control-label"><a href=""><?php echo $row_RCtlb_sanpham['TK_HOTEN'];?></a></label>
											</div>
											<label class="col-sm-5 control-label">Sản phẩm</label>
											<div class="col-sm-7">
												<label class="control-label"><a href=""><?php echo $row_RCtlb_sanpham['SP_TEN'];?></a></label>
											</div>
										</div>


										<div class="form-group">
											<label class="col-sm-5 control-label">Số lượng cần mua</label>

											<input type="hidden" value="0" id="quasoluong" name="quasoluong">
											<div class="col-sm-7">
												<div class="row">
													<div class="col-sm-6">
														<input type="number"  name="so_luong_can_mua" id="so_luong_can_mua" class="form-control" value="">
													</div>
													<div class="col-sm-6">

														<!-- ĐƠN VỊ TÍNH -->
														<select name="dat_don_vi_tinh" id="dat_don_vi_tinh" class="form-control selectpicker" >
															<?php
															$sql = "SELECT * FROM don_vi_tinh WHERE DVT_NHOM = '$row_RCtlb_sanpham[DVT_NHOM]' ";
															var_dump($sql) ;
															$results = mysqli_query($dbconn,$sql) ;
															while($row = mysqli_fetch_array($results)){ 
																if($row_RCtlb_sanpham['DVT_ID'] == $row[0]){
																	?>
																	<option selected value="<?php echo $row[0];?>"><?php echo $row[1]; ?></option>
																	<?php
																}else{
																	?>
																	<option value="<?php echo $row[0];?>"><?php echo $row[1]; ?></option>
																	<?php
																}
															}
															?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">

											<div class="col-sm-5">

											</div>
											<div class="col-sm-7">
												<span id="thongbaokqdh"></span>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">Đơn giá</label>
											<div class="col-sm-7">
												<div class="row">
													<div class="col-sm-6">
														<input type="number" name="don_gia_can_mua" id="don_gia_can_mua" min="1000" class="form-control price" value="10000">
													</div>
													<div class="col-md-2">
														<center>/</center>
													</div>
													<div class="col-sm-4">	
														
														<?php
														if($row_RCtlb_sanpham['DVT_NHOM'] == 1){
															?>
															<input type="text" class="form-control" value="KG" readonly="">
															<?php
														}else{
															?>
															<input type="text" class="form-control" value="Trái" readonly="">
															<?php
														}
														?>
														<!-- </select> -->
														<!-- <label class="control-label">
															<span>Thành tiền:
																<strong id="thanh_tien" class="price" > 10000
																</strong> 
															</span>
														</label> -->
													</div>
												</div>
											</div>
										</div>
										<div>
											<div class="form-group">
												<label class="col-sm-5 control-label">Thành tiền</label>
												<div class="col-sm-7">
													<label class="control-label">
														<span>
															<strong id="thanh_tien" class="price" >
															</strong> 
														</span>
													</label>
												</div>
											</div>
										</div>

										<div>

											<div class="form-group">
												<label class="col-sm-5 control-label">Ghi chú</label>
												<div class="col-sm-7">
													<textarea class="form-control" name="dat_ghi_chu" id="mess_shop_content" cols="30" rows="3" placeholder="Ghi chú "></textarea>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-2">
													<button type="submit" class="btn btn-success btn_orange">Mua ngay</button>
												</div>
												<div class="col-sm-7">
													<label class="control-label">
														<strong class="blink_me" style="font-size:75%">Vui lòng nhập đơn giá từ
															<span class="red price">1000
															</span>&nbsp;trở lên 
															<span class="hidden"></span>
														</strong>
													</label>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>

				</div>
				<!-- end form -->

			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //Single Page -->
	<div class="product-single-w3l">
		<div class="container">
			<div class="col-md-8">
				<p>
					<i class="fa fa-hand-o-right" aria-hidden="true"></i>
					<label>Nguồn gốc phát triển</label>
					<div class="example">
						<div class="row">
							<!-- <h2>Table Striped</h2> -->
							<table class="table table-striped">
								<thead>
									<tr>
										<th>STT</th>
										<th>Ngày</th>
										<th>Nội dung</th>
										<th>Ghi chú</th>

									</tr>
								</thead>
								<?php
								$count = 1;
								while($row = mysqli_fetch_array($kq_qtpt)){
									echo "<tr>";
									echo "<td>" .$count. "</td>";
									echo "<td>" .$row["QTPT_NGAY"]. "</td>";
									echo "<td>" .$row["QTPT_NOIDUNG"]. "</td>";
									echo "<td>" .$row["QTPT_GHICHU"]. "</td>";
									echo "</tr>";
									$count += 1;
								}
								?>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>
				</p>
			</div>
			<div class="col-md-4">
				<p id="lienhe">
					<i class="fa fa-hand-o-right" aria-hidden="true"></i>
					<label>Thông tin về người bán</label>
				</p>
				<p>
					<div class="col-md-10" style="background-color: #F9F9F9; " >

						<p><span style="font-style: italic; font-family:verdana; font-size: 12px;">Người bán:</span> 
							<span style="font-family:verdana; font-size: 12px;"><?php echo $row_RCtlb_sanpham['TK_HOTEN'];?></span>
						</p>
						<p><span style="font-style: italic; font-family:verdana; font-size: 12px;">Địa chỉ:</span> 
							<span style="font-family:verdana; font-size: 12px;"><?php echo $row_RCtlb_sanpham['DP_TEN'];?></span>
						</p> 
						<p><span style="font-style: italic; font-family:verdana; font-size: 12px;">Điện thoại:</span> 
							<span style="font-family:verdana; font-size: 12px;"><?php echo $row_RCtlb_sanpham['TK_SDT'];?></span>
						</p> 
						<p><span style="font-style: italic; font-family:verdana; font-size: 12px;">Email:</span> 
							<span style="font-family:verdana; font-size: 12px;"><?php echo $row_RCtlb_sanpham['TK_EMAIL'];?></span>
						</p> 
						<p><span style="font-style: italic; font-family:verdana; font-size: 12px;">Ngày tham gia:</span> 
							<span style="font-family:verdana; font-size: 12px;"><?php echo $row_RCtlb_sanpham['TK_NGAYTAO'];?></span>
						</p> 

						<?php
						$sqldanhgia = "SELECT AVG(PDG_DIEM) AS TONGDG FROM phieu_danh_gia WHERE ID_TK_DUOC_DG = '$row_RCtlb_sanpham[TK_ID]' ";
 // var_dump($sqldanhgia) ;
						$QUERYDG = mysqli_query($dbconn,$sqldanhgia);
						$row = mysqli_fetch_array($QUERYDG);
						$KQDG = $row['TONGDG'];
	// var_dump($KQDG);
						$sqlCOUNTdanhgia = "SELECT COUNT(PDG_DIEM) AS COUNTDG FROM phieu_danh_gia WHERE ID_TK_DUOC_DG = '$row_RCtlb_sanpham[TK_ID]' ";
 // var_dump($sqldanhgia) ;
						$QUERYcountDG = mysqli_query($dbconn,$sqlCOUNTdanhgia);
						$row = mysqli_fetch_array($QUERYcountDG);
						$COUNTDG = $row['COUNTDG'];
	// var_dump($KQDG);
						?>
						<center>
							<p><span style="font-style: italic; font-family:verdana; font-size: 12px;">Điểm người dùng:</span> 
							</p> 
						</center>
						<p>
							<span style="font-family:verdana; font-size: 12px;"><span style="color: red;"><?php echo number_format($KQDG, 2);?>/5</span>  của <span style="color: red;"><?php echo $COUNTDG;?> </span> người (đã mua sản phẩm)</span>
						</p>
					</div>
					<div class="col-md-2">
						<img src="Login/images/<?php echo $row_RCtlb_sanpham['TK_HA'];?>" alt="hình ảnh" width="120" height="150">
					</div>
				</p>
			</div>
		</div>
	</div>

	<!-- danh gia va binh luan -->
	<div class="product-single-w3l" >
		<div class="container">
			<div class="col-md-8">
				<p>
					<i class="fa fa-hand-o-right" aria-hidden="true"></i>
					<label>Bình luận về sản phẩm</label>

					<!-- Binh luan -->

					<div class="comment-form-container">
						<form id="frm-comment">
							<div class="input-row">
								<!-- <?php echo $_SESSION['ID_TK']?> -->
								<input type="hidden" name="commentIdtk" id="commentIdtk"
								placeholder="" value="<?php echo $_SESSION['ID_TK'];?>" /> 

								<input type="hidden" name="comment_id" id="commentId"
								placeholder="ID_BL" /> 

								<input class="input-field hidden"
								type="text" name="name" id="name" placeholder="" value="<?php echo $catIDSP;?>" />

							</div>
							<div class="input-row">
								<label >Bình luận</label>
								<textarea class="input-field" type="text" name="comment"
								id="comment" placeholder="Add a Comment">  </textarea>
							</div>
							<div>
								<input type="button" class="btn-submit" id="submitButton"
								value="Xác nhận" onclick="tai_lai_trang()" /><div id="comment-message">Viết một bình luận về sản phẩm</div>
							</div>

						</form>
					</div>
					<div id="output"></div>
					<!-- end binh luan -->


				</p>
			</div>
			<div class="col-md-4">
				<!-- reviews -->
				<center>
					<div class="customer-rev left-side">
						<h3 class="agileits-sear-head">Khách hàng đánh giá về sản phẩm</h3>

						<link type="text/css" rel="stylesheet" href="rating/style.css">


						<!-- Đánh giá -->
						<?php  
						include('rating/config.php');
						$id_tk_dg = $_SESSION['ID_TK']; 
						$id_sp = $_REQUEST['catIDSP']; 
						?>

						<div id="container1">
							<div class="rate">
								<div id="1" class="btn-1 rate-btn"></div>
								<div id="2" class="btn-2 rate-btn"></div>
								<div id="3" class="btn-3 rate-btn"></div>
								<div id="4" class="btn-4 rate-btn"></div>
								<div id="5" class="btn-5 rate-btn"></div>
							</div>
							<br>
							<div class="box-result">
								<?php
								$querydg = mysqli_query($db,"SELECT * FROM danh_gia_sp WHERE SP_ID='$id_sp' "); 
								while($data = mysqli_fetch_assoc($querydg)){
									$rate_db[] = $data;
									$sum_rates[] = $data['DGSP_DIEM'];
								}
								if(@count($rate_db)){
									$rate_times = count($rate_db);
									$sum_rates = array_sum($sum_rates);
									$rate_value = $sum_rates/$rate_times;
									$rate_bg = (($rate_value)/5)*100;
								}else{
									$rate_times = 0;
									$rate_value = 0;
									$rate_bg = 0;
								}
								?>
								<div class="result-container">
									<div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
									<div class="rate-stars"></div>
								</div>
								<p style="margin:5px 0px; font-size:16px; text-align:center">Có <strong><?php echo substr($rate_value,0,3); ?></strong> sao của <?php echo $rate_times; ?> Đánh giá</p>
							</div>
						</div>


						<script>
							$(function(){ 
								$('.rate-btn').hover(function(){
									$('.rate-btn').removeClass('rate-btn-hover');
									var therate = $(this).attr('id');
									for (var i = therate; i >= 0; i--) {
										$('.btn-'+i).addClass('rate-btn-hover');
									};
								});

								$('.rate-btn').click(function(){    

									var therate = $(this).attr('id');
									      var dataRate = 'act=rate&id_tk_dg=<?php echo $id_tk_dg; ?>&id_sp=<?php echo $id_sp; ?>&rate='+therate; //
									      $('.rate-btn').removeClass('rate-btn-active');
									      for (var i = therate; i >= 0; i--) {
									      	$('.btn-'+i).addClass('rate-btn-active');
									      };

									      $.ajax({
									      	type : "POST",
									      	url : "rating/ajax.php",
									      	data: dataRate,
									      	success:function(){

									      	}
									      });
									      tai_lai_trang();
									      
									  });

							});
							function tai_lai_trang(){
								location.reload();
								// document.getElementById("comment").focus();
								// window.location=window.location.href+"#comment";
							}
						</script>

					</div>
					<!-- //reviews -->
				</center>

			</div>
		</div>

	</div>	
	<!-- end danh gia va binh luan -->

	<!-- special offers -->
	<div class="featured-section" id="projects">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Sản phẩm liên quan
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<div class="content-bottom-in">
				<ul id="flexiselDemo1">
					<?php 
					while ($rowRCctcongviec = mysqli_fetch_array($RCctcongviec)) {
						?>

						<li>
							<a href="single.php?catIDSP=<?php echo $rowRCctcongviec['SP_ID']?>&ID_TK_SP=<?php echo $rowRCctcongviec['TK_ID']?>">
								<div class="w3l-specilamk">
									<div class="speioffer-agile">

										<img src="../../quanlynhansu/danghinhanh/<?php echo $rowRCctcongviec['HA_URL'];?>" alt="hinh anh" width="120" height="130">

									</div>
									<div class="product-name-w3l">
										<h4>
											<?php echo $rowRCctcongviec['SP_TEN']?>
										</h4>
										<div class="w3l-pricehkj">
											<h6><?php echo $rowRCctcongviec['SP_NGAYTAO']?></h6>
											<p><?php echo $rowRCctcongviec['SP_SLDK']?><?php echo $rowRCctcongviec['DVT_TEN']?></p>
										</div>
										<center>
											<input type="submit" value="Xem chi tiết" class="btn btn-success btn-sanphamnoibat">
										</center>
									</div>
								</div>
							</a>

						</li>

						<?php
					}
					?>

				</ul>
			</div>
		</div>
	</div>
	<!-- //special offers -->

	<?php include("footer.php")?>

	<script>
		$(document).ready(function() {
			var nf = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
			$(".price").text(function(){
				return nf.format($(this).html());
			});
		});
		$(document).ready(function(){
			$('#don_gia_can_mua').keyup(function(){
				var donvitinh = $('#dat_don_vi_tinh').val();
				if (donvitinh == 1) {
					donvitinh = 1;
				}else if (donvitinh == 2) {
					donvitinh = 1000;
				}else if (donvitinh == 3) {
					donvitinh = 10;
				}else if (donvitinh == 4) {
					donvitinh = 12;
				}else if (donvitinh == 5) {
					donvitinh = 1;
				}
				var dongia = $('#don_gia_can_mua').val();
				var soluong  = $('#so_luong_can_mua').val();
				var thanhtien = dongia * soluong * donvitinh;
				console.log(thanhtien);
				$('#thanh_tien').html(thanhtien);

				var nf = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
				$("#thanh_tien").text(function(){
					return nf.format($(this).html());
				});

				$.ajax({
					url: "xulydondathang.php",
					data:{so_luong_can_mua: $('#so_luong_can_mua').val(),id: <?=$_REQUEST["catIDSP"];?>, dvt: $('#dat_don_vi_tinh').val()},
					method:"GET",
					datatype: "JSON",
					success: function(data){
						console.log(data);
						var kq = JSON.parse(data);
						$("#thongbaokqdh").html(kq[1]);
						if(kq[0] == 0){
							$("#thongbaokqdh").css('color','red');
							$("#quasoluong").val(1);
						}else{
							$("#thongbaokqdh").css('color','blue');
							$("#quasoluong").val(0);
						}
					}
				});



			});
			$('#so_luong_can_mua').keyup(function(){
				var donvitinh = $('#dat_don_vi_tinh').val();
				if (donvitinh == 1) {
					donvitinh = 1;
				}else if (donvitinh == 2) {
					donvitinh = 1000;
				}else if (donvitinh == 3) {
					donvitinh = 10;
				}else if (donvitinh == 4) {
					donvitinh = 12;
				}else if (donvitinh == 5) {
					donvitinh = 1;
				}
				var dongia = $('#don_gia_can_mua').val();
				var soluong  = $('#so_luong_can_mua').val();
				var thanhtien = dongia * soluong * donvitinh;
				console.log(thanhtien);
				$('#thanh_tien').html(thanhtien);

				var nf = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
				$("#thanh_tien").text(function(){
					return nf.format($(this).html());
				});

				$.ajax({
					url: "xulydondathang.php",
					data:{so_luong_can_mua: $('#so_luong_can_mua').val(),id: <?=$_REQUEST["catIDSP"];?>, dvt: $('<div id="dat_don_vi_ti"></div>nh').val()},
					method:"GET",
					datatype: "JSON",
					success: function(data){
						console.log(data);
						var kq = JSON.parse(data);
						$("#thongbaokqdh").html(kq[1]);
						if(kq[0] == 0){
							$("#thongbaokqdh").css('color','red');
							$("#quasoluong").val(1);
						}else{
							$("#thongbaokqdh").css('color','blue');
							$("#quasoluong").val(0);
						}
					}
				});
			});

			$('#dat_don_vi_tinh').change(function(){

				var donvitinh = $('#dat_don_vi_tinh').val();
				if (donvitinh == 1) {
					donvitinh = 1;
				}else if (donvitinh == 2) {
					donvitinh = 1000;
				}else if (donvitinh == 3) {
					donvitinh = 10;
				}else if (donvitinh == 4) {
					donvitinh = 12;
				}else if (donvitinh == 5) {
					donvitinh = 1;
				}
				var dongia = $('#don_gia_can_mua').val();
				var soluong  = $('#so_luong_can_mua').val();
				var thanhtien = dongia * soluong * donvitinh;
				console.log(thanhtien);
				$('#thanh_tien').html(thanhtien);

				var nf = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
				$("#thanh_tien").text(function(){
					return nf.format($(this).html());
				});

				$.ajax({
					url: "xulydondathang.php",
					data:{so_luong_can_mua: $('#so_luong_can_mua').val(),id: <?=$_REQUEST["catIDSP"];?>, dvt: $('#dat_don_vi_tinh').val()},
					method:"GET",
					datatype: "JSON",
					success: function(data){
						console.log(data);
						var kq = JSON.parse(data);
						$("#thongbaokqdh").html(kq[1]);
						if(kq[0] == 0){
							$("#thongbaokqdh").css('color','red');
							$("#quasoluong").val(1);
						}else{
							$("#thongbaokqdh").css('color','blue');
							$("#quasoluong").val(0);
						}
					}
				});
			});

			$("#formdathang").submit(function(event){
				if($("#quasoluong").val() == 1 ){
					event.preventDefault();
					alert("Vượt quá sản lượng cho phép đặt hàng");
				}
			});
		});
	</script>

	<script>
		function postReply(commentId) {
			$('#commentId').val(commentId);
			$("#comment").focus();
		}
		// function tai_lai_trang(){
		// 	location.reload();
		// 	$("#output").focus();
		// }

		$("#submitButton").click(function () {
			$("#comment-message").css('display', 'none');
			var str = $("#frm-comment").serialize();

			$.ajax({
				url: "comments/comment-add.php",
				data: str,
				type: 'post',
				success: function (response)
				{	
					console.log(response);
					var result = eval('(' + response + ')');
					if (response)
					{
						$("#comment-message").css('display', 'inline-block');
						$("#name").val("");
						$("#comment").val("");
						$("#commentId").val("");
						$("#commentIdtk").val("");
						listComment();
					} else
					{
						alert("Failed to add comments !");
						return false;
					}
				}

			});
		});

		$(document).ready(function () {
			listComment();
		});

		function listComment() {
			$.post("comments/comment-list.php?ID_SP=<?php echo $catIDSP;?>",
				function (data) {
					console.log(data);
					var data = JSON.parse(data);

					var comments = "";
					var replies = "";
					var item = "";
					var parent = -1;
					var results = new Array();

					var list = $("<ul class='outer-comment'>");
					var item = $("<li>").html(comments);

					for (var i = 0; (i < data.length); i++)
					{
						var commentId = data[i]['BL_ID'];
						parent = data[i]['PARENT_ID_BL'];

						if (parent == "0")
						{
							comments = 
							"<div class='row'><div class='col-md-2'><img id='logobandua' src='Login/images/"+ data[i]['TK_HA'] + "' alt='Hình ảnh tk' with ='100' height='100' /></div><div class='col-md-10'><div class='comment-row'>"+
							"<div class='comment-info'><span class='commet-row-label'>Bình luận bởi</span> <span class='posted-by'>" 
							+ data[i]['TK_HOTEN'] + 
							" </span> <span class='commet-row-label'>vào lúc</span> <span class='posted-at'>" 
							+ data[i]['BL_NGAYTAO'] + "</span></div>" + 
							"<div class='comment-text'>" + data[i]['BL_NOIDUNG'] + "</div>"+
							"<div><a class='btn-reply' onClick='postReply(" + commentId + ")'>Trả lời</a></div>"+
							"</div></div></div>";

							var item = $("<li>").html(comments);
							list.append(item);
							var reply_list = $('<ul>');
							item.append(reply_list);
							listReplies(commentId, data, reply_list);
						}
					}
					$("#output").html(list);
				});
		}

		function listReplies(commentId, data, list) {
			var comments = "";
			for (var i = 0; (i < data.length); i++)
			{

				if (commentId == data[i].PARENT_ID_BL)
				{
					comments = 
					"<div class='row'><div class='col-md-2'><img id='logobandua' src='Login/images/"+ data[i]['TK_HA'] + "' alt='Hình ảnh tk' with ='75' height='80' /></div><div class='col-md-10'><div class='comment-row'>"+
					" <div class='comment-info'><span class='commet-row-label'>Bình luận bởi</span> <span class='posted-by'>" + data[i]['TK_HOTEN'] + " </span> <span class='commet-row-label'>vào lúc</span> <span class='posted-at'>" + data[i]['BL_NGAYTAO'] + "</span></div>" + 
					"<div class='comment-text'>" + data[i]['BL_NOIDUNG'] + "</div>"+
					// "<div><a class='btn-reply' onClick='postReply(" + data[i]['ID_BL'] + ")'>Trả lời</a></div>"+
					"</div></div></div>";
					var item = $("<li>").html(comments);
					var reply_list = $('<ul>');
					list.append(item);
					item.append(reply_list);
					listReplies(data[i].ID_BL, data, reply_list);
				}
			}
		}
	</script>


