<?php

include '../inc/config.php';    


if(isset($_GET['wish_product_id'])){
    $wish_productId = $_GET['wish_product_id'];
    $remove_wish = mysqli_query($connection,"DELETE FROM `wishlist` WHERE `product_id` = '$wish_productId' ");
    if ($remove_wish) {
        $_SESSION['wish_msg'] = "Product Removed From Wishlist.";
        header('location:../wishlist.php');
}
}