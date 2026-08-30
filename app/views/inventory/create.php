<?php
$title = 'Tambah Barang';
require __DIR__ . '/../layout/header.php';
?>
<div class="panel">
    <?php
    $item = [];
    $action = 'index.php?page=inventory-store';
    require __DIR__ . '/form.php';
    ?>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
