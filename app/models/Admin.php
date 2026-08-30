<?php
require_once __DIR__ . '/../../config/database.php';

class Admin
{
    private mysqli $db;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    public function getAll(): mysqli_result
    {
        return $this->db->query("SELECT id, name, contact, email, created_at FROM admins ORDER BY id DESC");
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT id, name, contact, email, created_at FROM admins WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function create(string $name, string $contact, string $email, string $password): bool
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO admins (name, contact, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $contact, $email, $hash);
        return $stmt->execute();
    }

    public function update(int $id, string $name, string $contact, string $email, ?string $password = null): bool
    {
        if ($password !== null && $password !== '') {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE admins SET name=?, contact=?, email=?, password=? WHERE id=?");
            $stmt->bind_param("ssssi", $name, $contact, $email, $hash, $id);
        } else {
            $stmt = $this->db->prepare("UPDATE admins SET name=?, contact=?, email=? WHERE id=?");
            $stmt->bind_param("sssi", $name, $contact, $email, $id);
        }
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM admins WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
