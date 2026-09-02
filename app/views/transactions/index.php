<?php
$title = 'Transaksi Stok';
require __DIR__ . '/../layout/header.php';
?>

<link rel="stylesheet" href="/inventory-management/public/assets/css/transaksi-stok.css">

<div class="toolbar">
    <span>Riwayat barang masuk dan keluar</span>
    <a class="btn" href="index.php?page=transaction-create">+ Transaksi</a>
</div>
<div class="panel table-wrap">
<table>
<thead><tr><th>Waktu</th><th>Barang</th><th>Tipe</th><th>Jumlah</th><th>Admin</th><th>Catatan</th></tr></thead>
<tbody>
<?php while ($row = $transactions->fetch_assoc()): ?>
<tr>
    <td><?= e($row['created_at']) ?></td>
    <td><?= e($row['item_name']) ?><br><small><?= e($row['serial_number']) ?></small></td>
    <td><span class="badge <?= $row['transaction_type'] === 'IN' ? 'success' : 'warning' ?>"><?= e($row['transaction_type']) ?></span></td>
    <td><?= (int)$row['quantity'] ?></td>
    <td><?= e($row['admin_name'] ?? '-') ?></td>
    <td><?= e($row['note'] ?? '-') ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
