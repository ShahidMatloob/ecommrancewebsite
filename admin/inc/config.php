<?php
date_default_timezone_set("Asia/Karachi");
$servername = "localhost";
$username = "paksafet_sassu";
$password = "sass123456@";
$db = "paksafet_sass";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}
?>