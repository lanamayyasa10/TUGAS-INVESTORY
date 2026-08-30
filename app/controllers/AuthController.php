<?php
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../../config/auth.php';
require_once __DIR__ . '/../../config/helpers.php';

class AuthController
{
    private Admin $admin;

    public function __construct()
    {
        $this->admin = new Admin();
    }

    public function showLogin(): void
    {
        if (isLoggedIn()) {
            redirect('index.php?page=dashboard');
        }
        require __DIR__ . '/../views/auth/login.php';
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $admin = $this->admin->findByEmail($email);

        $valid = false;
        if ($admin) {
            // Mendukung data lama yang masih plaintext dan data baru yang sudah password_hash().
            $valid = password_verify($password, $admin['password'])
                || hash_equals((string)$admin['password'], $password);
        }

        if (!$valid) {
            flash('error', 'Email atau password salah.');
            redirect('index.php?page=login');
        }

        session_regenerate_id(true);
        $_SESSION['admin_id'] = (int)$admin['id'];
        $_SESSION['admin_name'] = $admin['name'];

        redirect('index.php?page=dashboard');
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
        session_destroy();
        redirect('index.php?page=login');
    }
}
