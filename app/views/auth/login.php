<?php
require_once __DIR__ . '/../../../config/helpers.php';
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory Management</title>
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body class="login-page">
<div class="login-card">
    <h1>Inventory Management</h1>
    <p>Login Admin</p>

    <?php if ($flash): ?>
        <div class="alert <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=login-process">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Masuk</button>
    </form>
</div>
</body>
</html>
