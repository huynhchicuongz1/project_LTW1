<?php 
session_start();
ob_start();
require_once"header.php";require_once './config/database.php';
spl_autoload_register(function($class_name) {
	require	'./app/Models/' . $class_name . '.php';
});
$objproducts = new Product();
$products = $objproducts->getAllItems();
if (isset($_SESSION['current_user'])) 
{
	$current_user = $_SESSION['current_user'];
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TRANG CHU</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="public/css/styles.css">
	<script type="text/javascript" src="public/js/jquery-3.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
	<script>
		var i = 0;
		images = [];
		var time = 3000;
				// Images list 
				images[0]="public/images/4.jpg"
				images[1]="public/images/6.jpg"
				// change Images
				function changeImages() {
					document.slide.src=images[i]; 
					if (i < images.length - 1) {
						i++;

					} else {
						i=0;
					}
					setTimeout("changeImages()" ,time );
				}
				window.onload = changeImages;
			</script>	
		</head>
		<body>
			<div class="top-sub">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<input class="search" type="text" id="search" name="search_query" placeholder="Search" value="" >
							<button type="submit" name="submit_search" class="button-search">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
						<div class="col-md-5">
						</div>
						<div class="col-md-4">
							<div class="dropdown">
								<div class="top-btn" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >My Account
									<span class="caret"></span></div>
									<ul class="dropdown-menu">
										<li><a href="#">Checkout</a></li>
										<li><?php if (isset($current_user)) {
											echo '<a href="#">'.$current_user[0]['user_fullname'].'</a>';

										}else{
											echo "<a href='login.php'>Login</a>";
										} ?></li>
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</div>	
								
							</div>
						</div>
						<div class="top-header">
							<div class="container">
								<div class="sub-menu">
									<nav class="navbar navbar-default" role="navigation">
										<div class="container-fluid">
											<!-- Brand and toggle get grouped for better mobile display -->
											<div class="navbar-header">
												<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
												<a class="navbar-brand" href="#"><img src="public/images/posbrize-logo-1448548663.jpg" alt="logo"></a>
											</div>

											<!-- Collect the nav links, forms, and other content for toggling -->
											<div class="collapse navbar-collapse navbar-ex1-collapse">
												<ul class="nav navbar-nav">
													<li class="active"><a href="#"  >Home</a></li>
													<li ><a href="#" >women</a></li>
													<li ><a href="#" >Men</a></li>
													<li ><a href="#" >Footwear</a></li>
													<li ><a href="#" >Jewellery</a></li>
													<li ><a href="#" >Accessories</a></li>
												</ul>



											</div><!-- /.navbar-collapse -->
										</div>
									</nav>
								</div>


								<div id="myslide" class="carousel slide" data-ride= "carousel">
									<ol class="carousel-indicators">
										<li data-target = "#myslide" data-slide-to="0" class="active"></li>
										<li data-target = "#myslide" data-slide-to="1" ></li>
									</ol>
									<div class="carousel-inner">
										<div class="item active">
											<img name="slide" src="public//images/4.jpg" alt="" class="img-responsive">
										</div>
										<div class="item">
											<img name="slide" src="public//images/6.jpg" alt="" class="img-responsive">
										</div>
									</div>
									<a class="carousel-control left" href="#myslide" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
									</a>
									<a class="carousel-control right" href="#myslide" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
									</a>
								</div>
							</div>
						</div>
						<div class="top-content">
							<div class="container">
								<div class="row">
									<div class="col-md-4">
										<div class="top-item"> 
											<a href="#"><img src="public/images/banner1-home3.jpg" alt="img-item1" class="img-responsive"></a>
											<p class="text-banner">
												<span>look book</span>
											</p>
										</div>	
									</div>
									<div class="col-md-4">
										<div class="top-item"> 
											<a href="#"><img src="public/images/banner2-home3.jpg" alt="img-item1" class="img-responsive"></a>
											<p class="text-banner">
												<span>look book</span>
											</p>
										</div>	
									</div>
									<div class="col-md-4">
										<div class="top-item"> 
											<a href="#"><img src="public/images/banner3-home3.jpg" alt="img-item1" class="img-responsive"></a>
											<p class="text-banner">
												<span>look book</span>
											</p>
										</div>	
									</div>
								</div>
							</div>	
						</div>
						<div class="header-product">
							<div class="container">
								<div class="pos-title">
									<p>New collection</p>
									<h2>Featured Products</h2>
								</div>
							</div>
						</div>

						<div class="product">
							<div class="container">
								<div class="row">
									<?php foreach ($products as $key => $product): ?>
										<div class="col-md-4">
											<div class="item-product">
												<a class="new-box" href="#">
													<span class="new-label">New</span>
												</a>
												<a href="Details.php?id=<?php echo $product['product_id']; ?>"><img src=<?php echo 'public/images/'.$product['product_image']; ?>></a>
												<div class="evaluate-product">
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>

													</a>

													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>

													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</div>
												<h3><a href="#"><?php echo $product['product_name']; ?></a></h3>
												<div class="price-product">
													<b>£ <?php echo  $product['product_price']; ?></b>&nbsp&nbsp <i>£ 19.81</i>
												</div>
											</div>
										</div>	
									<?php endforeach ?>

								</div>
							</div>
						</div>
						<div class="container">
							<div class="top-footer">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4 col-xs-4">
												<div class="footer-bolck">
													<h3><a href="#">MY ACCOUNT</a></h3>
													<ul>
														<li><a href="#">My orders</a></li>
														<li><a href="#">My credit slips</a></li>
														<li><a href="#">My addresses</a></li>
														<li><a href="#">My personal info</a></li>
													</ul>
												</div>
											</div>
											<div class="col-md-4 col-xs-4">
												<div class="footer-bolck">
													<h3><a href="#">IFORMATION</a></h3>
													<ul>
														<li><a href="#">Specials</a></li>
														<li><a href="#">New products</a></li>
														<li><a href="#">Best sellers</a></li>
														<li><a href="#">Our stores
														</a></li>
														<li><a href="#">Secure payment
														</a></li>
														<li><a href="#">Sitemap
														</a></li>
													</ul>
												</div>
											</div>
											<div class="col-md-4 col-xs-4">
												<div class="footer-bolck">
													<h3><a href="#">CATEGORIES</a></h3>
													<ul>
														<li><a href="#">Women</a></li>
														<li><a href="#">Men</a></li>
														<li><a href="#">Footwear</a></li>
														<li><a href="#">Jewellery </a></li>
														<li><a href="#">Accessories </a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-xs-12">
										<div class="row">
											<div class="block-smartblog">
												<h3><a href="#">lATEST BLOG</a></h3>
												<div class="col-md-6">
													<div class="img-block">
														<a href="#"><img src="public/images/footer.jpg" alt="" class="img-responsive" ></a>
														<span class="date-smart">2017-11-15 07:48:26</span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="bock-content">
														<h3><a href="#"> Share the Love for PrestaShop 1.6</a></h3>
														<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been...</p>
														<a href="#" class="r_more"><span>Read More</span>
														</a>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
								<div class="row">					
									<div class="footer">
										<div class="col-md-3">
											<h2>BECOME A SUBSRRIBER</h2>
											<p>& GET 10% OFF OUR NEXT ORDER</p>
										</div>	
										<div class="col-md-4">
											<form action="#" method="post">
												<div class="form-group">
													<input class="inputNew form-control grey newsletter-input" id="newsletter-input" type="text" name="email" size="18" value="" placeholder="Enter your e-mail">
													<button type="submit" name="submitNewsletter" class="btn btn-default button button-small">
														<span>Subscribe</span>
													</button>
													<input type="hidden" name="action" value="0">
												</div>
											</form>
										</div>
										<div class="col-md-5">
											<a href="#"><img src="public/images/payment.png" alt="" class="img-responsive"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="footer-bottom">
							<div class="container">
								<div class="row">
									<div class="col-md-2">
										<div class="logo-footer">
											<a href="#"><img src="public/images/logo-footer-hom3.png" alt="" class="img-responsive"></a>
										</div>
									</div>
									<div class="col-md-4">
										<div class="content-footer">
											<p>Address: 123 Main Street, Anytown, CA 12345 USA.</p>
											<p>Phone: (800) 123 456 789</p>
											<p>Email: <a href="#">  demo@posthemes.com</a></p>
										</div>
									</div>
									<div class="col-md-6  col-xs-12">
										<div class="content2-footer col-xs-12">
											<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
											<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
											<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
											<a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a>
											<div class="authors">
												<a href="#"> copyright© | HUYNH CHI CUONG</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>






	</body>
</html>
