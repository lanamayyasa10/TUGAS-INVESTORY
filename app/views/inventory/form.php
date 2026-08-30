<form method="POST" action="<?= e($action) ?>" class="form-grid">
    <?php if (isset($item['id'])): ?>
        <input type="hidden" name="id" value="<?= (int)$item['id'] ?>">
    <?php endif; ?>

    <div>
        <label>Nama Barang</label>
        <input type="text" name="item_name" required value="<?= e($item['item_name'] ?? '') ?>">
    </div>

    <div>
        <label>Jenis Barang</label>
        <input type="text" name="item_type" required value="<?= e($item['item_type'] ?? '') ?>">
    </div>

    <div>
        <label>Jumlah Stok</label>
        <input type="number" name="quantity" min="0" required value="<?= (int)($item['quantity'] ?? 0) ?>">
    </div>

    <div>
        <label>Gudang</label>
        <select name="warehouse_id" required>
            <option value="">-- Pilih Gudang --</option>
            <?php while ($warehouse = $warehouses->fetch_assoc()): ?>
                <option value="<?= (int)$warehouse['id'] ?>" <?= ((int)($item['warehouse_id'] ?? 0) === (int)$warehouse['id']) ? 'selected' : '' ?>>
                    <?= e($warehouse['warehouse_name']) ?> - <?= e($warehouse['location']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div>
        <label>Serial Number / Barcode</label>
        <input type="text" name="serial_number" required value="<?= e($item['serial_number'] ?? '') ?>">
    </div>

    <div>
        <label>Harga</label>
        <input type="number" name="price" min="0" step="0.01" required value="<?= e((string)($item['price'] ?? 0)) ?>">
    </div>

    <div>
        <label>Vendor / Supplier</label>
        <select name="vendor_id">
            <option value="0">-- Tidak ada --</option>
            <?php while ($vendor = $vendors->fetch_assoc()): ?>
                <option value="<?= (int)$vendor['id'] ?>" <?= ((int)($item['vendor_id'] ?? 0) === (int)$vendor['id']) ? 'selected' : '' ?>>
                    <?= e($vendor['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit">Simpan</button>
        <a class="btn secondary" href="index.php?page=inventory">Batal</a>
    </div>
</form>
