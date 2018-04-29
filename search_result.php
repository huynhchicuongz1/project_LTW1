
<?php 
session_start();
ob_start();
require_once "header.php";
require_once './config/database.php';
spl_autoload_register(function($class_name) {
  require './app/Models/' . $class_name . '.php';	
});

$objproduct = new Product();

if (isset($_GET['submit_search'])) {
  if (isset($_GET['search_query'])) {
    $keyword = $_GET['search_query'];
    $products =$objproduct->getItemByName($keyword);
  }
}

 if (isset($_SESSION['current_user'])) 
{
    $current_user = $_SESSION['current_user'];
}



 ?>
 <style type="text/css">
     	table{
        padding: 0;
        border: none;
        border-collapse: collapse;
        border: 1px solid #ddd;
        width: 1170px;
        margin: 50px auto 10px;
      }
      table td {
          padding: 0;
          border: none;
          border-collapse: collapse;
      }
      a {
          color: #666;
          text-decoration: none;
      }
      .table tr>td, 
      .table tr>th {
          border: 1px solid #ddd;
          padding: 8px;
          line-height: 1.42857143;
          vertical-align: top;
          border-top: 1px solid #ddd;
          font-weight: normal;
      }
      .cart_avail {
          text-align: center;
      }
      img {
          vertical-align: top;
          max-width: 100%;
      }
      .cart_summary > thead, 
      .cart_summary > tfoot {
          background: #f7f7f7;
          font-size: 16px;
      }
      .cart_summary td.cart_product {
          width: 120px;
          padding: 15px;
      }
      .page-order .cart_description {
          font-size: 14px;
      }
      .page-order .product-name {
          font-size: 16px;
      }
      .cart_summary td {
          vertical-align: middle!important;
          padding: 20px;
      }
      a {
          color: #666;
          text-decoration: none;
      	outline: none !important;
      }
      .cart_avail .label {
          white-space: normal;
          display: inline-block;
          padding: 6px 10px;
          font-size: 14px;
          border-radius: 0px;
      }
      .cart_summary .price {
          text-align: right;
      }
      .cart_summary .qty {
          text-align: center;
          width: 100px;
      }
      .cart_summary .qty a:hover {
          background: #ff3366;
          color: #fff;
      }
      .form-control {
          display: block;
          width: 100%;
          height: 34px;
          padding: 6px 12px;
          font-size: 14px;
          line-height: 1.42857143;
          color: #555;
          background-color: #fff;
          background-image: none;
          border: 1px solid #ccc;
          border-radius: 4px;
          -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
          -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
          -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
      }
      .form-control:focus {
          border-color: #66afe9;
          outline: 0;
          -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
      }
      .input-sm {
          height: 30px;
          padding: 5px 10px;
          font-size: 12px;
          line-height: 1.5;
          border-radius: 3px;
      }
      .cart_summary .qty input {
          text-align: center;
          max-width: 64px;
          margin: 0 auto;
          border-radius: 0px;
          border: 1px solid #eaeaea;
      }
      .cart_avail .label-success {
          background: #FFF;
          border: 1px solid #55c65e;
          color: #48b151;
          font-weight: normal;
      }
      .cart_summary .qty a {
          padding: 8px 10px 5px 10px;
          border: 1px solid #eaeaea;
          display: inline-block;
          width: auto;
          margin-top: 5px;
      }
      .cart_summary .action {
          text-align: center;
      }
      .cart_summary .action a {
          display: inline-block;
          line-height: 24px;
          background: orange;
          border-radius: 30px;
          text-decoration: none;
          color: white;
          padding: 5px 10px;
      }
      .cart_summary tfoot {
          text-align: right;
      }
      .cart_navigation {
          margin: 10px 10% 40px;
          float: left;
          width: 80%;
      }
      .cart_navigation a.prev-btn {
          float: left;
      }
      .cart_navigation a {
          padding: 10px 20px;
          border: 1px solid #eaeaea;
      }
      .cart_navigation a.prev-btn:before {
          font: normal normal normal 14px/1 FontAwesome;
          content: "\f104";
          padding-right: 15px;
      }
      .cart_navigation a.next-btn {
          float: right;
          background: #ff3366;
          color: #fff;
          border: 1px solid #ff3366;
      }
      .cart_navigation a:hover {
          background: #ff3366;
          color: #fff;
      }
 </style>
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Giỏ hàng</title>
  <script type="text/javascript" src="public/js/jquery-3.2.1.min.js"></script>


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
	                    <li><a href="cart.php">Checkout</a></li>
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
	                          <li class="active"><a href="index.php"  >Home</a></li>
	                          <li ><a href="index.php" >women</a></li>
	                          <li ><a href="index.php" >Men</a></li>
	                          <li ><a href="index.php" >Footwear</a></li>
	                          <li ><a href="index.php" >Jewellery</a></li>
	                          <li ><a href="index.php" >Accessories</a></li>
	                        </ul>



	                      </div><!-- /.navbar-collapse -->
	                    </div>
	                  </nav>
	                </div>


	                
	              </div>
	            </div>
	      </div>
	    </div>
  	</div>
  <div class="header-product">
              <div class="container">
                <div class="pos-title">
                  <h2>See Cart</h2>
                </div>
              </div>
  </div>
	<div class="container">
		<div class="cart-product">
			<table class="table table-bordered cart_summary">
				<thead>
					<tr>
						<th class="cart_product">Product</th>
						<th>Name</th>
						
						<th>Unit price</th>
						<th>Action</th>
						
            </th>
					</tr>
				</thead>
        <?php if (isset($products)): ?>
          
				<?php foreach ($products as $product ): ?>
					<tbody>
					<tr>
						
            
						<td class="cart_product">
							<a href="#"><img src="public/images/<?php echo $product['product_image'];  ?>" alt="Product" class="img-responsive">
							</a>
						</td>
						<td class="cart_description">
							<p class="product-name"><a href="#"><?php echo $product["product_name"];?></a></p>		
						</td>	
						<td class="price">
              <span><?php echo $product["product_price"];  ?></span>
						</td>
            <td class="action">
              <a href="cart.php?action=add&id=<?php echo $product['product_id']; ?>&qty=1">Add to cart</a>
            </td>
						
						
					</tr>
          </form>
          </tbody>
				<?php endforeach ?>	
				<?php endif ?>

  		  </table>	
    		<div class="cart_navigation ">
        <a class="prev-btn" href="index.php">Continue shopping</a>
        <a class="next-btn" href="#">Buy</a>
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
                      <p>Address: Thủ đức</p>
                      <p>Phone: (800) 123 456 789</p>
                      <p>Email: <a href="#">  Huynhchicuongz1@gmail.com</a></p>
                    </div>
                  </div>
                  <div class="col-md-6  col-xs-12">
                    <div class="content2-footer col-xs-12">
                      <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                      <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                      <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                      <a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a>
                      <div class="authors">
                        <a href="#"> copyright© | HUYNH CHI CUONG- TRAN DUC PHUONG</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
</body>
</html>