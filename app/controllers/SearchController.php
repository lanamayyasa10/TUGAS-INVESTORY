<?php

require_once __DIR__ . '/../models/Inventory.php';
require_once __DIR__ . '/../models/Warehouse.php';
require_once __DIR__ . '/../models/Vendor.php';
require_once __DIR__ . '/../../config/auth.php';

class SearchController
{
    public function index(): void
    {
        requireLogin();

        header('Content-Type: application/json; charset=utf-8');

        $query = trim($_GET['q'] ?? '');

        if ($query === '') {
            echo json_encode([]);
            return;
        }

        $results = [];

        // =========================
        // INVENTORY
        // =========================

        $inventory = new Inventory();
        $inventoryResults = $inventory->search($query);

        while ($row = $inventoryResults->fetch_assoc()) {
            $results[] = [
                'type' => 'Inventory',
                'icon' => '📦',
                'name' => $row['item_name'],
                'description' => $row['warehouse_name'] ?? 'Barang',
                'url' => 'index.php?page=inventory-detail&id=' . (int)$row['id']
            ];
        }


        // =========================
        // GUDANG
        // =========================

        $warehouse = new Warehouse();
        $warehouseResults = $warehouse->search($query);

        while ($row = $warehouseResults->fetch_assoc()) {
            $results[] = [
                'type' => 'Gudang',
                'icon' => '🏢',
                'name' => $row['warehouse_name'],
                'description' => $row['location'] ?? 'Lokasi gudang',
                'url' => 'index.php?page=warehouse-edit&id=' . (int)$row['id']
            ];
        }


        // =========================
        // VENDOR
        // =========================

        $vendor = new Vendor();
        $vendorResults = $vendor->search($query);

        while ($row = $vendorResults->fetch_assoc()) {
            $results[] = [
                'type' => 'Vendor',
                'icon' => '🚚',
                'name' => $row['name'],
                'description' => $row['contact'] ?? 'Vendor',
                'url' => 'index.php?page=vendor-edit&id=' . (int)$row['id']
            ];
        }


        // Maksimal 10 hasil
        $results = array_slice($results, 0, 10);

        echo json_encode($results);
    }
}