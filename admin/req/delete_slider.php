<?php 
include '../inc/config.php';


if (isset($_GET['slider'])) {
    $slider = $_GET['slider'];
    $query = mysqli_query($connection,"DELETE FROM `slider` WHERE `id` = $slider");
    if ($query) {
        header('location:../slider.php');
    }
}

?>