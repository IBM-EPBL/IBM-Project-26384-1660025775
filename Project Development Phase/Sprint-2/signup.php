<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (id,user_name,password) values ('$id','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="login style.css">
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="inner-box" id="card">
				<div class="card-front">
						<h2>Signup</h2>
						<form id="login-form" method="post">

							<input type="text" name="user_name" class="inputBox" placeholder="Username required" id="username"><br><br>
							<input type="password" name="password" class="inputBox" placeholder="Password required" id="password"><br><br>

							<button type="submit" class="submit-btn" id="login">Signup</button>
							<!-- <input id="button" type="submit" value="Login"><br><br> -->

							<!-- <a href="signup.php">Click to Signup</a><br><br> -->
							<button type="button" class="btn" onclick="document.location='login.php'">Login</button>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>