<?php 
	require 'connect.php';
	error_reporting(E_ERROR | E_PARSE);
    session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['resSignin']) && isset($_POST['email']) && isset($_POST['pwd'])){

	        $res_email = $_POST['email'];
	        $res_password = $_POST['pwd'];
	        $reshashpassword = md5($res_password);

	        $sql="SELECT * FROM restaurant where res_email='$res_email' and res_password='$reshashpassword'";
	        $result=$conn->query($sql);
	        $row = $result->fetch_assoc();
			$id = $row['id'];
	        $count = mysqli_num_rows($result);
	        if($count == 1) {
				$_SESSION['invalid_r'] = false ;
	        	$_SESSION['restid'] = $id;
		        echo "You successfully logged in!! You are being redirected..";
		        header( "location:restaurant_dashboard.php" );
		    }else {
				$_SESSION['invalid_r'] = true ;
                header( "location:restaurant.php" );
		    }
    	}
	}
?>