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

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['id'] = $user_data['id'];
						header("Location: index.html");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login style.css">
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="inner-box" id="card">
				<div class="card-front">
						<h2>Login</h2>
						<form id="login-form" method="post">

							<input type="text" name="user_name" class="inputBox" placeholder="Username required" id="username"><br><br>
							<input type="password" name="password" class="inputBox" placeholder="Password required" id="password"><br><br>

							<button type="submit" class="submit-btn" id="login">Login</button>
							<!-- <input id="button" type="submit" value="Login"><br><br>  -->

							<br><br>

							<input type="checkbox"><span>Remember Me</span>

							<button type="button" class="btn" onclick="document.location='signup.php'">Signup</button>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>