<?php include("header.php"); ?>

<?php
$catIDloaiSP = $_REQUEST['catIDloaiSP'];

$sqlallsp = "SELECT * FROM san_pham 
inner join tinh_trang on san_pham.TT_ID = tinh_trang.TT_ID 
inner join loai_sp on loai_sp.LSP_ID = san_pham.LSP_ID 
inner join don_vi_tinh on don_vi_tinh.DVT_ID = san_pham.DVT_ID 
inner join tai_khoan on tai_khoan.TK_ID = san_pham.TK_ID
inner join hinh_anh_sp on hinh_anh_sp.SP_ID = san_pham.SP_ID
inner join dia_phuong on dia_phuong.DP_ID = san_pham.DP_ID
WHERE san_pham.LSP_ID = '$catIDloaiSP' AND hinh_anh_sp.HA_MAT_DINH = 1 AND ((san_pham.TT_ID = 1) or (san_pham.TT_ID = 2))
";
$kqsqlallsp = mysqli_query($dbconn,$sqlallsp);


	// LAY TEN LOAI SP
$sqltitleloaisp = "SELECT * FROM loai_sp WHERE LSP_ID = '$catIDloaiSP' ";
$kqsqlTITLEloaisp = mysqli_query($dbconn,$sqltitleloaisp);
$loaisptitle = mysqli_fetch_array($kqsqlTITLEloaisp);




  // Sản phẩm mới
$sqlspm ="  SELECT * FROM san_pham
inner join don_vi_tinh on san_pham.DVT_ID = don_vi_tinh.DVT_ID
inner join tinh_trang on san_pham.TT_ID = tinh_trang.TT_ID 
inner join hinh_anh_sp on hinh_anh_sp.SP_ID = san_pham.SP_ID
inner join dia_phuong on dia_phuong.DP_ID = san_pham.DP_ID
WHERE HA_MAT_DINH = 1 AND ((san_pham.TT_ID = 1) or (san_pham.TT_ID = 2))
ORDER BY SP_NGAYTAO DESC
"; 
$kqSQLsanphammoi = mysqli_query($dbconn,$sqlspm);


$ktdiaphuong = $_SESSION['DIA_CHI'];
$sqlspnb = "SELECT * FROM san_pham
inner join don_vi_tinh on san_pham.DVT_ID = don_vi_tinh.DVT_ID
inner join tinh_trang on san_pham.TT_ID = tinh_trang.TT_ID 
inner join hinh_anh_sp on hinh_anh_sp.SP_ID = san_pham.SP_ID
inner join dia_phuong on dia_phuong.DP_ID = san_pham.DP_ID
WHERE san_pham.DP_ID = '$ktdiaphuong' AND  hinh_anh_sp.HA_MAT_DINH = 1 AND ((san_pham.TT_ID = 1) or (san_pham.TT_ID = 2))
";
$kqsqlspnb = mysqli_query($dbconn,$sqlspnb);
?>

<!-- top Products -->
<div class="ads-grid">
	<div class="container">
		
		<div class="side-bar col-md-3">
			<div class="search-hotel">
				<h3 class="agileits-sear-head">Tìm kiếm..</h3>
				<form action="timkiemsp.php" method="post">
					<input type="search" placeholder="Sản phẩm..." name="search" required="">
					<input type="submit" value=" ">
				</form>
			</div>

			<!-- reviews -->
			
			<!-- //reviews -->
			<!-- cuisine -->
			<div class="left-side">
				<h3 class="agileits-sear-head">Địa Phương</h3>
				<ul>
					<?php
					while ($row_kqsqldiaphuong = mysqli_fetch_array($kqsqldiaphuong)) {
						?>	
						<li>
							<a href="indexdiaphuong.php?catIDdiaphuong=<?php echo $row_kqsqldiaphuong['DP_ID']?>">
								<input type="checkbox" class="checked" value="">
								<span class="span"><?php echo $row_kqsqldiaphuong['DP_TEN']?></span>
							</a>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
			<!-- //cuisine -->

		</div>
		<!-- //product left -->
		<!-- product right -->
		<div class="agileinfo-ads-display col-md-6">
			<div class="wrapper">
				<!-- first section (nuts) -->
				<div class="product-sec1">
					<h3 class="heading-tittle"><?php echo $loaisptitle['LSP_TEN']?></h3>


					<?php 

					$demsp = 1;

					while(($row = mysqli_fetch_array($kqsqlallsp)) && ($demsp <=50)){
						if(($row['TT_ID'] == 4) AND ($row['TT_NHOM'] == 3) AND ($row['TT_NHOM'] == 2) AND ($row['HA_MAT_DINH'] == 0)) {

						}else{
							?>
							<!-- sp1 -->
							<div class="col-md-4 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="../../quanlynhansu/danghinhanh/<?php echo $row['HA_URL'];?>" alt="hinh anh" width="120" height="130">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.php?catIDSP=<?php echo $row['SP_ID'];?>&ID_TK_SP=<?php echo $row['TK_ID'];?>" class="link-product-add-cart">Xem</a>
											</div>
										</div>
										<span class="product-new-top">Nổi bật</span>
									</div>
									<div class="item-info-product ">
										<h4>
											<a href="single.php?catIDSP=<?php echo $row['SP_ID'];?>&ID_TK_SP=<?php echo $row['TK_ID'];?>" style="color: #FF5722; font-size: 85%;"><?php echo $row['SP_TEN'];?></a>
										</h4>
										<h5>
											<i><span>Ngày đăng: </br><b><?php echo $row['SP_NGAYTAO'];?></b></span></i>
										</h5>	
										<h5>
											<i><span>Nơi bán:<b><?php echo $row['DP_TEN'];?></b></span></i>
										</h5>	
										<div class="info-product-price">
											<span class="item_price"><?php echo $row['SP_SLDK'];?></span><i><?php echo $row['DVT_TEN'];?></i>
										</div>

										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											<a href="single.php?catIDSP=<?php echo $row['SP_ID'];?>&ID_TK_SP=<?php echo $row['TK_ID'];?>">
												<input  type="submit"  class="iddatmuasp" value="Xem chi tiết" class="button btn_orange" />
											</a>
										</div>
									</div>
								</div>
							</div>

							<!-- sp1 -->		
							<?php
						}
						$demsp += 1;
					}
					?>


					<div class="clearfix"></div>


				</div>

				<!-- //fourth section (noodles) -->
			</div>
		</div>
		<!-- //product right -->
		<div class="side-bar col-md-3">

			<div class="deal-leftmk left-side">
				<h3 class="agileits-sear-head">Sản phẩm mới</h3>
				<?php 
			$demngaysp = 1;
			while (($row_kqsqlsanphammoi = mysqli_fetch_array($kqSQLsanphammoi)) && ($demngaysp <=10)){
				?>
				<div class="special-sec1">
					<div class="col-xs-4 img-deals">
						<img src="../../quanlynhansu/danghinhanh/<?php echo $row_kqsqlsanphammoi['HA_URL'];?>" width="70" height="110" alt="">
					</div>
					<div class="col-xs-8 img-deal1">
						<a href="single.php?catIDSP=<?php echo $row_kqsqlsanphammoi['SP_ID']?>&ID_TK_SP=<?php echo $row_kqsqlsanphammoi['TK_ID'];?>"><h4 style="color: #FF5722; font-size: 85%;"><?php echo $row_kqsqlsanphammoi['SP_TEN']?></h4>
						<p><span style="font-size: 80%"><?php echo $row_kqsqlsanphammoi['SP_NGAYTAO']?></span></p>
						<span style="font-size: 80%"><?php echo $row_kqsqlsanphammoi['DP_TEN']?></span>
						<p><span class="item_price" style="font-size: 85%;"><?php echo $row_kqsqlsanphammoi['SP_SLDK']?><?php echo $row_kqsqlsanphammoi['DVT_TEN']?></span>
						</p>
						</a>
						
						
					</div>
					<div class="clearfix"></div>
				</div>
				<?php
				$demngaysp += 1;
			}
			?>
			</div>
		</div>



	</div>
</div>
<!-- //top products -->
<!-- special offers -->
<div class="featured-section" id="projects">

	<div class="container">
		<!-- tittle heading -->
		<h3 class="tittle-w3l">
				<?php 
			$sqlshowdiachi = "SELECT * FROM dia_phuong 
			WHERE DP_ID ='$ktdiaphuong' ";
			$ketnoisqlshowdiachi = mysqli_query($dbconn,$sqlshowdiachi);
			$rowsqlshowdiachi = mysqli_fetch_array($ketnoisqlshowdiachi);
			echo $rowsqlshowdiachi['DP_TEN'];
			?>
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
					while ($rowkqsqlspnb = mysqli_fetch_array($kqsqlspnb)) {
				?>
					<li>
						<div class="w3l-specilamk">
							<div class="speioffer-agile">
								<a href="single.php?catIDSP=<?php echo $rowkqsqlspnb['SP_ID']?>&ID_TK_SP=<?php echo $rowkqsqlspnb['TK_ID'];?>">
									<img src="../../quanlynhansu/danghinhanh/<?php echo $rowkqsqlspnb['HA_URL'];?>" alt="hinh anh" width="120" height="130">
								</a>
							</div>
							<div class="product-name-w3l">
								<a href="single.php?catIDSP=<?php echo $rowkqsqlspnb['SP_ID']?>&ID_TK_SP=<?php echo $rowkqsqlspnb['TK_ID'];?>">
								<h4 style="color: #FF5722; font-size: 120%;">
									<?php echo $rowkqsqlspnb['SP_TEN']?>
								</h4>
								<div class="">

									<p><?php echo $rowkqsqlspnb['SP_NGAYTAO']?></p>

									<p><b><?php echo $rowkqsqlspnb['DP_TEN']?></b></p>
									<p ><span class="item_price"><?php echo $rowkqsqlspnb['SP_SLDK']?><?php echo $rowkqsqlspnb['DVT_TEN']?></span>
									</p>
								</div>
								<center>
									<input type="submit" value="Xem chi tiết" class="btn btn-success btn-sanphamnoibat">
								</center>
								</a>
							</div>
						</div>
					</li>
				
				<?php
					}
				?>
		</ul>
	</div>
</div>
</div>
<!-- //special offers -->
<!-- newsletter -->
<div>
	<h3 class="tittle-w3l">
		<span class="heading-style">
			<i></i>
			<i></i>
			<i></i>
		</span>
	</h3>
</div>
<?php include("footer.php"); ?>