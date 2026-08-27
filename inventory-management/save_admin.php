<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location:index.php");
    exit;

}


include "config/database.php";


$name = $_POST['name'];

$contact = $_POST['contact'];

$email = $_POST['email'];

$password = $_POST['password'];



$query = mysqli_query(
$conn,
"INSERT INTO admins
(name,contact,email,password)
VALUES
(
'$name',
'$contact',
'$email',
'$password'
)"
);



if($query){


    echo "
    <script>

    alert('Admin berhasil ditambahkan');

    window.location='dashboard.php';

    </script>
    ";


}else{


    echo "
    <script>

    alert('Gagal menambahkan admin');

    window.history.back();

    </script>
    ";

}


?>