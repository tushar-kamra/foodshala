<?php
    include "connect.php";
    $id=$_POST['item_id'];
	header('location:restaurant_dashboard.php');
	$sql = "delete from menu where item_id='$id'";
	$result1  = $conn->query($sql);
?>