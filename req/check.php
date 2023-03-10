<?php
include '../inc/config.php';
if (isset($_POST['user_name'])) {
    $username = $_POST['user_name'];
    $mysql_query = "SELECT * FROM `user` WHERE `UserName` = '$username'";
    $result = mysqli_query($connection, $mysql_query);
    if (mysqli_num_rows($result) > 0) {
        echo '<span class="text-danger">Username is Taken.</span>';
    }else{
        echo '<span class="text-success">Username is Available.</span>';
    }
}


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $mysql_query = "SELECT * FROM `user` WHERE `UserEmail` = '$email'";
    $result = mysqli_query($connection, $mysql_query);
    if (mysqli_num_rows($result) > 0) {
        echo '<span class="text-danger">Email is already registered.</span>';
    }
}
