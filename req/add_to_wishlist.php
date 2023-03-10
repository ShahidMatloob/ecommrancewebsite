<?php 
session_start();
include '../inc/config.php';
if(isset($_GET['wish_product_id'])){
    if(!isset($_SESSION['UserID'])){

        header('location:../wishlist.php');

    }else{
        $user_id = $_SESSION['UserID'];
        $created_at = date("d/m/Y h:i A") ;
        $product_id = $_GET['wish_product_id'];

        $wishQuery = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'");
        $wish = mysqli_fetch_assoc($wishQuery);
        if ($product_id == $wish['product_id'] && $user_id == $wish['user_id']) {
            $_SESSION['wish_msg'] = "Product Already in Wishlist.";
            header('location:../wishlist.php');
        }else{
            $wishQuery = mysqli_query($connection,"INSERT INTO `wishlist`(`user_id`, `product_id`, `created_at`) VALUES ('$user_id','$product_id','$created_at')");
            $_SESSION['wish_msg'] = "Product Added to Wishlist.";
            header('location:../wishlist.php');
        }

    }

}










?>