<?php
$title = 'Admin';
require __DIR__ . '/../layout/header.php';
?>
<div class="toolbar">
    <span>Pengelola sistem</span>
    <a class="btn" href="index.php?page=admin-create">+ Admin Baru</a>
</div>
<div class="panel table-wrap">
<table>
<thead><tr><th>Nama</th><th>Kontak</th><th>Email</th><th>Dibuat</th><th>Aksi</th></tr></thead>
<tbody>
<?php while ($row = $admins->fetch_assoc()): ?>
<tr>
    <td><?= e($row['name']) ?></td>
    <td><?= e($row['contact'] ?? '-') ?></td>
    <td><?= e($row['email']) ?></td>
    <td><?= e($row['created_at']) ?></td>
    <td class="actions">
        <a href="index.php?page=admin-edit&id=<?= (int)$row['id'] ?>">Edit</a>
        <a class="danger-text" data-confirm="Hapus admin ini?" href="index.php?page=admin-delete&id=<?= (int)$row['id'] ?>">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
