<?php
require_once __DIR__ . '/../../config/database.php';

class StockTransaction
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
            SELECT
                st.*,
                i.item_name,
                i.serial_number,
                a.name AS admin_name
            FROM stock_transactions st
            INNER JOIN inventory i ON i.id=st.inventory_id
            LEFT JOIN admins a ON a.id=st.admin_id
            ORDER BY st.id DESC
        ");
    }

    public function create(int $inventoryId, ?int $adminId, string $type, int $quantity, string $note): bool
    {
        if ($quantity <= 0 || !in_array($type, ['IN', 'OUT'], true)) {
            return false;
        }

        $this->db->begin_transaction();

        try {
            $stmt = $this->db->prepare("SELECT quantity FROM inventory WHERE id=? FOR UPDATE");
            $stmt->bind_param("i", $inventoryId);
            $stmt->execute();
            $item = $stmt->get_result()->fetch_assoc();

            if (!$item) {
                throw new Exception("Barang tidak ditemukan.");
            }

            $current = (int)$item['quantity'];
            $newQuantity = $type === 'IN' ? $current + $quantity : $current - $quantity;

            if ($newQuantity < 0) {
                throw new Exception("Stok tidak mencukupi.");
            }

            $stmt = $this->db->prepare("UPDATE inventory SET quantity=? WHERE id=?");
            $stmt->bind_param("ii", $newQuantity, $inventoryId);
            $stmt->execute();

            $stmt = $this->db->prepare("
                INSERT INTO stock_transactions
                (inventory_id, admin_id, transaction_type, quantity, note)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->bind_param("iisis", $inventoryId, $adminId, $type, $quantity, $note);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (Throwable $e) {
            $this->db->rollback();
            return false;
        }
    }
}
