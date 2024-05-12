<!DOCTYPE html>
<html lang="en">
<head>
	<title>Se connecter </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

	<?php require 'assets/function.php'; ?>
	<?php
        $con = new mysqli('localhost','root','','mybank');
    
        session_start();
            $error = "";
    		if (isset($_POST['adminLogin']))
            {
                
                $user = $_POST['email'];
                $pass = $_POST['password'];
               
                $result = $con->query("select * from login where email='$user' AND password='$pass' AND type='manager'");
                if($result->num_rows>0)
                { 
                  $data = $result->fetch_assoc();
                  $_SESSION['managerId']=$data['id'];
                  //$_SESSION['user'] = $data;
                  header('location:mindex.php');
                 }
                else
                {
                  $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
                }
            }
    
 ?>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/tt.jpg');">
			<div class="wrap-login100">
				<form method="POST" class="login100-form validate-form">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Se connecter
					</span>
					<br>
					<?php echo $error ?>
					<br>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text"  name="email" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password"  name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Se souvenir de  moi
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" name="adminLogin" class="login100-form-btn">
							se connecter
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Mot de passe oublie?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
