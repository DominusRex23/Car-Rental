<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "car_go";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>
