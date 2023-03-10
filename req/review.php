<?php
ob_start();
session_start();
include '../inc/config.php';

if(isset($_POST['submit_review'])){
    
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $view = $_POST['view'];
    
    $reviewQuery = mysqli_query($connection,"INSERT INTO `review`(`product_id`, `rating`, `name`, `email`, `view`) VALUES ('$product_id','$rating','$name', '$email', '$view')");
    if($reviewQuery){
        header('location:../product.php?product_id='.$product_id);
    }
    
}











?>