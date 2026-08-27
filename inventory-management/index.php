<?php

session_start();


if(isset($_SESSION['admin_id'])){

    header("Location: dashboard.php");
    exit;

}


?>


<!DOCTYPE html>
<html>

<head>

<title>
Login Inventory
</title>


<style>

body{

font-family: Arial;
background:#f2f2f2;

}


.box{

width:350px;
margin:120px auto;
background:white;
padding:30px;
border-radius:10px;

}


input{

width:100%;
padding:10px;
margin-bottom:15px;

}


button{

width:100%;
padding:10px;
background:#111827;
color:white;
border:none;

}

</style>


</head>


<body>


<div class="box">


<h2>
Inventory Login
</h2>


<form action="api/login.php" method="POST">


<label>Email</label>

<input 
type="email"
name="email"
required
>


<label>Password</label>

<input 
type="password"
name="password"
required
>


<button type="submit">

Login

</button>


</form>


</div>


</body>

</html>