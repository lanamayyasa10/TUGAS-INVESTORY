<?php
require_once __DIR__ . '/../models/StockTransaction.php';
require_once __DIR__ . '/../models/Inventory.php';
require_once __DIR__ . '/../../config/auth.php';
require_once __DIR__ . '/../../config/helpers.php';

class StockTransactionController
{
    public function index(): void
    {
        requireLogin();
        $transaction = new StockTransaction();
        $transactions = $transaction->getAll();
        require __DIR__ . '/../views/transactions/index.php';
    }

    public function create(): void
    {
        requireLogin();
        $inventory = new Inventory();
        $items = $inventory->getAll();
        require __DIR__ . '/../views/transactions/create.php';
    }

    public function store(): void
    {
        requireLogin();

        $transaction = new StockTransaction();
        $ok = $transaction->create(
            (int)($_POST['inventory_id'] ?? 0),
            currentAdminId(),
            $_POST['transaction_type'] ?? '',
            (int)($_POST['quantity'] ?? 0),
            trim($_POST['note'] ?? '')
        );

        flash($ok ? 'success' : 'error', $ok ? 'Transaksi stok berhasil disimpan.' : 'Transaksi gagal. Cek stok dan data barang.');
        redirect('index.php?page=transactions');
    }
}
