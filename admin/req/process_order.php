<?php
include '../inc/config.php';
$order_id = $_GET['order_id'];

$orderProcessQuery = mysqli_query($connection,"UPDATE `orders` SET `order_status` = 'Processing' WHERE `id` = '$order_id' ");
if($orderProcessQuery){
    header('location:../view-order.php?order_id='.$order_id);
}