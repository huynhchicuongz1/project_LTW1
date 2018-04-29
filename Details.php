<?php 
session_start();
ob_start();
require_once './config/database.php';
require_once "header.php";
spl_autoload_register(function($class_name) {
  require './app/Models/' . $class_name . '.php';
});
$id=$_GET['id'];
$objproducts = new Product();
$product = $objproducts->getItemById($id);



if (isset($_GET['btn-add'] )) {
  if (!isset($_SESSION['cart'][$id])) {
   $_SESSION['cart'][$id]=$_GET['quantity'];
 } else {
  $_SESSION['cart'][$id]+=$_GET['quantity'];
}
header('location:cart.php');
}

if (isset($_SESSION['current_user'])) 
{
  $current_user = $_SESSION['current_user'];
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Details</title>
  
  
  <style type="text/css">
  .product-dt {
    margin: 30px;
    padding-left: 35px;

  }
  .product-dt img {

    margin-left: 60px;

  }
  .product-dt .price{  
    color: rgb(108,143,99);
    font-size: 15pt;
    font-weight: bold;
    font-style: italic;
  }
  .product-dt p{
    font-style: italic;
  }
  .product-dt h1{
    color:rgb(71,173,211);
  }
  .product-dt h1>a:link{
    text-decoration: none;
    color: rgb(71,173,211);
  }
  .product-dt p>a:link{
    text-decoration: none;
    color:black;
  }
  .product-dt .addcart{
    background: #47add3;
    color: white;
    text-decoration: none;
    padding: 5px;
    border-radius: 5px;
  }
  .product-dt .addcart:hover{
    background: #375561;
  }
  .header-product{
    margin-top: 20px;
  }
  .top-footer{
    border-top: 1px solid #efefef;
  }
  .product-dt img {
    /* margin-left: 60px; */
    width: 300px;
  }
</style>

</head>
<body>
  <div class="top-sub">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <form action="search_result.php" method="GET">
            <input class="search" type="text" id="search" name="search_query" placeholder="Search" value="" >
            <button type="submit" name="submit_search" class="button-search" value="true">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </form>
        </div>
        <div class="col-md-5">
          <div class="cart" style="float: right; padding: 10px;">
            <a href="cart.php">Checkout 
              <?php 
              if (isset($_SESSION['cart'])) {
                $total_qty = 0;
                foreach ($_SESSION['cart'] as $key => $value) {
                  $total_qty += $value;
                }
                echo '(' . $total_qty .')';
              }
              ?>
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="dropdown">
            <div class="top-btn" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >
              <a href="#">
                <?php if (isset($current_user)) {
                  echo $current_user[0]['user_fullname'];
                }else{
                  echo "Account";
                } ?>
              </a>
              <span class="caret"></span></div>
              <ul class="dropdown-menu">
                <?php if (isset($current_user)) {
                  echo '<li><a href="myaccount.php?username=' . $current_user[0]["user_name"] .'">Manage my account</a></li>';
                  echo '<li><a href="logout.php">Logout</a></li>';
                }else{
                  echo "<li><a href='login.php'>Login</a></li>";
                  echo "<li><a href='formregistration.php' >Register</a></li>";
                } ?>
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
                    <a class="navbar-brand" href="index.php"><img src="public/images/posbrize-logo-1448548663.jpg" alt="logo"></a>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="index.php"  >Home</a></li>
                      <li ><a href="#" >Máy tính</a></li>
                      <li ><a href="#" >Laptop</a></li>
                      <li ><a href="#" >Điện thoại</a></li>
                      <li ><a href="#" >Thiết bị khác</a></li>
                      <li ><a href="formregistration.php" >Đăng kí</a></li>
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
        <h2>See details</h2>
      </div>
    </div>
  </div>
  <div class="product-dt">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="details-img">
            <img src='public/images/<?php echo $product[0]['product_image'];?>'>
          </div>
          
        </div>
        <div class="col-md-8">
          <form action="Details.php" method="GET">

           <h1><?php echo $product[0]["product_name"]?></h1>
           <b>Giá: </b> <span class='price'><?php echo $product[0]['product_price'];?>VND</span><br>
           <p><?php echo $product[0]['product_desc'];?></p>
           <label>Số Lượng</label>
           <input type="text" name="quantity" value="1">
           <input type="hidden" name="id" value="<?php echo $product[0]['product_id']; ?>">
           <br>
           <br>

           <button type="submit" class="addcart" name="btn-add" value="clicked">Add To Cart</button>
           <a class="addcart" href="cart.php">View Cart</a>
         </form>



       </div>   
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
                
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-xs-4">
            <div class="footer-bolck">
              <h3><a href="#">CATEGORIES</a></h3>
              <ul>
                <li ><a href="#" >Máy tính</a></li>
                <li ><a href="#" >Laptop</a></li>
                <li ><a href="#" >Điện thoại</a></li>
                <li ><a href="#" >Thiết bị khác</a></li>
                <li ><a href="formregistration.php" >Đăng kí</a></li>
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
</div>
</body>
</html>