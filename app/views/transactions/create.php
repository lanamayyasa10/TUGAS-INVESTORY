<?php
$title = 'Transaksi Stok';
require __DIR__ . '/../layout/header.php';
?>
<div class="panel">
<form method="POST" action="index.php?page=transaction-store" class="form-grid">
    <div>
        <label>Barang</label>
        <select name="inventory_id" required>
            <option value="">-- Pilih Barang --</option>
            <?php while ($item = $items->fetch_assoc()): ?>
                <option value="<?= (int)$item['id'] ?>">
                    <?= e($item['item_name']) ?> | Stok: <?= (int)$item['quantity'] ?> | <?= e($item['warehouse_name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div>
        <label>Jenis Transaksi</label>
        <select name="transaction_type" required>
            <option value="IN">IN - Barang Masuk</option>
            <option value="OUT">OUT - Barang Keluar</option>
        </select>
    </div>
    <div>
        <label>Jumlah</label>
        <input type="number" name="quantity" min="1" required>
    </div>
    <div>
        <label>Catatan</label>
        <input type="text" name="note" maxlength="255">
    </div>
    <div class="form-actions">
        <button type="submit">Simpan Transaksi</button>
        <a class="btn secondary" href="index.php?page=transactions">Batal</a>
    </div>
</form>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
