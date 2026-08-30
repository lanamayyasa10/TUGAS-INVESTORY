CREATE DATABASE IF NOT EXISTS inventory_management
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE inventory_management;

CREATE TABLE admins (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(30),
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE storage_units (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    warehouse_name VARCHAR(100) NOT NULL,
    location VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vendors (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    contact VARCHAR(30),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE inventory (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(150) NOT NULL,
    item_type VARCHAR(100) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    warehouse_id INT UNSIGNED NOT NULL,
    serial_number VARCHAR(100) NOT NULL UNIQUE,
    price DECIMAL(15,2) NOT NULL DEFAULT 0,
    vendor_id INT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (warehouse_id) REFERENCES storage_units(id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (vendor_id) REFERENCES vendors(id)
        ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE vendor_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    vendor_id INT UNSIGNED NOT NULL,
    item_name VARCHAR(150) NOT NULL,
    FOREIGN KEY (vendor_id) REFERENCES vendors(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE stock_transactions (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    inventory_id INT UNSIGNED NOT NULL,
    admin_id INT UNSIGNED,
    transaction_type ENUM('IN','OUT') NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    note VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (inventory_id) REFERENCES inventory(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (admin_id) REFERENCES admins(id)
        ON UPDATE CASCADE ON DELETE SET NULL
);

INSERT INTO admins (name, contact, email, password) VALUES
('Administrator', '081234567890', 'admin@inventory.local',
 '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC1w2a8xQfWq4p6zj8G.');

INSERT INTO storage_units (warehouse_name, location) VALUES
('Gudang Pusat', 'Surabaya'),
('Gudang Cabang', 'Sidoarjo');

INSERT INTO vendors (name, contact) VALUES
('PT Supplier Nusantara', '081122334455'),
('CV Maju Jaya', '082233445566');

INSERT INTO inventory
(item_name, item_type, quantity, warehouse_id, serial_number, price, vendor_id)
VALUES
('Laptop Lenovo', 'Elektronik', 10, 1, 'SN-LNV-001', 8500000, 1),
('Mouse Wireless', 'Aksesoris', 25, 1, 'SN-MOU-001', 175000, 2),
('Keyboard Mechanical', 'Aksesoris', 0, 2, 'SN-KEY-001', 650000, 2);

INSERT INTO vendor_items (vendor_id, item_name) VALUES
(1, 'Laptop Lenovo'),
(2, 'Mouse Wireless'),
(2, 'Keyboard Mechanical');
