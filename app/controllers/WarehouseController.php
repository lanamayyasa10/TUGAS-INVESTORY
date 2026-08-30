<?php
require_once __DIR__ . '/../models/Warehouse.php';
require_once __DIR__ . '/../../config/auth.php';
require_once __DIR__ . '/../../config/helpers.php';

class WarehouseController
{
    private Warehouse $model;

    public function __construct()
    {
        $this->model = new Warehouse();
    }

    public function index(): void
    {
        requireLogin();
        $warehouses = $this->model->getAll();
        require __DIR__ . '/../views/warehouse/index.php';
    }

    public function create(): void
    {
        requireLogin();
        require __DIR__ . '/../views/warehouse/create.php';
    }

    public function store(): void
    {
        requireLogin();
        $name = trim($_POST['warehouse_name'] ?? '');
        $location = trim($_POST['location'] ?? '');

        if ($name === '' || $location === '') {
            flash('error', 'Nama gudang dan lokasi wajib diisi.');
            redirect('index.php?page=warehouse-create');
        }

        $this->model->create($name, $location);
        flash('success', 'Gudang berhasil ditambahkan.');
        redirect('index.php?page=warehouse');
    }

    public function edit(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $warehouse = $this->model->find($id);
        if (!$warehouse) {
            flash('error', 'Gudang tidak ditemukan.');
            redirect('index.php?page=warehouse');
        }
        require __DIR__ . '/../views/warehouse/edit.php';
    }

    public function update(): void
    {
        requireLogin();
        $id = (int)($_POST['id'] ?? 0);
        $this->model->update(
            $id,
            trim($_POST['warehouse_name'] ?? ''),
            trim($_POST['location'] ?? '')
        );
        flash('success', 'Gudang berhasil diperbarui.');
        redirect('index.php?page=warehouse');
    }

    public function delete(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);

        if ($this->model->delete($id)) {
            flash('success', 'Gudang berhasil dihapus.');
        } else {
            flash('error', 'Gudang tidak dapat dihapus karena masih digunakan oleh inventory.');
        }

        redirect('index.php?page=warehouse');
    }
}
