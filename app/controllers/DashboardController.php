<?php
require_once __DIR__ . '/../models/Inventory.php';
require_once __DIR__ . '/../models/Warehouse.php';
require_once __DIR__ . '/../models/Vendor.php';
require_once __DIR__ . '/../../config/auth.php';

class DashboardController
{
    public function index(): void
    {
        requireLogin();

        $inventory = new Inventory();
        $warehouse = new Warehouse();
        $vendor = new Vendor();

        $stats = [
            'items' => $inventory->countAll(),
            'quantity' => $inventory->totalQuantity(),
            'warehouses' => $warehouse->getAll()->num_rows,
            'vendors' => $vendor->getAll()->num_rows
        ];

        $outOfStock = $inventory->outOfStock();
        $lowStock = $inventory->lowStock(5);

        require __DIR__ . '/../views/dashboard/index.php';
    }
}
