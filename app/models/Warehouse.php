<?php
require_once __DIR__ . '/../../config/database.php';

class Warehouse
{
    private mysqli $db;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    public function getAll(): mysqli_result
    {
        return $this->db->query("
            SELECT s.*, COUNT(i.id) AS item_count
            FROM storage_units s
            LEFT JOIN inventory i ON i.warehouse_id = s.id
            GROUP BY s.id
            ORDER BY s.id DESC
        ");
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM storage_units WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function create(string $name, string $location): bool
    {
        $stmt = $this->db->prepare("INSERT INTO storage_units (warehouse_name, location) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $location);
        return $stmt->execute();
    }

    public function update(int $id, string $name, string $location): bool
    {
        $stmt = $this->db->prepare("UPDATE storage_units SET warehouse_name=?, location=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $location, $id);
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM storage_units WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function search(string $search): mysqli_result
    {
    $stmt = $this->db->prepare("
        SELECT
            id,
            warehouse_name,
            location
        FROM storage_units
        WHERE
            warehouse_name LIKE ?
            OR location LIKE ?
        ORDER BY warehouse_name ASC
        LIMIT 5
    ");

    $term = "%$search%";

    $stmt->bind_param(
        "ss",
        $term,
        $term
    );

    $stmt->execute();

    return $stmt->get_result();
    }
}
