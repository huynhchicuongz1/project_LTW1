<?php
session_start();
ob_start(); 
require_once './config/database.php';
spl_autoload_register(function($class_name) {
	require	'./app/Models/' . $class_name . '.php';
});

$objproducts= new Product();

$products= $objproducts->getAllItems();
if (isset($_SESSION['current_admin'])) 
{
	$current_user = $_SESSION['current_admin'];
}else{
	header('location:index.php');
} 
?>