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
	    	require 'connect.php';
	    	$sql = "select menu.*, restaurant.res_name from menu, restaurant where menu.res_id=restaurant.id";
	    	$result = $conn->query($sql);
	    ?>


	<?php 
		if(isset($_SESSION['orderplaced'])){
			if($_SESSION['orderplaced'] == true){
	?>
		<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
			<strong>Bon appétit !</strong> Your order has been placed.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
		$_SESSION['orderplaced'] = null ;
			}
			else {
	?>
		<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
			<strong>Something went wrong !! </strong> Please place your order again.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
			}
		}
	?>

		<div class="container">
			<div class="row">
				<?php 
					while($row = $result->fetch_assoc()){ ?>
						<div class="card menu-card" style="width: 22rem;">
							<img src="<?php echo $row['item_image']; ?>" class="card-img-top" alt="Image" style="height: 160px;">
							<div class="card-body">
								<h5 class="card-text"><?php echo ucwords($row['item_name']); ?></h5>
								<p class="card-text"><?php echo ucfirst($row['item_type']); ?></p>
								<p class="card-text text-muted"><?php echo ucfirst($row['item_desc']); ?></p>
								Restaurant Name: <?php echo ucwords($row['res_name']) ?>
								<form class="cart-form" action="add_cart.php" method="post">
										<input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
										<input type="hidden" name="res_id" value="<?php echo $row['res_id']; ?>">
										<input type="hidden" name="item_name" value="<?php echo $row['item_name']; ?>">
										<input type="hidden" name="item_price" value="<?php echo $row['item_price']; ?>">
										<input type="text" id="item_quantity" name="item_quantity" value="1" required/>
										<span style="float:right;"> x </span>
										<div style="float:right; margin-top:2px ;"><?php echo '₹'.$row['item_price']; ?></div> 
										<button name="addCartBtn" id="addCartBtnid" class="addCartBtnid btn btn-sm btn-info ">Add</button>
								</form>	
							</div>
						</div>
					<?php } ?> 
				</div>
			</div>
		</div>

	<script type="text/javascript">
		$('.addCartBtnid').on('click', function(){
			alert("Item added successfully!!");
		});	
	</script>

</body>
</html>
 <?php 
	}
?>