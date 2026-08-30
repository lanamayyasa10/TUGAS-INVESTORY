<form method="POST" action="<?= e($action) ?>" class="form-grid">
    <?php if (isset($warehouse['id'])): ?><input type="hidden" name="id" value="<?= (int)$warehouse['id'] ?>"><?php endif; ?>
    <div><label>Nama Gudang</label><input type="text" name="warehouse_name" required value="<?= e($warehouse['warehouse_name'] ?? '') ?>"></div>
    <div><label>Lokasi</label><input type="text" name="location" required value="<?= e($warehouse['location'] ?? '') ?>"></div>
    <div class="form-actions">
        <button type="submit">Simpan</button>
        <a class="btn secondary" href="index.php?page=warehouse">Batal</a>
    </div>
</form>
