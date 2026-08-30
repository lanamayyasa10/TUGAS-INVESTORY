<?php
require_once __DIR__ . '/../../config/database.php';

class Vendor
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
            SELECT v.*, COUNT(vi.id) AS item_count
            FROM vendors v
            LEFT JOIN vendor_items vi ON vi.vendor_id = v.id
            GROUP BY v.id
            ORDER BY v.id DESC
        ");
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM vendors WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function items(int $vendorId): mysqli_result
    {
        $stmt = $this->db->prepare("SELECT id, item_name FROM vendor_items WHERE vendor_id=? ORDER BY id DESC");
        $stmt->bind_param("i", $vendorId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function create(string $name, string $contact): bool
    {
        $stmt = $this->db->prepare("INSERT INTO vendors (name, contact) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $contact);
        return $stmt->execute();
    }

    public function update(int $id, string $name, string $contact): bool
    {
        $stmt = $this->db->prepare("UPDATE vendors SET name=?, contact=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $contact, $id);
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM vendors WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function addItem(int $vendorId, string $itemName): bool
    {
        $stmt = $this->db->prepare("INSERT INTO vendor_items (vendor_id, item_name) VALUES (?, ?)");
        $stmt->bind_param("is", $vendorId, $itemName);
        return $stmt->execute();
    }

    public function deleteItem(int $itemId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM vendor_items WHERE id=?");
        $stmt->bind_param("i", $itemId);
        return $stmt->execute();
    }
}
