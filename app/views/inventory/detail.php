<?php
$title = 'Detail Barang';
require __DIR__ . '/../layout/header.php';
?>
<div class="panel detail-grid">
    <div><span>Nama Barang</span><strong><?= e($item['item_name']) ?></strong></div>
    <div><span>Jenis</span><strong><?= e($item['item_type']) ?></strong></div>
    <div><span>Stok</span><strong><?= (int)$item['quantity'] ?></strong></div>
    <div><span>Gudang</span><strong><?= e($item['warehouse_name']) ?> — <?= e($item['warehouse_location']) ?></strong></div>
    <div><span>Serial Number</span><strong><?= e($item['serial_number']) ?></strong></div>
    <div><span>Harga</span><strong><?= rupiah($item['price']) ?></strong></div>
    <div><span>Vendor</span><strong><?= e($item['vendor_name'] ?? '-') ?></strong></div>
    <div><span>Kontak Vendor</span><strong><?= e($item['vendor_contact'] ?? '-') ?></strong></div>
</div>
<a class="btn secondary" href="index.php?page=inventory">Kembali</a>
<?php require __DIR__ . '/../layout/footer.php'; ?>
