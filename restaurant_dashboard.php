<?php 
	require 'connect.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);

	if(strlen($_SESSION['restid'])==0)
	{
	    header('location:restaurant.php');
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
	<style>
		.header {
			border-top: 2px solid white;
			border-bottom: 2px solid white;
			color: white;
			text-align: center;
			padding: 10px ;
			font-size: 20px;
			font-weight: bolder;
			letter-spacing: 3px;
		}
		div.card-body p{
			font-size: 13px;
			margin-top: -10px;
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
					$id = $_SESSION['restid'];
					$sql = "SELECT * FROM restaurant WHERE id = $id";
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
				?>
				<li class="nav-item">
					<a class="nav-link active" href="#"><span style="color:white; font-size:20px">Welcome, <?php echo $row['res_name'] ?></span></a>
				</li>   
				<li class="nav-item">
					<button type="button" class="btn btn-warning" onclick="location.href='restaurant_dashboard.php'">
						Dashboard
					</button>  
				</li>  
				<li class="nav-item">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#form">
						Add Item
					</button>  
				</li>   
				<li class="nav-item">
					<button type="button" class="btn btn-primary" onclick="location.href='view_order.php'">
						View Order
					</button>  
				</li>  
				<form method="get" action="logout.php"> 
		        	<li class="nav-item">
						<button name="res_logout" type="submit" class="btn btn-danger">Logout</button>
					</li>
		    	</form>
			</ul>
		</div>  
	</nav>

	<br><br>


	<div class="container header">
		WHAT WE SERVE 
	</div>

	<br><br>

	<?php 
			$i = $_SESSION['restid'] ;
	    	$sql = "select menu.*, restaurant.res_name from menu, restaurant where menu.res_id=restaurant.id and restaurant.id = $i";
	    	$result = $conn->query($sql);
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
								<form class="cart-form" action="delete_item.php" method="post">
										<input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
										<div style="float:right; margin-top:2px ;"><?php echo '₹'.$row['item_price']; ?></div> 
										<button name="addCartBtn" id="addCartBtnid" class="addCartBtnid btn btn-sm btn-info ">Delete</button>
								</form>	
							</div>
						</div>
					<?php } ?> 
				</div>
			</div>
		</div>

	<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">What you want to serve?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="add_item.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="item_name">Item Name</label>
							<input type="text" id="item_name" name="item_name" required/>
						</div>
						<div class="form-group">
							<label for="item_image">Item Image</label>
							<input type="file" name="item_image" class="uploader" onchange="readURL(this);" required /><br>
							<span class="text-muted" style="font-size: 14px;">JPG, GIF or PNG. Max size of 800K</span>
							<div class="preview-area">
								<img id="profileImg" src="" />
							</div>
						</div>
						<div class="form-group">
							<label for="item_desc">Item Description</label>
							<input type="text" id="item_desc" name="item_desc" required/>
						</div>
						<div class="form-group">
							<label for="item_type">Item Type</label>
							<input type="radio" name="item_type" value="nonveg" required> Non-Veg 
							<input type="radio" name="item_type" value="veg" required> Veg
						</div>
						<div class="form-group">
							<label for="item_price">Item Price</label>
							<input type="text"  id="item_price" name="item_price" required/>
						</div>		
				</div>
				<div class="form-group modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" name="addItem" class="btn btn-success">Add Item</button>
				</div>
					</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('.uploader').on('click', function(){
			$('.preview-area').css({
				'display': 'block'
			});
		});

		function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profileImg')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
	</script>

</body>
</html>
<?php } ?>