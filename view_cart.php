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
	    	$sql = "select * from cart where cust_id = '$user_id'";
	    	$result = $conn->query($sql);
	    ?>

        <div class="container">
                <div class="card text-center">
                    <h5 class="card-header">Bill</h5>
                    <div class="card-body">
                        <?php 
                            $sum = 0;
                            while($row = $result->fetch_assoc()){ ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <span class="card-title"><?php echo ucwords($row['item_name']); ?></span>
                                        <a class="pull-right btn btn-sm btn-danger remove-item" href="delete.php?id=<?php echo $row['id'];?>">remove item</a> 
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="card-text"><?php echo '₹'.$row['item_price']; ?> x <?php echo $row['item_qty']; ?> = <?php echo '₹'.$row['total_price']; ?></p>
                                    </div>
                                    <br><br>
                                </div>
                        <?php 
                            $sum = $sum+$row['total_price'];
                            $res_id = $row['res_id'];
                        } 
 
                    

	    	
	    		if($sum > 0){ ?>
                <div class="row">
                    <div class="col-sm-6">
                    
                    </div>
                    <div class="col-sm-6">
                        <div class="totalprice ">Total Price = ₹<?php echo $sum; ?></div>
                    </div>
                </div>

                    </div>
                
	    	<?php }else{ ?>
	    		<p class="text-center">Cart is empty :(</p>
	    	<?php } ?>
	    	
	    		
	    	<form action="place_order.php" method="post">
	    		<input type="hidden" name="cart_price" value="<?php echo $sum; ?>">
	    		<input type="hidden" name="res_id" value="<?php echo $res_id; ?>">
	    		<button class="btn btn-success">CHECKOUT </button>
	    	</form>
            <br>
	    	</div>
        </div>

		</div>	
	    		    
	</div>

		
			
	    		    
	

	

</body>
</html>
 <?php 
	}
?>