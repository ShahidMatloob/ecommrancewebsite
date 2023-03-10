<?php
	session_start();
	if(isset($_POST['update_cart'])){
		$product_qty = $_POST['product_qty']; //qty array from qty name filed
	
		$cart = $_SESSION ['cart']; 
		
		for($i = 0; $i < count ( $cart ); $i ++) {
			$cart[$i]['product_qty'] = $product_qty[$i];
		}
		
		$_SESSION ['cart'] = $cart;


		
	$_SESSION['message'] = 'Cart updated successfully';
	header('location: ../cart.php');
	
	}
		
?>
