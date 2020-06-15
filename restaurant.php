<?php 
	require 'connect.php';
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>FoodShala</title>
	<link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src = "https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src = "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<link rel = "stylesheet" href = "css/customer.css">
</head>
<body>

	<!-- navbar -->
	<nav class="navbar navbar-custom navbar-expand-md  navbar-dark">
		<a class="navbar-brand" href="index.php"><span style="font-size:25px; letter-spacing: 2px ; margin-left: 15px;"><b>Foodshala</b></span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="index.php#menu"><span style="color:white">Menu</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="customer.php"><span style="color:white">Customer</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="restaurant.php"><span style="color:white">Restaurant</span></a>
				</li>    
			</ul>
		</div>  
	</nav>

	<br><br>

	<div class="container header">
		RESTAURANT 
	</div>

	<br><br>

	<?php 
		if(isset($_SESSION['invalid_r'])){
			if($_SESSION['invalid_r'] == true){
	?>
		<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
			<strong>Oops !</strong> You've entered the wrong credentials.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
		$_SESSION['invalid_r'] = null ;
			}
		}
	?>

<?php 
		if(isset($_SESSION['restexist'])){
			if($_SESSION['restexist'] == false){
	?>
		<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
			<strong>Account successfully created !</strong> Login to continue.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
		$_SESSION['restexist'] = null ;
			}
			else {
	?>
	<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
			<strong>Something went wrong !! </strong> Email already exist.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
			$_SESSION['restexist'] = null ;
			}
		}
	?>

	<!-- Signup & Login Form -->
	<div class="container">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-12">
				<div class="card text-center">
					<div class="card-header">
						Sign Up 
					</div>
					<div class="card-body">
						<form action="log_restaurant.php" method="post">
							<div class="form-group">
								<div class="form-row">
									<div class="col-6">
										<label for="rname">Restaurant Name:</label>
									</div>
									<div class="col-6">
										<input type="text" name="rname" id="rname" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-6">
										<label for="city">City:</label>
									</div>
									<div class="col-6">
										<input type="text" name="city" id="city" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-6">
										<label for="mobile">Mobile:</label>
									</div>
									<div class="col-6">
										<input type="text" name="mobile" id="mobile" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-6">
										<label for="email">Email:</label>
									</div>
									<div class="col-6">
										<input type="email" name="email" id="email" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-6">
										<label for="pwd">Password:</label>
									</div>
									<div class="col-6">
										<input type="password" name="pwd" id="pwd" required>
									</div>
								</div>
							</div>
							<button type="submit" name="resSignUp" class="btn "> Sign Up</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-12">
				<div class="card text-center">
					<div class="card-header">
						Login
					</div>
					<div class="card-body">
						<form action="authenticate_restaurant.php" method="post">
							<div class="form-group">
								<div class="form-row">
									<div class="col-6">
										<label for="email">Email:</label>
									</div>
									<div class="col-6">
										<input type="email" name="email" id="email" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-6">
										<label for="pwd">Password:</label>
									</div>
									<div class="col-6">
										<input type="password" name="pwd" id="pwd" required>
									</div>
								</div>
							</div>
							<button type="submit" name = "resSignin" class="btn"> Login</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>



</body>
</html>