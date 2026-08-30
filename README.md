# Inventory Management — PHP Native MVC

Versi ini adalah hasil perapian project `inventory-management` yang dikirim pengguna menjadi pola MVC dan disesuaikan dengan schema `database.sql` dari project tersebut.

## Stack
- PHP 8.x Native
- MySQL/MariaDB
- MySQLi + prepared statements
- XAMPP/Apache

## Struktur
- `app/models` — akses database
- `app/controllers` — business logic
- `app/views` — tampilan
- `config` — database, session/auth, helper
- `routes` — routing
- `public/index.php` — front controller
- `public/assets` — CSS/JS
- `database/database.sql` — schema database project pengguna

## Cara menjalankan
1. Ekstrak folder ke `C:/xampp/htdocs/`.
2. Start Apache dan MySQL di XAMPP.
3. Import `database/database.sql` ke phpMyAdmin jika perlu.
4. Buka `http://localhost/inventory-management/public/`.
5. Login menggunakan akun pada database lokal.

## Fitur
- Login/logout admin
- Dashboard monitoring
- CRUD inventory
- Search inventory
- Detail barang: stok, lokasi, harga, vendor, serial number
- CRUD gudang
- CRUD vendor
- CRUD admin
- Transaksi stok IN/OUT
- Riwayat transaksi
- Update stok otomatis dan transaksi atomik
- Pencegahan stok minus
- Alert stok habis
- Alert stok menipis (<= 5)

## Catatan penting tentang password
`database.sql` yang dikirim pada ZIP menggunakan password admin dalam bentuk hash. Jangan mengganti isi database secara manual dengan password plaintext untuk penggunaan nyata.

Kode login tetap dibuat kompatibel dengan password_hash() dan juga dapat membaca data lama plaintext bila database lama masih memilikinya, tetapi data baru/ubah password disimpan dengan `password_hash()`.
