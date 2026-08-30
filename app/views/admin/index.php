<?php
$title = 'Profil Admin';
require __DIR__ . '/../layout/header.php';
?>

<div class="profile-card">

    <div class="profile-header">
        <div class="profile-avatar">
            👤
        </div>

        <div>
            <h3><?= e($admin['name']) ?></h3>
            <span>Administrator</span>
        </div>
    </div>


    <!-- NAMA -->
    <div class="profile-item">

        <div class="profile-info">
            <label>Nama</label>
            <strong><?= e($admin['name']) ?></strong>
        </div>

        <button
            type="button"
            class="edit-icon"
            onclick="editField('name')">
            ✏
        </button>

    </div>

    <div class="edit-form" id="edit-name">

        <form method="POST" action="index.php?page=admin-update-field">

            <input type="hidden" name="field" value="name">

            <input
                type="text"
                name="value"
                value="<?= e($admin['name']) ?>"
                required
            >

            <div class="edit-actions">
                <button type="submit">Simpan</button>

                <button
                    type="button"
                    class="btn secondary"
                    onclick="cancelEdit('name')">
                    Batal
                </button>
            </div>

        </form>

    </div>


    <!-- KONTAK -->
    <div class="profile-item">

        <div class="profile-info">
            <label>Kontak</label>
            <strong><?= e($admin['contact'] ?: '-') ?></strong>
        </div>

        <button
            type="button"
            class="edit-icon"
            onclick="editField('contact')">
            ✏
        </button>

    </div>

    <div class="edit-form" id="edit-contact">

        <form method="POST" action="index.php?page=admin-update-field">

            <input type="hidden" name="field" value="contact">

            <input
                type="text"
                name="value"
                value="<?= e($admin['contact'] ?? '') ?>"
            >

            <div class="edit-actions">

                <button type="submit">
                    Simpan
                </button>

                <button
                    type="button"
                    class="btn secondary"
                    onclick="cancelEdit('contact')">
                    Batal
                </button>

            </div>

        </form>

    </div>


    <!-- EMAIL -->
    <div class="profile-item">

        <div class="profile-info">
            <label>Email</label>
            <strong><?= e($admin['email']) ?></strong>
        </div>

        <button
            type="button"
            class="edit-icon"
            onclick="editField('email')">
            ✏
        </button>

    </div>

    <div class="edit-form" id="edit-email">

        <form method="POST" action="index.php?page=admin-update-field">

            <input type="hidden" name="field" value="email">

            <input
                type="email"
                name="value"
                value="<?= e($admin['email']) ?>"
                required
            >

            <div class="edit-actions">

                <button type="submit">
                    Simpan
                </button>

                <button
                    type="button"
                    class="btn secondary"
                    onclick="cancelEdit('email')">
                    Batal
                </button>

            </div>

        </form>

    </div>


    <!-- PASSWORD -->
    <div class="profile-item">

        <div class="profile-info">
            <label>Password</label>
            <strong>••••••••</strong>
        </div>

        <button
            type="button"
            class="edit-icon"
            onclick="editField('password')">
            ✏
        </button>

    </div>

    <div class="edit-form" id="edit-password">

        <form method="POST" action="index.php?page=admin-update-field">

            <input type="hidden" name="field" value="password">

            <input
                type="password"
                name="value"
                placeholder="Masukkan password baru"
                required
            >

            <div class="edit-actions">

                <button type="submit">
                    Simpan
                </button>

                <button
                    type="button"
                    class="btn secondary"
                    onclick="cancelEdit('password')">
                    Batal
                </button>

            </div>

        </form>

    </div>

</div>


<script>
function editField(field) {

    // Tutup semua form edit terlebih dahulu
    document.querySelectorAll('.edit-form').forEach(function(form) {
        form.style.display = 'none';
    });

    // Buka form yang dipilih
    const form = document.getElementById('edit-' + field);

    if (form) {
        form.style.display = 'block';
    }
}

function cancelEdit(field) {

    const form = document.getElementById('edit-' + field);

    if (form) {
        form.style.display = 'none';
    }
}
</script>


<?php require __DIR__ . '/../layout/footer.php'; ?>