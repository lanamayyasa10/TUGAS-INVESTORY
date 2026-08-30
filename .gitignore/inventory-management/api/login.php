<?php

session_start();


include "../config/database.php";


$email = $_POST['email'];

$password = $_POST['password'];



$query = mysqli_query(
$conn,
"SELECT * FROM admins 
WHERE email='$email'
AND password='$password'"
);



$data = mysqli_fetch_assoc($query);



if($data){


    $_SESSION['admin_id'] = $data['id'];

    $_SESSION['admin_name'] = $data['name'];


    header(
    "Location: ../dashboard.php"
    );


}else{


    echo "
    <script>

    alert('Email atau password salah');

    window.location='../index.php';

    </script>
    ";

}


?>