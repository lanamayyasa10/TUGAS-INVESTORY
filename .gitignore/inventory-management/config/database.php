<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "inventory_management";


$conn = mysqli_connect(
    $host,
    $user,
    $pass,
    $db
);


if(!$conn){

    die("Database gagal terhubung: " . mysqli_connect_error());

}

?>