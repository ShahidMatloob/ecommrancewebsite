<?php
include '../inc/config.php';
if (isset($_POST['subcategory'])) {
    
    $sub_category = $_POST['sub_category'];
    $parent_id = $_POST['parent_id'];


    $query = mysqli_query($connection,"INSERT INTO `sub_category`(`sub_category`, `parent_id`) VALUES ('$sub_category','$parent_id')");
    if($query){
        header('location:../sub-category.php');
    }
}