<?php
require_once '../config/database.php';
require_once '../config/auth.php';
require_once 'helpers.php';
requireLogin();

$method=$_SERVER['REQUEST_METHOD'];

if($method==='GET'){
    $stmt=$pdo->query("SELECT v.*,GROUP_CONCAT(vi.item_name SEPARATOR ', ') supplied_items
                       FROM vendors v LEFT JOIN vendor_items vi ON vi.vendor_id=v.id
                       GROUP BY v.id ORDER BY v.name");
    response(true,'Data vendor',$stmt->fetchAll());
}

$data=jsonInput();

if($method==='POST'){
    if(empty($data['name'])) response(false,'Nama vendor wajib diisi',null,422);
    $pdo->beginTransaction();
    try{
        $stmt=$pdo->prepare("INSERT INTO vendors(name,contact) VALUES(?,?)");
        $stmt->execute([trim($data['name']),trim($data['contact']??'')]);
        $vendorId=$pdo->lastInsertId();
        foreach(($data['items']??[]) as $item){
            if(trim($item)!==''){
                $stmt=$pdo->prepare("INSERT INTO vendor_items(vendor_id,item_name) VALUES(?,?)");
                $stmt->execute([$vendorId,trim($item)]);
            }
        }
        $pdo->commit();
        response(true,'Vendor berhasil ditambahkan',['id'=>$vendorId],201);
    }catch(Throwable $e){
        $pdo->rollBack();
        response(false,'Gagal menambahkan vendor',null,500);
    }
}

if($method==='PUT'){
    $id=(int)($_GET['id']??0);
    $stmt=$pdo->prepare("UPDATE vendors SET name=?,contact=? WHERE id=?");
    $stmt->execute([trim($data['name']),trim($data['contact']??''),$id]);
    response(true,'Vendor berhasil diperbarui');
}

if($method==='DELETE'){
    $id=(int)($_GET['id']??0);
    $stmt=$pdo->prepare("DELETE FROM vendors WHERE id=?");
    $stmt->execute([$id]);
    response(true,'Vendor berhasil dihapus');
}

response(false,'Method tidak didukung',null,405);
