<?php
session_start();
include '../inc/config.php';    
if(isset($_GET['product_id'])){

    $productId = $_GET['product_id'];
    if(isset($_GET['product_qty'])){
        $productQty = $_GET['product_qty'];
    }else{
        $productQty = 1;
    }
    
    $cartarray = $_SESSION['cart'];

    $already = false;
    //  if already exists then update quantity
    foreach ($cartarray as $key => $value){

        if($productId == $cartarray[$key]['product_id']){
            $already= true;
            if(isset($_GET['product_qty'])){
                $productQty = $_GET['product_qty'];
                $cartarray[$key]['product_qty'] = $cartarray[$key]['product_qty'] + $productQty;
            }else{
                $cartarray[$key]['product_qty'] = $cartarray[$key]['product_qty'] + 1;
            }
        
        }

    }
    if(!$already){
        array_push($cartarray,array('product_id'=>$productId,'product_qty' => $productQty));
    }

    $_SESSION['cart'] =   $cartarray;
    $_SESSION['message'] = 'Product Successfully Added.';

    header('location: ../cart.php');

}


if(isset($_GET['wish_product_id'])){
    $wish_productId = $_GET['wish_product_id'];
    $productQty = 1;
    
    $cartarray = $_SESSION['cart'];

    $already = false;
    //  if already exists then update quantity
    foreach ($cartarray as $key => $value){

        if($wish_productId == $cartarray[$key]['product_id']){
            $already= true;
            $cartarray[$key]['product_qty'] = $cartarray[$key]['product_qty'] + 1;
            $remove_wish = mysqli_query($connection,"DELETE FROM `wishlist` WHERE `product_id` = '$wish_productId' ");
        }
    }
    if(!$already){
        array_push($cartarray,array('product_id'=>$wish_productId,'product_qty' => $productQty));
        $remove_wish = mysqli_query($connection,"DELETE FROM `wishlist` WHERE `product_id` = '$wish_productId' ");
    }

    $_SESSION['cart'] =   $cartarray;
    $_SESSION['message'] = 'Product Successfully Added.';

    header('location: ../cart.php');
    
}
?>
