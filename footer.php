
<!-- footer -->
<footer>
	<div class="container">
		<div id="background_footer" class="footer-info w3-agileits-info">
			<!-- footer categories -->
			<div class="col-sm-12 address-right">
				<div class="col-xs-4 footer-grids">
                                    <center>
                                        <h3 style="color: black"><b>Về chúng tôi</b></h3>
					<ul>
                                            <li>
                                                    <a href="about.php">Giới thiệu</a>
                                            </li>
                                            </hr>
                                            <li>
                                                    <a href="contact.php">Liên hệ</a>
                                            </li>
                                        </ul>
                                    </center>
			</div>
			<div class="col-xs-4 footer-grids w3l-socialmk">
				<h3 style="color: black"><b>Theo dõi chúng tôi</b></h3>
                                
				<div class="social">
                                        <ul>
                                                <li>
                                                        <a class="icon fb" href="#">
                                                                <i class="fa fa-facebook"></i>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a class="icon tw" href="#">
                                                                <i class="fa fa-twitter"></i>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a class="icon gp" href="#">
                                                                <i class="fa fa-google-plus"></i>
                                                        </a>
                                                </li>
                                        </ul>
                                </div>
			</div>
                            <div class="col-xs-4 footer-grids">
				<h3 style="color: black"><b>Liên hệ</b></h3>
				<ul>
                                    <li>
                                        <i class="fa fa-map-marker"></i> Chợ Nổi Cái Răng, An Bình, Ninh Kiều, Cần Thơ.</li>
                                        <li>
<!--							<i class="fa fa-mobile"></i> 0123456789 </li>-->
                                        <li>
                                    <i class="fa fa-phone"></i> +84 123 456 789  </li>
                                    <li>
                                            <i class="fa fa-envelope-o"></i>
                                            <a href="#"> nguyenletrithuc@gmail.com</a>
                                    </li>
                            </ul>
                    </div>
			<div class="clearfix"></div>
		</div>
		<!-- //footer categories -->
		
					<!-- //social icons -->
					<div class="clearfix"></div>
				</div>
				<!-- //footer third section -->

				<!-- //footer -->
				<!-- copyright -->
				<div class="copy-right">
					<div class="container">
						<p>Design by Nguyễn Lê Trí Thức. No copyrigh ©.
						
						</p>
					</div>
				</div>
				<!-- //copyright -->

				<!-- js-files -->
				<!-- jquery -->
				<script src="js/jquery-2.1.4.min.js"></script>
				<!-- //jquery -->

				<!-- popup modal (for signin & signup)-->
				<script src="js/jquery.magnific-popup.js"></script>
				<script>
					$(document).ready(function () {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});

					});
				</script>
				<!-- Large modal -->
	<!-- <script>
		$('#').modal('show');
	</script> -->
	<!-- //popup modal (for signin & signup)-->

	<!-- cart-js -->
	<script src="js/minicart.js"></script>
	<script>
		paypalm.minicartk.render(); //use only unique class names other than paypalm.minicartk.Also Replace same class name in css and minicart.min.js

		paypalm.minicartk.cart.on('checkout', function (evt) {
			var items = this.items(),
			len = items.length,
			total = 0,
			i;

			// Count the number of each item in the cart
			for (i = 0; i < len; i++) {
				total += items[i].get('quantity');
			}

			if (total < 3) {
				alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
				evt.preventDefault();
			}
		});
	</script>
	<!-- //cart-js -->

	<!-- price range (top products) -->
	<script>
		$(document).ready(function () {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>

	<script src="js/jquery-ui.js"></script>
	<script>
		//<![CDATA[ 
		$(window).load(function () {
			$("#slider-range").slider({
				range: true,
				min: 0,
				max: 9000,
				values: [50, 6000],
				slide: function (event, ui) {
					$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
				}
			});
			$("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

		}); //]]>
	</script>
	<!-- //price range (top products) -->
	
	<!-- FlexSlider -->

	<script src="js/imagezoom.js"></script>
	<script src="js/jquery.flexslider.js"></script>
	<script>
		// Can also be used with $(document).ready()
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide",
				controlNav: "thumbnails"
			});
		});
	</script>
	<!-- //FlexSlider-->

	<!-- flexisel (for special offers) -->
	<script src="js/jquery.flexisel.js"></script>
	<script>
		$(window).load(function () {
			$("#flexiselDemo1").flexisel({
				visibleItems: 3,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: {
					portrait: {
						changePoint: 480,
						visibleItems: 1
					},
					landscape: {
						changePoint: 640,
						visibleItems: 2
					},
					tablet: {
						changePoint: 768,
						visibleItems: 2
					}
				}
			});

		});
	</script>
	<!-- //flexisel (for special offers) -->

	<!-- smoothscroll -->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();

				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- //end-smooth-scrolling -->

	<!-- smooth-scrolling-of-move-up -->
	<script>
		$(document).ready(function () {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->

	<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
	<!-- //for bootstrap working -->
        <script>
            $(document).ready(function() {
                    var nf = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
                    $(".price").text(function(){
                            return nf.format($(this).html());
                    });
            });
        </script>
</body>
</html>