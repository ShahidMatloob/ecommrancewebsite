<?php
include '../inc/config.php';
$order_id = $_GET['order_id'];

$orderCancelQuery = mysqli_query($connection,"UPDATE `orders` SET `order_status` = 'Canceled' WHERE `id` = '$order_id' ");
if($orderCancelQuery){
    header('location:../view-order.php?order_id='.$order_id);
}