<?php 
include '../inc/config.php';


if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $query = mysqli_query($connection,"DELETE FROM `category` WHERE `id` = $category");
    if ($query) {
        header('location:../category.php');
    }
}

?>