<?php
require_once __DIR__ . '/../models/Vendor.php';
require_once __DIR__ . '/../../config/auth.php';
require_once __DIR__ . '/../../config/helpers.php';

class VendorController
{
    private Vendor $model;

    public function __construct()
    {
        $this->model = new Vendor();
    }

    public function index(): void
    {
        requireLogin();
        $vendors = $this->model->getAll();
        require __DIR__ . '/../views/vendor/index.php';
    }

    public function create(): void
    {
        requireLogin();
        require __DIR__ . '/../views/vendor/create.php';
    }

    public function store(): void
    {
        requireLogin();
        $name = trim($_POST['name'] ?? '');
        $contact = trim($_POST['contact'] ?? '');

        if ($name === '') {
            flash('error', 'Nama vendor wajib diisi.');
            redirect('index.php?page=vendor-create');
        }

        $this->model->create($name, $contact);
        flash('success', 'Vendor berhasil ditambahkan.');
        redirect('index.php?page=vendor');
    }

    public function edit(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $vendor = $this->model->find($id);
        if (!$vendor) {
            flash('error', 'Vendor tidak ditemukan.');
            redirect('index.php?page=vendor');
        }
        require __DIR__ . '/../views/vendor/edit.php';
    }

    public function update(): void
    {
        requireLogin();
        $id = (int)($_POST['id'] ?? 0);
        $this->model->update(
            $id,
            trim($_POST['name'] ?? ''),
            trim($_POST['contact'] ?? '')
        );
        flash('success', 'Vendor berhasil diperbarui.');
        redirect('index.php?page=vendor');
    }

    public function delete(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);

        if ($this->model->delete($id)) {
            flash('success', 'Vendor berhasil dihapus.');
        } else {
            flash('error', 'Vendor gagal dihapus.');
        }

        redirect('index.php?page=vendor');
    }
}
