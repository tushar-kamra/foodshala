<?php
	require 'connect.php';
	session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['custSignUp']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['preference']) && isset($_POST['mobile']) && isset($_POST['pwd'])){

	        $first_name = $_POST['fname'];
	        $last_name = $_POST['lname'];
	        $email = $_POST['email'];
	        $preference = $_POST['preference'];
	        $contact_number = $_POST['mobile'];
	        $password = $_POST['pwd'];
	        $hashpassword = md5($password);

			$checkquery = "SELECT * FROM customer where email = '$email'" ;
			$checkresult = $conn->query($checkquery);
			$num = $checkresult->num_rows ;

			if($num == 0){
				$sql="INSERT INTO customer (fname, lname, email, preference, contact_number, password) values ('$first_name', '$last_name', '$email', '$preference', '$contact_number', '$hashpassword')";
				$result=$conn->query($sql);
				if($result){
					$_SESSION['userexist'] = false ;
					header( "location:customer.php" );
				}
			}
			else {
				$_SESSION['userexist'] = true ;
				header( "location:customer.php" );
			}
    	}
	}
?>