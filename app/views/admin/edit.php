<?php
$title = 'Edit Admin';
require __DIR__ . '/../layout/header.php';
?>

<div class="panel">
<?php
$action = 'index.php?page=admin-update';
require __DIR__.'/form.php';
?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>