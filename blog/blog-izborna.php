<?php	
require('connection.php');
require('function.php');

$from = 0;
$limit = 8;
$page = 1;
$filter = "";

if(!empty($_GET['c'])) {
	if($_GET['c'] == "Other") {
		$filter = " WHERE `category`=''";
	}else {
		$filter = " WHERE `category`='".strip($_GET['c'], $connect)."'";	
	}

	if(!empty($_GET['t'])) {
		$filter .= " AND `tags` LIKE '%".strip($_GET['t'], $connect)."%'";
	}
}else {
	if(!empty($_GET['t'])) {
		$filter = " WHERE `tags` LIKE '%".strip($_GET['t'], $connect)."%'";
	}
}

$cmd = "SELECT * FROM `posts`".$filter.";";
$rows = mysqli_query($connect, $cmd);
$total = mysqli_num_rows($rows);

$max_page = intval($total / $limit);

if($total % $limit != 0) {
	$max_page++;
}

if(!empty($_GET['p'])) {
	$page = strip($_GET['p'], $connect);

	if($page > 1) {
		if($page * $limit >= $total) {
			$page = $max_page;
			$from = ($page - 1) * $limit;
		}else {
			$from = $page * ($limit - 1);
		}
	}else {
		$page = 1;
	}
}
?>
<!DOCTYPE html>
<html>
	<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
	<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
	<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

	<head>
		<title>Blog Tekstovi Izbor</title>

		<!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">

		<!-- Web Fonts -->
		<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

		<!-- CSS Global Compulsory -->
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/style.css">

		<!-- CSS Header and Footer -->
		<link rel="stylesheet" href="assets/css/headers/header-default.css">
		<link rel="stylesheet" href="assets/css/footers/footer-v1.css">

		<!-- CSS Implementing Plugins -->
		<link rel="stylesheet" href="assets/plugins/animate.css">
		<link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/plugins/parallax-slider/css/parallax-slider.css">
		<link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">

		<!-- CSS Page Style -->
		<link rel="stylesheet" href="assets/css/pages/blog.css">

		<!-- CSS Theme -->
		<link rel="stylesheet" href="assets/css/theme-colors/default.css" id="style_color">
		<link rel="stylesheet" href="assets/css/theme-skins/dark.css">

		<!-- CSS Customization -->
		<link rel="stylesheet" href="assets/css/custom.css">
	</head>

	<body>

		<div class="wrapper">
			<!--=== Header ===-->
			<div class="header">
				<div class="container">
					<!-- Logo -->
					<a class="logo" href="index.html">
						<img src="assets/img/logo1-default.png" alt="Logo">
					</a>
					<!-- End Logo -->

					<!-- Topbar -->
					<div class="topbar">
						<ul class="loginbar pull-right">
							<li class="hoverSelector">
								<i class="fa fa-globe"></i>
								<a>Languages</a>
								<ul class="languages hoverSelectorBlock">
									<li class="active">
										<a href="#">English <i class="fa fa-check"></i></a>
									</li>
									<li><a href="#">Spanish</a></li>
									<li><a href="#">Russian</a></li>
									<li><a href="#">German</a></li>
								</ul>
							</li>
							<li class="topbar-devider"></li>
							<li><a href="page_faq.html">Help</a></li>
							<li class="topbar-devider"></li>
							<li><a href="page_login.html">Login</a></li>
						</ul>
					</div>
					<!-- End Topbar -->

					<!-- Toggle get grouped for better mobile display -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="fa fa-bars"></span>
					</button>
					<!-- End Toggle -->
				</div><!--/end container-->

				<!-------------------- Linkovi ------------------------->
				<div class="collapse navbar-collapse navbar-responsive-collapse">
					<div class="container">
						<ul class="nav navbar-nav">
							<!------- Početna ------>
							<li>
								<a href="home.html">
									Početna
								</a>
							</li>

							<!------- Početna Kraj ------>

							<!----- Novine ------>
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
									Novine
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Zakoni </a></li>
									<li><a href="#">Filantropija </a></li>
									<li><a href="#">Podizanje svesti </a></li>
									<li><a href="#">About Us </a></li>
									<li><a href="#">About Us </a></li>
								</ul>
							</li>
							<!----- Novine Kraj ------>

							<!----- Vodič Kupovine ------>
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
									Vodič Kupovine
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Obnovljiva energija </a></li>
									<li><a href="#">Grejanje </a></li>
									<li><a href="#">Resursi </a></li>
									<li><a href="#">Dizajn </a></li>
									<li><a href="#">Uštede </a></li>
								</ul>
							</li>
							<!----- Vodič Kupovine Kraj ------>

							<!----- Glavni Problemi ----->
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
									Glavni Problemi
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Architecture</a></li>
									<li><a href="#">Travel</a></li>
									<li><a href="#">Mobile App</a></li>
									<li><a href="#">Shipping</a></li>
									<li><a href="#">Agency</a></li>
									<li><a href="#">Spa</a></li>
									<li><a href="#">Lawyer</a></li>
									<li><a href="#">Business</a></li>
								</ul>
							</li>
							<!----- Glavni Problemi Kraj ----->

							<!---- Istraživanja i činjenice ---->
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
									Istraživanja i činjenice
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Wedding</a></li>
									<li><a href="#">Courses</a></li>
									<li><a href="#">Consulting</a></li>
									<li><a href="#">Gym</a></li>
									<li><a href="#">Photography</a></li>
									<li><a href="#">Restaurant</a></li>
									<li><a href="#">Web</a></li>
									<li><a href="#">Business</a></li>
									<li><a href="#">Agency</a></li>
								</ul>
							</li>
							<!------- Istraživanja i činjenice Kraj ----->
						</ul>

						<!------- Pretraga --------->
						<ul class="nav navbar-nav navbar-border-bottom navbar-right">
							<li class="no-border">
								<i class="search fa fa-search search-btn"></i>
								<div class="search-open">
									<div class="input-group animated fadeInDown">
										<input type="text" class="form-control" placeholder="Klik">
										<span class="input-group-btn">
											<button class="btn-u" type="button">Traži</button>
										</span>
									</div>
								</div>
							</li>
						</ul>
						<!------ Pretraga Kraj ------>
					</div>
					<!-------------------- Linkovi Kraj ------------------------->
				</div>
				<!--=== End Header ===-->

				<!--=== Breadcrumbs ===-->
				<div class="breadcrumbs">
					<div class="container">
						<h1 class="pull-left">Blog Medium</h1>
						<ul class="pull-right breadcrumb">
							<li><a href="index.html">Home</a></li>
							<li><a href="#">Features</a></li>
							<li class="active">Blog Medium</li>
						</ul>
					</div>
				</div><!--/breadcrumbs-->
				<!--=== End Breadcrumbs ===-->
				<!--=== Content Part ===-->
				<div class="container content">
					<div class="row blog-page">
						<!-- Left Sidebar -->
						<div class="col-md-9 md-margin-bottom-40">
							<!--Blog Post-->
							<?php
							$cmd = "SELECT * FROM `posts`".$filter." LIMIT $limit OFFSET $from;";
							$rows = mysqli_query($connect, $cmd);
							$num = mysqli_num_rows($rows);

							if($num > 0) {
								if($rows) {
									while($row = mysqli_fetch_array($rows)) {
										$headline = $row['headline'];
										$image = "images/posts/default.png";
										$category = "Other";
										$tags = "No tags";
										$date = "Unknown";
										$preview = "No post preview";

										if(!empty($row['preview'])) {
											$preview = $row['preview'];
										}

										if(!empty($row['image'])) {
											$image = $row['image'];
										}

										if(!empty($row['date'])) {
											$date = $row['date'];
										}

										if(!empty($row['tags'])) {
											$tags = $row['tags'];
										}

										echo '<div class="row blog blog-medium margin-bottom-40">';
										echo '<div class="col-md-5">';
										echo '<a href="blog-tekst.php?h='.$headline.'"><img class="img-responsive" src="'.$image.'" alt=""></a>';
										echo '</div>';
										echo '<div class="col-md-7">';
										echo '<a href="blog-tekst.php?h='.$headline.'"><h2>'.$headline.'</h2></a>';
										echo '<ul class="list-unstyled list-inline blog-info">';
										echo '<li><i class="fa fa-calendar"></i> '.$date.'</li>';
										echo '<li><i class="fa fa-tags"></i> '.$tags.'</li>';
										echo '</ul>';
										echo '<p>'.$preview.'</p>';
										echo '<p><a href="blog-tekst.php?h='.$headline.'" class="btn-u btn-u-sm">Read More <i class="fa fa-angle-double-right margin-left-5"></i></a></p>';
										echo '</div>';
										echo '</div>';
									}
								}
							}else {
								show_msg('<h1>Posts not found</h1>', '<a href="blog-izborna.php">Go home</a>');
							}
							?>
							<!--End Blog Post-->
							<hr class="margin-bottom-40">

							<!--Pagination-->

							<div class="text-center">
								<ul class="pagination">
									<?php
									if($page > 1) {
										echo '<li><a href="?p='.($page - 1).'">«</a></li>';

										if($page > 2) {
											echo '<li><a href="?p=1">1...</a></li>';
										}

										echo '<li><a href="?p='.($page - 1).'">'.($page - 1).'</a></li>';
									}

									echo '<li class="active"><a href="?p='.$page.'">'.$page.'</a></li>';

									if($page < $max_page) {
										echo '<li><a href="?p='.($page + 1).'">'.($page + 1).'</a></li>';

										if($page < $max_page - 1) {
											echo '<li><a href="?p='.$max_page.'">...'.$max_page.'</a</li>';
										}
										echo '<li><a href="?p='.($page + 1).'">»</a></li>';
									}
									?>
								</ul>
							</div>
							<!--End Pagination-->
						</div>
						<!-- End Left Sidebar -->

						<!-- Right Sidebar -->
						<div class="col-md-3">
							<!-- Social Icons -->
							<div class="magazine-sb-social margin-bottom-30">
								<div class="headline headline-md"><h2>Social Icons</h2></div>
								<ul class="social-icons social-icons-color">
									<li><a class="social_rss" data-original-title="Feed" href="#"></a></li>
									<li><a class="social_facebook" data-original-title="Facebook" href="#"></a></li>
									<li><a class="social_twitter" data-original-title="Twitter" href="#"></a></li>
									<li><a class="social_vimeo" data-original-title="Vimeo" href="#"></a></li>
									<li><a class="social_googleplus" data-original-title="Goole Plus" href="#"></a></li>
									<li><a class="social_pintrest" data-original-title="Pinterest" href="#"></a></li>
									<li><a class="social_linkedin" data-original-title="Linkedin" href="#"></a></li>
									<li><a class="social_dropbox" data-original-title="Dropbox" href="#"></a></li>
									<li><a class="social_picasa" data-original-title="Picasa" href="#"></a></li>
									<li><a class="social_spotify" data-original-title="Spotify" href="#"></a></li>
									<li><a class="social_jolicloud" data-original-title="Jolicloud" href="#"></a></li>
									<li><a class="social_wordpress" data-original-title="Wordpress" href="#"></a></li>
									<li><a class="social_github" data-original-title="Github" href="#"></a></li>
									<li><a class="social_xing" data-original-title="Xing" href="#"></a></li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<!-- End Social Icons -->

							<!-- Posts -->
							<div class="posts margin-bottom-40">
								<div class="headline headline-md"><h2>Recent Posts</h2></div>
								<?php
								date_default_timezone_set('UTC');
								$date = date('d.m.Y.', time());

								$cmd = "SELECT * FROM `posts` ORDER BY `id` DESC LIMIT 3;";
								$rows = mysqli_query($connect, $cmd);
								$num = mysqli_num_rows($rows);

								if($num > 0) {
									if($rows) {
										while($row = mysqli_fetch_array($rows)) {
											$headline = $row['headline'];
											$image = "images/posts/default.png";

											if(!empty($row['image'])) {
												$image = $row['image'];
											}

											echo '<dl class="dl-horizontal">';
											echo '<dt><a href="blog-tekst.php?h='.$headline.'"><img src="'.$image.'" alt=""></a></dt>';
											echo '<dd>';
											echo '<p><a href="blog-tekst.php?h='.$headline.'">'.$headline.'</a></p>';
											echo '</dd>';
											echo '</dl>';
										}
									}
								}

								mysqli_close($connect);
								?>
							</div><!--/posts-->
							<!-- End Posts -->

							<!-- Tabs Widget -->
							<div class="headline headline-md"><h2>Tabs Widget</h2></div>
							<div class="tab-v2 margin-bottom-40">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#home-1">About Us</a></li>
									<li><a data-toggle="tab" href="#home-2">Quick Links</a></li>
								</ul>
								<div class="tab-content">
									<div id="home-1" class="tab-pane active">
										<p>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac ac adipiscing nunc.</p> <p>Pellentesque fermentum, ante ac felis consectetur id. Donec eget orci metusvivamus imperdiet.</p>
									</div>
									<div id="home-2" class="tab-pane magazine-sb-categories">
										<div class="row">
											<ul class="list-unstyled col-xs-6">
												<li><a href="#">Best Sliders</a></li>
												<li><a href="#">Parralax Page</a></li>
												<li><a href="#">Backgrounds</a></li>
												<li><a href="#">Parralax Slider</a></li>
												<li><a href="#">Responsive</a></li>
												<li><a href="#">800+ Icons</a></li>
											</ul>
											<ul class="list-unstyled col-xs-6">
												<li><a href="#">60+ Pages</a></li>
												<li><a href="#">Layer Slider</a></li>
												<li><a href="#">Bootstrap 3</a></li>
												<li><a href="#">Fixed Header</a></li>
												<li><a href="#">Best Template</a></li>
												<li><a href="#">And Many More</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- End Tabs Widget -->

							<!-- Photo Stream -->
							<div class="headline headline-md"><h2>Photo Stream</h2></div>
							<ul class="list-unstyled blog-photos margin-bottom-30">
								<li><a href="#"><img class="hover-effect" alt="" src="assets/img/sliders/elastislide/5.jpg"></a></li>
								<li><a href="#"><img class="hover-effect" alt="" src="assets/img/sliders/elastislide/6.jpg"></a></li>
								<li><a href="#"><img class="hover-effect" alt="" src="assets/img/sliders/elastislide/8.jpg"></a></li>
								<li><a href="#"><img class="hover-effect" alt="" src="assets/img/sliders/elastislide/10.jpg"></a></li>
								<li><a href="#"><img class="hover-effect" alt="" src="assets/img/sliders/elastislide/11.jpg"></a></li>
								<li><a href="#"><img class="hover-effect" alt="" src="assets/img/sliders/elastislide/1.jpg"></a></li>
								<li><a href="#"><img class="hover-effect" alt="" src="assets/img/sliders/elastislide/2.jpg"></a></li>
								<li><a href="#"><img class="hover-effect" alt="" src="assets/img/sliders/elastislide/7.jpg"></a></li>
							</ul>
							<!-- End Photo Stream -->
						</div>
						<!-- End Right Sidebar -->
					</div><!--/row-->
				</div><!--/container-->
				<!--=== End Content Part ===-->
				<!-- Owl Clients v1 -->
				<div class="headline"><h2>Our Clients</h2></div>
				<div class="owl-clients-v1">
					<div class="item">
						<img src="assets/img/clients4/1.png" alt="">
					</div>
					<div class="item">
						<img src="assets/img/clients4/2.png" alt="">
					</div>
					<div class="item">
						<img src="assets/img/clients4/3.png" alt="">
					</div>
					<div class="item">
						<img src="assets/img/clients4/4.png" alt="">
					</div>
					<div class="item">
						<img src="assets/img/clients4/5.png" alt="">
					</div>
					<div class="item">
						<img src="assets/img/clients4/6.png" alt="">
					</div>
					<div class="item">
						<img src="assets/img/clients4/7.png" alt="">
					</div>
					<div class="item">
						<img src="assets/img/clients4/8.png" alt="">
					</div>
					<div class="item">
						<img src="assets/img/clients4/9.png" alt="">
					</div>
				</div>
				<!-- End Owl Clients v1 -->
				<!--=== Footer Version 1 ===-->
				<div class="footer-v1">
					<div class="footer">
						<div class="container">
							<div class="row">
								<!-- About -->
								<div class="col-md-3 md-margin-bottom-40">
									<a href="index.html"><img id="logo-footer" class="footer-logo" src="assets/img/logo2-default.png" alt=""></a>
									<p>About Unify dolor sit amet, consectetur adipiscing elit. Maecenas eget nisl id libero tincidunt sodales.</p>
									<p>Duis eleifend fermentum ante ut aliquam. Cras mi risus, dignissim sed adipiscing ut, placerat non arcu.</p>
								</div><!--/col-md-3-->
								<!-- End About -->

								<!-- Latest -->
								<div class="col-md-3 md-margin-bottom-40">
									<div class="posts">
										<div class="headline"><h2>Latest Posts</h2></div>
										<ul class="list-unstyled latest-list">
											<li>
												<a href="#">Incredible content</a>
												<small>May 8, 2014</small>
											</li>
											<li>
												<a href="#">Best shoots</a>
												<small>June 23, 2014</small>
											</li>
											<li>
												<a href="#">New Terms and Conditions</a>
												<small>September 15, 2014</small>
											</li>
										</ul>
									</div>
								</div><!--/col-md-3-->
								<!-- End Latest -->

								<!-- Link List -->
								<div class="col-md-3 md-margin-bottom-40">
									<div class="headline"><h2>Useful Links</h2></div>
									<ul class="list-unstyled link-list">
										<li><a href="#">About us</a><i class="fa fa-angle-right"></i></li>
										<li><a href="#">Portfolio</a><i class="fa fa-angle-right"></i></li>
										<li><a href="#">Latest jobs</a><i class="fa fa-angle-right"></i></li>
										<li><a href="#">Community</a><i class="fa fa-angle-right"></i></li>
										<li><a href="#">Contact us</a><i class="fa fa-angle-right"></i></li>
									</ul>
								</div><!--/col-md-3-->
								<!-- End Link List -->

								<!-- Address -->
								<div class="col-md-3 map-img md-margin-bottom-40">
									<div class="headline"><h2>Contact Us</h2></div>
									<address class="md-margin-bottom-40">
										25, Lorem Lis Street, Orange <br />
										California, US <br />
										Phone: 800 123 3456 <br />
										Fax: 800 123 3456 <br />
										Email: <a href="mailto:info@anybiz.com" class="">info@anybiz.com</a>
									</address>
								</div><!--/col-md-3-->
								<!-- End Address -->
							</div>
						</div>
					</div><!--/footer-->

					<div class="copyright">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<p>
										2015 &copy; All Rights Reserved.
										<a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
									</p>
								</div>

								<!-- Social Links -->
								<div class="col-md-6">
									<ul class="footer-socials list-inline">
										<li>
											<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
												<i class="fa fa-facebook"></i>
											</a>
										</li>
										<li>
											<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Skype">
												<i class="fa fa-skype"></i>
											</a>
										</li>
										<li>
											<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google Plus">
												<i class="fa fa-google-plus"></i>
											</a>
										</li>
										<li>
											<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin">
												<i class="fa fa-linkedin"></i>
											</a>
										</li>
										<li>
											<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pinterest">
												<i class="fa fa-pinterest"></i>
											</a>
										</li>
										<li>
											<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
												<i class="fa fa-twitter"></i>
											</a>
										</li>
										<li>
											<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dribbble">
												<i class="fa fa-dribbble"></i>
											</a>
										</li>
									</ul>
								</div>
								<!-- End Social Links -->
							</div>
						</div>
					</div><!--/copyright-->
				</div>
				<!--=== End Footer Version 1 ===-->
			</div><!--/wrapper-->
		</div>
	</body>
	</html>