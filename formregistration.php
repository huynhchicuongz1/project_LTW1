<?php
require_once './config/database.php';
spl_autoload_register(function($class_name) {
  require './app/Models/' . $class_name . '.php';
});
	if (isset($_POST['btnsubmit'])) {
		$objuser = new HandleUser();
		if (!empty($_POST['fullname'])&!empty($_POST['username'])&!empty($_POST['password'])&!empty($_POST['email'])) {
			$fullname = $_POST['fullname'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$objuser->addUser($username,$password,$fullname,$email,2); 
			echo "Regist successfully";
		}
		else{

			echo "Regist successfully";
		}
		
		//$users = $objuser->getAllUsers();
		//var_dump($users);
	}	


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng kí tài khoản</title>
	<link rel="stylesheet" href="bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css">

	<script type="text/javascript" src="public/js/jquery-3.2.1.min.js"></script>

	<!-- <script type="text/javascript">
		function validateForm() {
			if (validateFullname() & validateEmail() & validateRePassword()) {
				return true;
			}
			else {
				return false;
			}
		}

		function validateFullname() {
			var field = $('#username').val();
			var filter = /^[a-zA-Z0-9]{3,}(\s?[a-zA-Z0-9]+)*$/;

			if (!filter.test(field)) {
				$('#username').parent().parent().addClass('has-error');
				$('#username').parent().parent().removeClass('has-success');
				$('#username').next().html('Sai ten');
				return false;
			}
			else {
				$('#username').parent().parent().removeClass('has-error');
				$('#username').parent().parent().addClass('has-success');
				$('#username').next().html('');
				return true;
			}
		}

		function validateEmail() {
			var field = $('#email').val();
			var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[a-z]{2,4})+$/;

			if (!filter.test(field)) {
				$('#email').parent().parent().addClass('has-error');
				$('#email').parent().parent().removeClass('has-success');
				$('#email').next().html('Sai email');
				return false;
			}
			else {
				$('#email').parent().parent().removeClass('has-error');
				$('#email').parent().parent().addClass('has-success');
				$('#email').next().html('');
				return true;
			}
		}

		function validateRePassword() {
			var psw = $('#password').val();
			var repsw = $('#repassword').val();

			if (repsw != psw) {
				$('#repassword').parent().parent().addClass('has-error');
				$('#repassword').parent().parent().removeClass('has-success');
				$('#repassword').next().html('Password khong giong');
				return false;
			}
			else {
				$('#repassword').parent().parent().removeClass('has-error');
				$('#repassword').parent().parent().addClass('has-success');
				$('#repassword').next().html('');
				return true;
			}
		}


		


	</script> -->
</head>
<body>
	<div class="container">
		<form action="formregistration.php" method="POST" class="form-horizontal" ">
				<div class="form-group">
					<legend>Đăng kí</legend>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="control-label col-sm-2">Fullname</label>
					<div class="col-sm-10">
						<input type="text" name="fullname" id="fullname" class="form-control" placeholder="Input Your Fullname" ">
					</div>
				</div>
				
				<div class="form-group">
					<label for="email" class="control-label col-sm-2" >Email</label>
					<div class="col-sm-10">
						<input type="email" name="email" id="email" class="form-control" placeholder="Input Your Email">
					</div>
				</div>
				<div class="form-group">
					<label for="username" class="control-label col-sm-2">UserName</label>
					<div class="col-sm-10">
						<input type="text" name="username" id="username" class="form-control" placeholder="Input Your Username" >
						
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="control-label col-sm-2">Password</label>
					<div class="col-sm-10">
						<input type="password" name="password" id="password" class="form-control" placeholder="Input Your Password" >
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" name="btnsubmit" class="btn btn-primary">Đăng kí</button>
					</div>
				</div>
		</form>
	</div>
		
</body>
</html>