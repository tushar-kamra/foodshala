<?php 
    require 'connect.php';
	error_reporting(E_ERROR | E_PARSE);
    session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['custSignin']) && isset($_POST['email']) && isset($_POST['pwd'])){
	        $email = $_POST['email'];
	        $password = $_POST['pwd'];
	        $hashpassword = md5($password);
	        $sql="SELECT * from customer where email='$email' and password='$hashpassword'";
	        $result=$conn->query($sql);
	        $row = $result->fetch_assoc();
			$id = $row['id'];
            $count = mysqli_num_rows($result);
	        if($count == 1) {
				$_SESSION['custid'] = $id;
				$_SESSION['invalid'] = false ;
		        header( "location:customer_dashboard.php" );
		    }else {
				$_SESSION['invalid'] = true ;
                header( "location:customer.php" );
		    }
    	}
	}
?>