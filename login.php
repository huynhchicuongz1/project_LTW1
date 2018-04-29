<?php 
session_start();
ob_start();
include_once"config/database.php";
spl_autoload_register(function($class_name){
	require './app/models/'. $class_name .'.php';
});

$hdlUser = new HandleUser();
$users = $hdlUser->getAllUsers();



?>

<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>login screen</title>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<link rel="stylesheet" href="public/css/style_login.css">
	<script>
		$(document).ready(function() {
			$('#btn-reset').click(function() {
				$('input').val('');
			});	
		});
		
	</script>
</head>

<body>
	
	<div class="wrapper">
		<div class="container">
			<h1>Welcome</h1>
			<form action="login.php" class="form" method="POST">
				<input type="text" name="username" placeholder="Username">
				<input type="password" name="password" placeholder="Password">
				<button type="submit" id="btn-login" name="btnlogin" value="login">Login</button>
				<button type="button" id="btn-reset" name="btnlogin" value="login">Reset</button>
			</form>
			<div class="result">
				<?php 
				if (isset($_POST['btnlogin'])) {
					$current_user =$hdlUser->login($_POST['username'], $_POST['password']);

					if ($current_user) {

						if ($current_user[0]['user_lever']==1) {
							$_SESSION['current_admin']=$current_user;
							header('location: admin.php');
						}
						else if ($current_user[0]['user_lever']==2) {
							$_SESSION['current_user']=$current_user;
							header('location: index.php');
						}
					} else {
						echo "Login failed";
					}
				}
				?>
			</div>
		</div>



		<ul class="bg-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</body>

</html>