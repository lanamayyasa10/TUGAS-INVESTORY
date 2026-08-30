<?php
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../../config/auth.php';
require_once __DIR__ . '/../../config/helpers.php';

class AdminController
{
    private Admin $model;

    public function __construct()
    {
        $this->model = new Admin();
    }

    public function index(): void
    {
        requireLogin();
        $admins = $this->model->getAll();
        require __DIR__ . '/../views/admin/index.php';
    }

    public function create(): void
    {
        requireLogin();
        require __DIR__ . '/../views/admin/create.php';
    }

    public function store(): void
    {
        requireLogin();

        $name = trim($_POST['name'] ?? '');
        $contact = trim($_POST['contact'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            flash('error', 'Nama, email, dan password wajib diisi.');
            redirect('index.php?page=admin-create');
        }

        if ($this->model->create($name, $contact, $email, $password)) {
            flash('success', 'Admin berhasil ditambahkan.');
        } else {
            flash('error', 'Gagal menambahkan admin. Email mungkin sudah digunakan.');
        }

        redirect('index.php?page=admin');
    }

    public function edit(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $admin = $this->model->find($id);
        if (!$admin) {
            flash('error', 'Admin tidak ditemukan.');
            redirect('index.php?page=admin');
        }
        require __DIR__ . '/../views/admin/edit.php';
    }

    public function update(): void
    {
        requireLogin();

        $id = (int)($_POST['id'] ?? 0);
        $ok = $this->model->update(
            $id,
            trim($_POST['name'] ?? ''),
            trim($_POST['contact'] ?? ''),
            trim($_POST['email'] ?? ''),
            $_POST['password'] ?? null
        );

        flash($ok ? 'success' : 'error', $ok ? 'Admin berhasil diperbarui.' : 'Gagal memperbarui admin.');
        redirect('index.php?page=admin');
    }

    public function delete(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);

        if ($id === currentAdminId()) {
            flash('error', 'Admin yang sedang login tidak boleh dihapus.');
        } elseif ($this->model->delete($id)) {
            flash('success', 'Admin berhasil dihapus.');
        } else {
            flash('error', 'Gagal menghapus admin.');
        }

        redirect('index.php?page=admin');
    }
}
