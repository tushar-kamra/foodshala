<?php
include "connect.php";
    $id=$_GET['id'];
	header('location:view_cart.php');
	$sql = "delete from cart where id='$id'";
	$result1  = $conn->query($sql);
?>