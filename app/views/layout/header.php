<?php
require_once __DIR__ . '/../../../config/helpers.php';
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Inventory Management') ?></title>
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="brand">Inventory<br><span>Management</span></div>
        <nav>
            <a href="index.php?page=dashboard">Dashboard</a>
            <a href="index.php?page=inventory">Inventory</a>
            <a href="index.php?page=warehouse">Gudang</a>
            <a href="index.php?page=vendor">Vendor</a>
            <a href="index.php?page=transactions">Transaksi Stok</a>
            <a href="index.php?page=admin">Admin</a>
            <a class="logout" href="index.php?page=logout">Logout</a>
        </nav>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div>
                <h2><?= e($title ?? 'Inventory Management') ?></h2>
                <small>Halo, <?= e($_SESSION['admin_name'] ?? 'Admin') ?></small>
            </div>
        </header>

        <?php if ($flash): ?>
            <div class="alert <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
        <?php endif; ?>
