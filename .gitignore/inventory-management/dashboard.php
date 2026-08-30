<?php

require_once "config/auth.php";

requireLogin();

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Dashboard Inventory</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>


<body>


<div class="wrapper">


<!-- SIDEBAR -->

<aside class="sidebar">

<h2>
📦 Inventory
</h2>


<ul>

<li>
<a href="dashboard.php">
🏠 Dashboard
</a>
</li>


<li>
<a href="inventory.php">
📋 Inventory
</a>
</li>


<li>
<a href="warehouse.php">
🏢 Gudang
</a>
</li>


<li>
<a href="vendor.php">
🚚 Vendor
</a>
</li>


</ul>


<div class="logout">

<a href="api/logout.php">
Logout
</a>

</div>


</aside>



<!-- MAIN -->

<main class="content">


<header>

<h1>
Dashboard
</h1>


<div class="admin">

👤
<?= htmlspecialchars($_SESSION["admin_name"]) ?>

</div>


</header>




<section class="cards">


<div class="card">

<div class="icon">
📦
</div>

<div>

<h3>
Total Barang
</h3>

<p>
0
</p>

</div>

</div>



<div class="card">

<div class="icon">
🏢
</div>

<div>

<h3>
Total Gudang
</h3>

<p>
0
</p>

</div>

</div>




<div class="card">

<div class="icon">
🚚
</div>

<div>

<h3>
Total Vendor
</h3>

<p>
0
</p>

</div>

</div>



<div class="card warning">

<div class="icon">
⚠️
</div>

<div>

<h3>
Stok Habis
</h3>

<p>
0
</p>

</div>

</div>


</section>



<section class="table-box">


<h2>
Alert Stok
</h2>


<table>


<tr>

<th>
Barang
</th>


<th>
Jumlah
</th>


<th>
Lokasi
</th>


</tr>


<tr>

<td colspan="3">

Belum ada data

</td>

</tr>


</table>


</section>



</main>



</div>



</body>

</html>