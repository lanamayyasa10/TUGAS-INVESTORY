<?php
$title = 'Vendor / Supplier';
require __DIR__ . '/../layout/header.php';
?>
<div class="toolbar">
    <span>Daftar vendor / supplier</span>
    <a class="btn" href="index.php?page=vendor-create">+ Vendor Baru</a>
</div>
<div class="panel table-wrap">
<table>
<thead><tr><th>Nama Vendor</th><th>Kontak</th><th>Item yang Disediakan</th><th>Aksi</th></tr></thead>
<tbody>
<?php while ($row = $vendors->fetch_assoc()): ?>
<tr>
    <td><?= e($row['name']) ?></td>
    <td><?= e($row['contact'] ?? '-') ?></td>
    <td><?= (int)$row['item_count'] ?></td>
    <td class="actions">
        <a href="index.php?page=vendor-edit&id=<?= (int)$row['id'] ?>">Edit</a>
        <a class="danger-text" data-confirm="Hapus vendor ini?" href="index.php?page=vendor-delete&id=<?= (int)$row['id'] ?>">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
