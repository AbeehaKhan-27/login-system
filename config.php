<?php

$server = "localhost";
$username = "root";
$pass = "";
$database = "login_system";

$conn = mysqli_connect($server, $username, $pass, $database, 3306);

if(!$conn) {
    die("Connection failed.". mysqli_connect_error());
}
?>