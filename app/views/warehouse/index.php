<?php
$title = 'Gudang';
require __DIR__ . '/../layout/header.php';
?>

<link rel="stylesheet" href="/inventory-management/public/assets/css/gudang.css">

<div class="toolbar">
    <span>Daftar storage unit / gudang</span>
    <a class="btn" href="index.php?page=warehouse-create">+ Gudang Baru</a>
</div>
<div class="panel table-wrap">
<table>
<thead><tr><th>Nama Gudang</th><th>Lokasi</th><th>Jumlah Jenis Barang</th><th>Aksi</th></tr></thead>
<tbody>
<?php while ($row = $warehouses->fetch_assoc()): ?>
<tr>
    <td><?= e($row['warehouse_name']) ?></td>
    <td><?= e($row['location']) ?></td>
    <td><?= (int)$row['item_count'] ?></td>
    <td class="actions">
        <a href="index.php?page=warehouse-edit&id=<?= (int)$row['id'] ?>">Edit</a>
        <a class="danger-text" data-confirm="Hapus gudang ini?" href="index.php?page=warehouse-delete&id=<?= (int)$row['id'] ?>">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
