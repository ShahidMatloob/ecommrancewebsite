<?php 
session_start();
include '../inc/config.php';
if (isset($_POST['login'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    if ($username == 'sass_admin' && $password == 'sass_admin123@') {
        $_SESSION['user'] = $username;
        header('location:../dashboard.php');
    }else{
        $_SESSION['msg'] = "Username or Password is Wrong!";
        header('location:../index.php');
    }
}


