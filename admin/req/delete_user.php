<?php 
include '../inc/config.php';


if (isset($_GET['user'])) {
    echo $user_id = $_GET['user'];
    $query = mysqli_query($connection,"DELETE FROM `user` WHERE `UserID` = '$user_id' ");
    if ($query) {
        header('location:../users.php');
    }
}

?>