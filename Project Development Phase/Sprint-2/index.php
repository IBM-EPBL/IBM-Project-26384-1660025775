<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>STR Profile</title>
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- custom css file link  -->
        <link rel="stylesheet" href="profile.css">

    </head>

    <body style = "background : url(https://images.unsplash.com/photo-1499529112087-3cb3b73cec95?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1074&q=80); background-size: 100% ">

        <!-- <div class="row">
            <div class="logo">
                <i class="fas fa-user-circle"></i>
				
            </div>
        </div> -->
		
		<div class="back">
			<a href="index.html"></a>
		</div>
		<section class="about-section section">
			<div class="container">
					<div class="section-title">
						<h2 data-heading="main info" class="title">Profile</h2>
					</div>
				<div class="row">
					<div class="logo">
						<i class="fas fa-user-circle"></i>
					</div>
					<div class="about-info">
						<p><span>Username: <?php echo $user_data['user_name']; ?></span></p> 
					</div>
				</div>
				<button type="button" class="btn" onclick="document.location='logout.php'">Logout</button>
			</div>
		</section>

    </body>
</html>