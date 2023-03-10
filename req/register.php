<?php
ob_start();
session_start();
include '../inc/config.php';
if (isset($_POST['register'])) {
    $fullName  = $_POST['fullName'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];

    $user_check_query = "SELECT * FROM `user` WHERE `UserEmail` ='$email'";
    $result = mysqli_query($connection, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {      
        if ($user['UserEmail'] == $email) {
            $_SESSION['message'] = "Email already Registered.";
            header('location:../my-account.php');
            exit();
          }    
    } else {

        $sql = "INSERT INTO `user`(`UserFullName`, `UserEmail`, `UserPassword`) 
                            VALUES ('$fullName', '$email', '$password')";
        $run = mysqli_query($connection, $sql);
        if ($run) {
            $sql = "SELECT * FROM `user` WHERE `UserEmail` = '$email' AND `UserPassword` = '$password' ";
            $result = mysqli_query($connection, $sql);
            $user_login = mysqli_fetch_assoc($result);
        
            $_SESSION['UserID'] = $user_login['UserID'];
            header('location:../dashboard.php');
            
        }
    }








}