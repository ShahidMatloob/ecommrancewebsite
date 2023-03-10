<?php
	session_start();

	$product_id = $_GET['product_id'];
	
	foreach($_SESSION['cart'] as $key => $value){
		if($product_id === $value['product_id']){
			unset($_SESSION['cart'][$key]);

		}

	}

	header('location: ../cart.php');
?>
