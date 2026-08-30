<?php

require_once "config/auth.php";

requireLogin();

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Dashboard</title>

</head>

<body>

    <h1>Dashboard Inventory</h1>

    <p>
        Selamat datang,
        <strong>
            <?= htmlspecialchars($_SESSION["admin_name"]) ?>
        </strong>
    </p>

    <p>
        Email:
        <?= htmlspecialchars($_SESSION["admin_email"]) ?>
    </p>

    <br>

    <a href="api/logout.php">
        Logout
    </a>

</body>

</html>