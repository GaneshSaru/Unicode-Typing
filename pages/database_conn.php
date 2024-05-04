<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
//$dbName = "login_signup";
$dbName = "unicode_nepali_typing";    

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Something went wrong");
}
?>