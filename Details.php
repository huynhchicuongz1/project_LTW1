<?php 
session_start();
ob_start();
require_once './config/database.php';
spl_autoload_register(function($class_name) {
  require './app/Models/' . $class_name . '.php';
});
$id=$_GET['id'];
$objproducts = new Product();
$product = $objproducts->getItemById($id);
  $_SESSION['product']=$product;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="public/css/style_detail.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class='sanpham'>
      <div class="row">
        <div class="col-md-4">
          <div class="details-img">
            <img src='public/images/<?php echo $product[0]['product_image'];?>'>
          </div>
          
        </div>
        <div class="col-md-8">
          
            <h1><?php echo $product[0]["product_name"]?></h1>
         <b>Giá: </b> <span class='gia'><?php echo $product[0]['product_price'];?></span><br>
          <p><?php echo $product[0]['product_desc'];?></p>
          <a class="addcart" href="cart.php?id=<?php echo $product[0]['product_id']; ?>">Add To Cart</a>  
          
        </div>   
      </div>
    </div>
  </div>
    
</body>
</html>