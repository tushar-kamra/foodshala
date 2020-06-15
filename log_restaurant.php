<?php 
    require 'connect.php';
    
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['resSignUp']) && isset($_POST['rname']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['city']) && isset($_POST['pwd'])){

	        $res_name = $_POST['rname'];
	        $res_email = $_POST['email'];
	        $res_number = $_POST['mobile'];
	        $res_city = $_POST['city'];
	        $res_password = $_POST['pwd'];
			$hashrespassword = md5($res_password);
			
			$checkquery = "SELECT * FROM restaurant where res_email = '$res_email'" ;
			$checkresult = $conn->query($checkquery);
			$num = $checkresult->num_rows ;

			if($num == 0){
				$sql="INSERT INTO restaurant (res_name, res_city, res_number, res_email, res_password) values ('$res_name', '$res_city', '$res_number', '$res_email', '$hashrespassword')";
				$result=$conn->query($sql);
				if($result){
					$_SESSION['restexist'] = true ;
					header( "location:restaurant.php" );
				}
			}
			else {
				$_SESSION['restexist'] = false ;
				header( "location:restaurant.php" );
			}

    	}
	}
?>