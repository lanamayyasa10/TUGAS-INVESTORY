# Inventory Management Backend

PHP Native + MySQL + PDO untuk study case pengelolaan stok.

## Fitur
- Login admin
- Dashboard statistik
- CRUD barang/inventory
- CRUD gudang
- CRUD vendor/supplier
- Search barang
- Detail stok, lokasi, harga, vendor, serial number
- Stok masuk/keluar
- Riwayat transaksi
- Alert stok habis
- Relasi database dengan foreign key
- Prepared statement PDO

## Instalasi
1. Gunakan XAMPP/Laragon.
2. Aktifkan Apache dan MySQL.
3. Copy folder ini ke `htdocs`.
4. Import `database.sql` lewat phpMyAdmin.
5. Sesuaikan koneksi pada `config/database.php`.
6. Endpoint berada di `/api/`.

## Login contoh
Email: admin@inventory.local
Password: password

## Endpoint
POST `/api/login.php`
POST `/api/logout.php`

GET/POST/PUT/DELETE `/api/inventory.php`
GET/POST/PUT/DELETE `/api/warehouses.php`
GET/POST/PUT/DELETE `/api/vendors.php`

GET `/api/dashboard.php`
POST `/api/transactions.php`
GET `/api/transactions_history.php`

Search:
`/api/inventory.php?search=laptop`

Contoh JSON tambah barang:
{
  "item_name": "Monitor",
  "item_type": "Elektronik",
  "quantity": 5,
  "warehouse_id": 1,
  "serial_number": "SN-MON-001",
  "price": 1500000,
  "vendor_id": 1
}

Contoh transaksi stok:
{
  "inventory_id": 1,
  "transaction_type": "OUT",
  "quantity": 2,
  "note": "Distribusi ke cabang"
}
