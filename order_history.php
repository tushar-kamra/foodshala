<?php 
	require 'connect.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);

	if(strlen($_SESSION['custid'])==0)
	{
	    header('location:customer.php');
	}
	else {
?>

<!DOCTYPE html>
<html>
<head>
	<title>FoodShala</title>
	<link rel = "stylesheet" href = "css/style.css">
	<link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src = "https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src = "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<style type="text/css">
		div.card-body p{
			font-size: 13px;
			margin-top: -10px;
		}
		#item_quantity {
			width: 30px;
			float: right;
			border-radius:5px; 
			border:1px solid black; 
			text-align:center;
		}

		#item_quantity:focus {
			outline: none;
  			box-shadow: none;
		}

		.cart-form span{
			margin: 2px 3px; 
		}

		.menu-card {
			margin: 10px ;
			border-radius: 20px;
		}

		.menu-card img{
			border-radius: 20px;
		}
	</style>
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
				<?php
					$id = $_SESSION['custid'];
					$sql = "SELECT * FROM customer WHERE id = $id";
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
				?>
				<li class="nav-item">
					<a class="nav-link active" href="#"><span style="color:white; font-size:20px">Welcome, <?php echo $row['fname'] ?></span></a>
				</li>   
                <li class="nav-item">
					<button type="button" class="btn btn-warning" onclick="location.href='customer_dashboard.php'">
						Dashboard
					</button>  
				</li>  
				<li class="nav-item">
					<button type="button" class="btn btn-success" onclick="location.href='view_cart.php'">
						View Cart
					</button>  
				</li>   
				<li class="nav-item">
					<button type="button" class="btn btn-primary" onclick="location.href='order_history.php'">
						Order History
					</button>  
				</li>  
				<form method="get" action="logout.php"> 
		        	<li class="nav-item">
						<button name="cust_logout" type="submit" class="btn btn-danger">Logout</button>
					</li>
		    	</form>
			</ul>
		</div>  
	</nav>

		<br><br>

        <?php 
			$user_id = $_SESSION['custid'];
	    	$sql = "select * from orders where user_id = '$user_id'";
	    	$result = $conn->query($sql);
	    ?>

		<div class="container">
			<div class="row">
				<?php
					while($row = $result->fetch_assoc()){ ?>
						<div class="card menu-card" style="width: 22rem;">
							<div class="card-body">
								<h5 class="card-text">Order ID : #<?php echo $row['id']; ?></h5> <br>
								<p class="card-text">Price - <?php echo $row['total']; ?></p>
								<p class="card-text">Mobile - <?php echo $row['mobile']; ?></p>
								<p class="card-text text-muted">Date - <?php echo $row['date']; ?> </p>
							</div>
						</div>
					<?php } ?> 
				</div>
			</div>
		</div>



</body>
</html>
 <?php 
	}
?>