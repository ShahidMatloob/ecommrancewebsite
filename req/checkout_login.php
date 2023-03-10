<?php
ob_start();
session_start();
include '../inc/config.php';
if (isset($_POST['login'])) {
    $email  = $_POST['login_email'];
    $password  = $_POST['login_password'];

    $sql = "SELECT * FROM `user` WHERE `UserEmail` = '$email' AND `UserPassword` = '$password' ";
    $result = mysqli_query($connection, $sql);
    $user_login = mysqli_fetch_assoc($result);

    if ($user_login) {
        $_SESSION['UserID'] = $user_login['UserID'];
        header('location:../checkout.php');
        $_SESSION['login_success'] = "Logedin Successfully!";
    } else {

        $_SESSION['login_fail'] = "Email or Password is Wrong!!!";
        header('location:../checkout.php');
    }
}
