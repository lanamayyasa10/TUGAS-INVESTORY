<?php
require_once __DIR__ . '/../../config/database.php';

class Inventory
{
    private mysqli $db;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    private function baseSql(): string
    {
        return "
            SELECT
                i.*,
                s.warehouse_name,
                s.location AS warehouse_location,
                v.name AS vendor_name,
                v.contact AS vendor_contact
            FROM inventory i
            INNER JOIN storage_units s ON s.id = i.warehouse_id
            LEFT JOIN vendors v ON v.id = i.vendor_id
        ";
    }

    public function getAll(string $search = ''): mysqli_result
    {
        $sql = $this->baseSql();
        if ($search !== '') {
            $sql .= " WHERE i.item_name LIKE ? OR i.item_type LIKE ? OR i.serial_number LIKE ? OR s.warehouse_name LIKE ? OR v.name LIKE ?";
            $sql .= " ORDER BY i.id DESC";
            $stmt = $this->db->prepare($sql);
            $term = "%$search%";
            $stmt->bind_param("sssss", $term, $term, $term, $term, $term);
            $stmt->execute();
            return $stmt->get_result();
        }

        $sql .= " ORDER BY i.id DESC";
        return $this->db->query($sql);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare($this->baseSql() . " WHERE i.id=? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO inventory
            (item_name, item_type, quantity, warehouse_id, serial_number, price, vendor_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "ssiisdi",
            $data['item_name'],
            $data['item_type'],
            $data['quantity'],
            $data['warehouse_id'],
            $data['serial_number'],
            $data['price'],
            $data['vendor_id']
        );
        return $stmt->execute();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE inventory
            SET item_name=?, item_type=?, quantity=?, warehouse_id=?, serial_number=?, price=?, vendor_id=?
            WHERE id=?
        ");
        $stmt->bind_param(
            "ssiisdii",
            $data['item_name'],
            $data['item_type'],
            $data['quantity'],
            $data['warehouse_id'],
            $data['serial_number'],
            $data['price'],
            $data['vendor_id'],
            $id
        );
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM inventory WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function countAll(): int
    {
        $result = $this->db->query("SELECT COUNT(*) total FROM inventory");
        return (int)$result->fetch_assoc()['total'];
    }

    public function totalQuantity(): int
    {
        $result = $this->db->query("SELECT COALESCE(SUM(quantity),0) total FROM inventory");
        return (int)$result->fetch_assoc()['total'];
    }

    public function outOfStock(): mysqli_result
    {
        return $this->db->query("
            SELECT i.*, s.warehouse_name
            FROM inventory i
            INNER JOIN storage_units s ON s.id=i.warehouse_id
            WHERE i.quantity <= 0
            ORDER BY i.item_name ASC
        ");
    }

    public function lowStock(int $limit = 5): mysqli_result
    {
        $stmt = $this->db->prepare("
            SELECT i.*, s.warehouse_name
            FROM inventory i
            INNER JOIN storage_units s ON s.id=i.warehouse_id
            WHERE i.quantity > 0 AND i.quantity <= ?
            ORDER BY i.quantity ASC, i.item_name ASC
        ");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        return $stmt->get_result();
    }
}
