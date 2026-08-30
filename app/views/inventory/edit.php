<?php
$title = 'Edit Barang';
require __DIR__ . '/../layout/header.php';
?>
<div class="panel">
    <?php
    $action = 'index.php?page=inventory-update';
    require __DIR__ . '/form.php';
    ?>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
