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

        // Hanya mengambil data admin yang sedang login
        $id = currentAdminId();
        $admin = $this->model->find($id);

        if (!$admin) {
            flash('error', 'Data admin tidak ditemukan.');
            redirect('index.php?page=dashboard');
        }

        require __DIR__ . '/../views/admin/index.php';
    }

    public function create(): void
    {
        // Fitur tambah admin tidak digunakan
        requireLogin();
        redirect('index.php?page=admin');
    }

    public function store(): void
    {
        // Fitur tambah admin tidak digunakan
        requireLogin();
        redirect('index.php?page=admin');
    }

    public function edit(): void
    {
        requireLogin();

        // ID admin yang sedang login
        $currentId = currentAdminId();

        // ID yang diminta dari URL
        $id = (int)($_GET['id'] ?? 0);

        // Mencegah admin mengedit akun admin lain
        if ($id !== $currentId) {
            flash('error', 'Anda hanya dapat mengedit akun Anda sendiri.');
            redirect('index.php?page=admin');
        }

        $admin = $this->model->find($currentId);

        if (!$admin) {
            flash('error', 'Admin tidak ditemukan.');
            redirect('index.php?page=admin');
        }

        require __DIR__ . '/../views/admin/edit.php';
    }

    public function update(): void
    {
        requireLogin();

        $currentId = currentAdminId();
        $id = (int)($_POST['id'] ?? 0);

        // Keamanan:
        // Admin hanya boleh mengubah akun miliknya sendiri
        if ($id !== $currentId) {
            flash('error', 'Anda hanya dapat mengedit akun Anda sendiri.');
            redirect('index.php?page=admin');
        }

        $name = trim($_POST['name'] ?? '');
        $contact = trim($_POST['contact'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? null;

        if ($name === '' || $email === '') {
            flash('error', 'Nama dan email wajib diisi.');
            redirect('index.php?page=admin-edit&id=' . $currentId);
        }

        $ok = $this->model->update(
            $currentId,
            $name,
            $contact,
            $email,
            $password
        );

        flash(
            $ok ? 'success' : 'error',
            $ok ? 'Data admin berhasil diperbarui.' : 'Gagal memperbarui data admin.'
        );

        redirect('index.php?page=admin');
    }

    public function updateField(): void
    {
    requireLogin();

    $currentId = currentAdminId();

    $field = $_POST['field'] ?? '';
    $value = trim($_POST['value'] ?? '');

    // Field yang boleh diedit
    $allowedFields = ['name', 'contact', 'email', 'password'];

    if (!in_array($field, $allowedFields, true)) {
        flash('error', 'Data yang ingin diubah tidak valid.');
        redirect('index.php?page=admin');
    }

    // Nama dan email wajib diisi
    if (($field === 'name' || $field === 'email') && $value === '') {
        flash('error', 'Data tidak boleh kosong.');
        redirect('index.php?page=admin');
    }

    // Password wajib diisi jika ingin mengganti password
    if ($field === 'password' && $value === '') {
        flash('error', 'Password tidak boleh kosong.');
        redirect('index.php?page=admin');
    }

    // Update hanya akun yang sedang login
    $ok = $this->model->updateField(
        $currentId,
        $field,
        $value
    );

    if ($ok) {
        flash('success', 'Data berhasil diperbarui.');
    } else {
        flash('error', 'Gagal memperbarui data.');
    }

    redirect('index.php?page=admin');
    }


    public function delete(): void
    {
        // Admin tidak boleh menghapus akun
        requireLogin();

        flash('error', 'Akun admin tidak dapat dihapus.');
        redirect('index.php?page=admin');
    }
}