<?php 
	require 'connect.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);

	if(strlen($_SESSION['custid'])==0)
	{
	header('location:customer.php');
	}
	else {
		header('location:customer_dashboard.php');
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if(isset($_POST['orderBtn']) &&isset($_POST['total_price']) && isset($_POST['address']) && isset($_POST['mobile_number']) && isset($_POST['res_id'])){
		        $user_id = $_SESSION['custid'];
		        $payment_type = $_POST['payment_type'];
		        $address = $_POST['address'];
		        $mobile_number = $_POST['mobile_number'];
		        $date = date('Y/m/d H:i:s');
		        $total_price = $_POST['total_price'];
		        $res_id = $_POST['res_id'];
		        $sql="INSERT INTO orders(user_id, res_id, address, date, mode_of_payment, total, mobile) values ('$user_id', '$res_id', '$address', '$date', '$payment_type', '$total_price', '$mobile_number')";
				$result=$conn->query($sql);
				if($result){
					$emptycart = "DELETE FROM cart WHERE cust_id = '$user_id'";
					$res = $conn->query($emptycart);
					$_SESSION['orderplaced'] = true ;
				}
				else { 
					$_SESSION['orderplaced'] = false ;
				}
	    	}
        }
	}
?>