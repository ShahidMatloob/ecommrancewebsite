<?php
session_start();
unset($_SESSION["UserID"]);
header("Location:../my-account.php");
?>