<?php
require_once("DBConnect.php");
session_start();
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
				<button class="button login__submit" name="login">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>

			


			<div class="social-login">
				<a href="http://localhost:3000/index.html"><h3>return home</h3></a>

				<a href="http://localhost:3000/SignIn.php"><h3>create account</h3></a>

				<?php
			if(isset($_POST['login'])){
				if(!empty($_POST['client_name']) && !empty($_POST['client_password'])){
					$client = new Client();
					$client->cname = $_POST['client_name'];
					$client->cpassword = $_POST['client_password'];
					$result = ClientLogin($client);
					if($result == null){
						echo '<span class="customize1" >Error: Server not running!</span>';
					}
					else if($result->num_rows == 0){
						echo '<span class="customize1" >Invalid username or password!!!</span>';
					}
					else{
						$row = $result->fetch_assoc();
						$client->cid = $row['cid'];
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