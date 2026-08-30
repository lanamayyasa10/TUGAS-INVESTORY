<?php
$title = 'Dashboard';
require __DIR__ . '/../layout/header.php';
?>

<div class="stats-grid">
    <div class="stat-card"><span>Total Jenis Barang</span><strong><?= $stats['items'] ?></strong></div>
    <div class="stat-card"><span>Total Kuantitas Stok</span><strong><?= $stats['quantity'] ?></strong></div>
    <div class="stat-card"><span>Total Gudang</span><strong><?= $stats['warehouses'] ?></strong></div>
    <div class="stat-card"><span>Total Vendor</span><strong><?= $stats['vendors'] ?></strong></div>
</div>

<div class="two-col">
    <section class="panel">
        <div class="panel-header">
            <h3>Stok Habis</h3>
            <span class="badge danger"><?= $outOfStock->num_rows ?></span>
        </div>
        <?php if ($outOfStock->num_rows === 0): ?>
            <p class="muted">Tidak ada barang yang stoknya habis.</p>
        <?php else: ?>
            <?php while ($row = $outOfStock->fetch_assoc()): ?>
                <div class="stock-row danger-row">
                    <div><strong><?= e($row['item_name']) ?></strong><br><small><?= e($row['warehouse_name']) ?></small></div>
                    <span>0</span>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>

    <section class="panel">
        <div class="panel-header">
            <h3>Stok Menipis</h3>
            <span class="badge warning"><?= $lowStock->num_rows ?></span>
        </div>
        <?php if ($lowStock->num_rows === 0): ?>
            <p class="muted">Tidak ada barang dengan stok ≤ 5.</p>
        <?php else: ?>
            <?php while ($row = $lowStock->fetch_assoc()): ?>
                <div class="stock-row warning-row">
                    <div><strong><?= e($row['item_name']) ?></strong><br><small><?= e($row['warehouse_name']) ?></small></div>
                    <span><?= (int)$row['quantity'] ?></span>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
