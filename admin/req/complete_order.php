<?php
include '../inc/config.php';
$order_id = $_GET['order_id'];

$orderCompleteQuery = mysqli_query($connection,"UPDATE `orders` SET `order_status` = 'Complete' WHERE `id` = '$order_id' ");
if($orderCompleteQuery){
    header('location:../view-order.php?order_id='.$order_id);
}