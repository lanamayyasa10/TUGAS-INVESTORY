<?php
require_once '../config/database.php';
require_once '../config/auth.php';
require_once 'helpers.php';
requireLogin();

$method=$_SERVER['REQUEST_METHOD'];

if ($method==='GET') {
    $search=trim($_GET['search'] ?? '');
    $sql="SELECT i.*,s.warehouse_name,s.location,v.name AS vendor_name
          FROM inventory i
          JOIN storage_units s ON s.id=i.warehouse_id
          LEFT JOIN vendors v ON v.id=i.vendor_id";
    $params=[];
    if ($search!=='') {
        $sql.=" WHERE i.item_name LIKE ? OR i.item_type LIKE ?
                OR i.serial_number LIKE ? OR v.name LIKE ?";
        $like="%$search%";
        $params=[$like,$like,$like,$like];
    }
    $sql.=" ORDER BY i.updated_at DESC";
    $stmt=$pdo->prepare($sql);
    $stmt->execute($params);
    response(true,'Data inventory',$stmt->fetchAll());
}

$data=jsonInput();

if ($method==='POST') {
    foreach(['item_name','item_type','quantity','warehouse_id','serial_number','price'] as $f) {
        if (!isset($data[$f]) || $data[$f]==='') response(false,"Field $f wajib diisi",null,422);
    }
    try {
        $stmt=$pdo->prepare("INSERT INTO inventory
        (item_name,item_type,quantity,warehouse_id,serial_number,price,vendor_id)
        VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([
            trim($data['item_name']),trim($data['item_type']),
            (int)$data['quantity'],(int)$data['warehouse_id'],
            trim($data['serial_number']),(float)$data['price'],
            !empty($data['vendor_id'])?(int)$data['vendor_id']:null
        ]);
        response(true,'Barang berhasil ditambahkan',['id'=>$pdo->lastInsertId()],201);
    } catch(PDOException $e) {
        response(false,'Serial number sudah digunakan atau data tidak valid',null,409);
    }
}

if ($method==='PUT') {
    $id=(int)($_GET['id']??0);
    if(!$id) response(false,'ID inventory tidak valid',null,422);
    try {
        $stmt=$pdo->prepare("UPDATE inventory SET item_name=?,item_type=?,
        quantity=?,warehouse_id=?,serial_number=?,price=?,vendor_id=? WHERE id=?");
        $stmt->execute([
            trim($data['item_name']),trim($data['item_type']),
            (int)$data['quantity'],(int)$data['warehouse_id'],
            trim($data['serial_number']),(float)$data['price'],
            !empty($data['vendor_id'])?(int)$data['vendor_id']:null,$id
        ]);
        response(true,'Barang berhasil diperbarui');
    } catch(PDOException $e) {
        response(false,'Gagal memperbarui data',null,409);
    }
}

if ($method==='DELETE') {
    $id=(int)($_GET['id']??0);
    $stmt=$pdo->prepare("DELETE FROM inventory WHERE id=?");
    $stmt->execute([$id]);
    response(true,'Barang berhasil dihapus');
}

response(false,'Method tidak didukung',null,405);
