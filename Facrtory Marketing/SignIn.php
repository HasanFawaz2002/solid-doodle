<?php
require_once("DBConnect.php");
session_start();
$con = ConnectToDB('localhost', 'root', '', 'FactoryMarketing');
?>


<head>
    <link rel="stylesheet" href="login.css">
</head>


<div class="container">
	<div class="screen">


		<div class="screen__content">
			<form class="login" method="POST">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" placeholder="User name / Email" name="client_name" >
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="Password" name="client_password" >
				</div>
				<button class="button login__submit" name="submit">
					<span class="button__text">Sign In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>

			


			<div class="social-login">
				<a href="http://localhost:3000/index.html"><h3>return home</h3></a>

				<?php
			if(isset($_POST['submit'])){
				if(!empty($_POST['client_name']) && !empty($_POST['client_password'])){
					$client = new Client();
					$client->cname = $_POST['client_name'];
					$client->cpassword = $_POST['client_password'];
					$result = CreateClientAccount($con,$client);
					if($result == false){
						echo '<span class="customize1" >An account exist under same name</span>';
					}
					else{
						$con1 = ConnectToDB('localhost', 'root', '', 'FactoryMarketing');
						$client->cid = getClientId($con1,$client->cname);
						$_SESSION['client_id'] = $client->cid;
						$_SESSION['client_name'] = $client->cname;
						header("location: Products.php");
					}
				}
				if(empty($_POST['client_name'])){
					echo '<span class="customize1" >username is required!!!</span>';
				}
				if(empty($_POST['client_password'])){
					echo '<span class="customize1" >password is required!!!</span>';
				}
			}
			?>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>