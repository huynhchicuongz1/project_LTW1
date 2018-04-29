<?php
session_start();
ob_start();

if (isset($_GET['action'])&&isset($_GET['id'])) {
	if ($_GET['action']=="delete") {
		unset($_SESSION['cart'][$_GET['id']]);
	}
 	else if ($_GET['action']=="edit") {
 		$_SESSION['cart'][$_GET['id']]=$_GET['qty'];
 	}
 	
 	 header('location:cart.php');
 } 
 	
 ?>