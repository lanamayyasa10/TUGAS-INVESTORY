<form method="POST" action="<?= e($action) ?>" class="form-grid">
    <?php if (isset($admin['id'])): ?><input type="hidden" name="id" value="<?= (int)$admin['id'] ?>"><?php endif; ?>
    <div><label>Nama</label><input type="text" name="name" required value="<?= e($admin['name'] ?? '') ?>"></div>
    <div><label>Kontak</label><input type="text" name="contact" value="<?= e($admin['contact'] ?? '') ?>"></div>
    <div><label>Email</label><input type="email" name="email" required value="<?= e($admin['email'] ?? '') ?>"></div>
    <div><label>Password <?= isset($admin['id']) ? '(kosongkan jika tidak diubah)' : '' ?></label><input type="password" name="password" <?= isset($admin['id']) ? '' : 'required' ?>></div>
    <div class="form-actions">
        <button type="submit">Simpan</button>
        <a class="btn secondary" href="index.php?page=admin">Batal</a>
    </div>
</form>
