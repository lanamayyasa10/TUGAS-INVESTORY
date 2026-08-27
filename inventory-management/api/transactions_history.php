<?php
require_once '../config/database.php';
require_once '../config/auth.php';
require_once 'helpers.php';
requireLogin();

$stmt=$pdo->query("SELECT t.*,i.item_name,a.name admin_name
FROM stock_transactions t
JOIN inventory i ON i.id=t.inventory_id
LEFT JOIN admins a ON a.id=t.admin_id
ORDER BY t.created_at DESC");

response(true,'Riwayat transaksi',$stmt->fetchAll());
