<?php 
include '../inc/config.php';


if (isset($_GET['sub_category'])) {
    $subCat_id = $_GET['sub_category'];
    $query = mysqli_query($connection,"DELETE FROM `sub_category` WHERE `id` = $subCat_id");
    if ($query) {
        header('location:../sub-category.php');
    }
}

?>