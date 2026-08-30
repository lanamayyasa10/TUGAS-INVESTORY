<?php
$title = 'Inventory';
require __DIR__ . '/../layout/header.php';
?>

<link rel="stylesheet" href="/inventory-management/public/assets/css/inventory.css">

<div class="toolbar">
    <form class="search-form" method="GET">
        <input type="hidden" name="page" value="inventory">
        <input type="search" name="search" value="<?= e($search) ?>" placeholder="Cari nama, jenis, serial number, gudang, vendor...">
        <button type="submit">Cari</button>
    </form>
    <a class="btn" href="index.php?page=inventory-create">+ Tambah Barang</a>
</div>

<div class="panel table-wrap">
<table>
<thead>
<tr>
    <th>Barang</th>
    <th>Jenis</th>
    <th>Stok</th>
    <th>Gudang</th>
    <th>Serial Number</th>
    <th>Harga</th>
    <th>Vendor</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php while ($row = $items->fetch_assoc()): ?>
<tr>
    <td><strong><?= e($row['item_name']) ?></strong></td>
    <td><?= e($row['item_type']) ?></td>
    <td>
        <?php if ($row['quantity'] <= 0): ?>
            <span class="badge danger">HABIS</span>
        <?php elseif ($row['quantity'] <= 5): ?>
            <span class="badge warning"><?= (int)$row['quantity'] ?></span>
        <?php else: ?>
            <span class="badge success"><?= (int)$row['quantity'] ?></span>
        <?php endif; ?>
    </td>
    <td><?= e($row['warehouse_name']) ?><br><small><?= e($row['warehouse_location']) ?></small></td>
    <td><?= e($row['serial_number']) ?></td>
    <td><?= rupiah($row['price']) ?></td>
    <td><?= e($row['vendor_name'] ?? '-') ?></td>
    <td class="actions">
        <a href="index.php?page=inventory-detail&id=<?= (int)$row['id'] ?>">Detail</a>
        <a href="index.php?page=inventory-edit&id=<?= (int)$row['id'] ?>">Edit</a>
        <a class="danger-text" data-confirm="Hapus barang ini?" href="index.php?page=inventory-delete&id=<?= (int)$row['id'] ?>">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
