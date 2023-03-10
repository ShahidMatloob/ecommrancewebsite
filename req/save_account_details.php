<?php
ob_start();
session_start();
include '../inc/config.php';

$user_id = $_SESSION['UserID'];

if (isset($_POST['detail'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    $sql = "UPDATE `user` SET `UserFullName`='$fullName',`UserEmail`='$email',`UserMobile`='$mobile',`UserCity`='$city',`UserState`='$state',`UserCountry`='$country',`UserAddress`='$address' WHERE  `UserId` = '$user_id' ";
    $detail_query = mysqli_query($connection, $sql);
    if ($detail_query) {
       $_SESSION['detail_msg'] = "Details Successfully Updated!";
       header('location:../dashboard.php');
    }
}


if (isset($_POST['password'])) {
    $newPassword = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];
    if ($newPassword == $confirm_new_password) {
        
        $sql = "UPDATE `user` SET `UserPassword`='$newPassword' WHERE  `UserId` = '$user_id' ";
        $password_query = mysqli_query($connection, $sql);
        if ($password_query) {
           $_SESSION['password_msg'] = "Password Successfully Updated!";
           header('location:../dashboard.php');
        }
    }
}







?>