<?php
require_once __DIR__ . '/../models/Inventory.php';
require_once __DIR__ . '/../models/Warehouse.php';
require_once __DIR__ . '/../models/Vendor.php';
require_once __DIR__ . '/../../config/auth.php';
require_once __DIR__ . '/../../config/helpers.php';

class InventoryController
{
    private Inventory $model;
    private Warehouse $warehouse;
    private Vendor $vendor;

    public function __construct()
    {
        $this->model = new Inventory();
        $this->warehouse = new Warehouse();
        $this->vendor = new Vendor();
    }

    public function index(): void
    {
        requireLogin();
        $search = trim($_GET['search'] ?? '');
        $items = $this->model->getAll($search);
        require __DIR__ . '/../views/inventory/index.php';
    }

    public function create(): void
    {
        requireLogin();
        $warehouses = $this->warehouse->getAll();
        $vendors = $this->vendor->getAll();
        require __DIR__ . '/../views/inventory/create.php';
    }

    public function store(): void
    {
        requireLogin();

        $data = [
            'item_name' => trim($_POST['item_name'] ?? ''),
            'item_type' => trim($_POST['item_type'] ?? ''),
            'quantity' => max(0, (int)($_POST['quantity'] ?? 0)),
            'warehouse_id' => (int)($_POST['warehouse_id'] ?? 0),
            'serial_number' => trim($_POST['serial_number'] ?? ''),
            'price' => max(0, (float)($_POST['price'] ?? 0)),
            'vendor_id' => (int)($_POST['vendor_id'] ?? 0)
        ];

        if ($data['item_name'] === '' || $data['item_type'] === '' || $data['serial_number'] === '' || !$data['warehouse_id']) {
            flash('error', 'Data barang wajib dilengkapi.');
            redirect('index.php?page=inventory-create');
        }

        if ($this->model->create($data)) {
            flash('success', 'Barang berhasil ditambahkan.');
        } else {
            flash('error', 'Gagal menambahkan barang. Pastikan Serial Number unik.');
        }

        redirect('index.php?page=inventory');
    }

    public function edit(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $item = $this->model->find($id);
        if (!$item) {
            flash('error', 'Barang tidak ditemukan.');
            redirect('index.php?page=inventory');
        }

        $warehouses = $this->warehouse->getAll();
        $vendors = $this->vendor->getAll();
        require __DIR__ . '/../views/inventory/edit.php';
    }

    public function update(): void
    {
        requireLogin();

        $id = (int)($_POST['id'] ?? 0);
        $data = [
            'item_name' => trim($_POST['item_name'] ?? ''),
            'item_type' => trim($_POST['item_type'] ?? ''),
            'quantity' => max(0, (int)($_POST['quantity'] ?? 0)),
            'warehouse_id' => (int)($_POST['warehouse_id'] ?? 0),
            'serial_number' => trim($_POST['serial_number'] ?? ''),
            'price' => max(0, (float)($_POST['price'] ?? 0)),
            'vendor_id' => (int)($_POST['vendor_id'] ?? 0)
        ];

        if ($this->model->update($id, $data)) {
            flash('success', 'Data barang berhasil diperbarui.');
        } else {
            flash('error', 'Gagal memperbarui barang. Pastikan Serial Number unik.');
        }

        redirect('index.php?page=inventory');
    }

    public function detail(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $item = $this->model->find($id);
        if (!$item) {
            flash('error', 'Barang tidak ditemukan.');
            redirect('index.php?page=inventory');
        }
        require __DIR__ . '/../views/inventory/detail.php';
    }

    public function delete(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);

        if ($this->model->delete($id)) {
            flash('success', 'Barang berhasil dihapus.');
        } else {
            flash('error', 'Gagal menghapus barang.');
        }

        redirect('index.php?page=inventory');
    }
}
