<?php

session_start();

if(!isset($_SESSION['admin_id'])){

    header("Location:index.php");
    exit;

}

?>


<!DOCTYPE html>
<html>

<head>

<title>
Tambah Admin
</title>

</head>


<body>


<h2>
Tambah Admin Baru
</h2>


<form action="save_admin.php" method="POST">


<label>
Nama Admin
</label>

<br>

<input 
type="text"
name="name"
required
>

<br><br>



<label>
Kontak
</label>

<br>

<input 
type="text"
name="contact"
required
>

<br><br>



<label>
Email
</label>

<br>

<input 
type="email"
name="email"
required
>

<br><br>



<label>
Password
</label>

<br>

<input 
type="password"
name="password"
required
>

<br><br>


<button type="submit">
Simpan Admin
</button>


</form>


<br>

<a href="dashboard.php">
Kembali
</a>


</body>

</html>