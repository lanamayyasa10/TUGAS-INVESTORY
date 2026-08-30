<form method="POST" action="<?= e($action) ?>" class="form-grid">
    <?php if (isset($vendor['id'])): ?><input type="hidden" name="id" value="<?= (int)$vendor['id'] ?>"><?php endif; ?>
    <div><label>Nama Vendor / Supplier</label><input type="text" name="name" required value="<?= e($vendor['name'] ?? '') ?>"></div>
    <div><label>Kontak</label><input type="text" name="contact" value="<?= e($vendor['contact'] ?? '') ?>"></div>
    <div class="form-actions">
        <button type="submit">Simpan</button>
        <a class="btn secondary" href="index.php?page=vendor">Batal</a>
    </div>
</form>
