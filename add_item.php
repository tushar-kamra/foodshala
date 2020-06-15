<?php 
    require 'connect.php';
    
	session_start();
	if(strlen($_SESSION['restid'])==0)
	{
	header('location:index.php');
	}
	else {
		// capture restaurnt id
		$res_id=$_SESSION['restid'];

	    if ($_SERVER["REQUEST_METHOD"] == "POST"){
	    	if(isset($_POST['addItem']) && isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_type']) && isset($_POST['item_price']) && isset($_FILES['item_image'])){
	    		$item_name=$_POST['item_name'];
	    		$item_desc=$_POST['item_desc'];
	    		$item_type=$_POST['item_type'];
	    		$item_price=$_POST['item_price'];
	    		$filename = date('Y_m_d_H_i_s_').$_FILES['item_image']['name'];
		        $type = $_FILES['item_image']['type'];
		        $tmp_name = $_FILES['item_image']['tmp_name'];
		        $size = $_FILES['item_image']['size'];
		        $location = "uploads/";
		        $filepath = $location.$filename;

		        if($type == "image/gif" || $type == "image/jpeg" || $type="image/png" || $type="image/jpg"){ 
			        if(move_uploaded_file($tmp_name, $location.$filename)){
			            $sql="INSERT INTO menu (res_id, item_name, item_image, item_price, item_type, item_desc) values ('$res_id', '$item_name', '$filepath', '$item_price', '$item_type', '$item_desc')";
			            if($conn->query($sql) === TRUE){
			              header( "location:restaurant_dashboard.php" );
			            }else{
			              echo "Error: " . $sql . "<br>" . $conn->error;
			            }
			        }else{
			            echo "Failed to Upload.";
			        } 
			    }else{
			        echo "File format is not valid.";
		        }
	    	}
    	}
    }
?>