<?php 
include '../inc/config.php';


if (isset($_GET['product'])) {
    $product = $_GET['product'];
    $query = mysqli_query($connection,"DELETE FROM `products` WHERE `id` = $product");
    if ($query) {
        header('location:../products.php');
    }
}

?>