<?php
require_once '../config/database.php';
require_once '../config/auth.php';
require_once 'helpers.php';
requireLogin();

$method=$_SERVER['REQUEST_METHOD'];

if($method==='GET'){
    $stmt=$pdo->query("SELECT * FROM storage_units ORDER BY warehouse_name");
    response(true,'Data gudang',$stmt->fetchAll());
}

$data=jsonInput();

if($method==='POST'){
    if(empty($data['warehouse_name'])||empty($data['location']))
        response(false,'Nama gudang dan lokasi wajib diisi',null,422);
    $stmt=$pdo->prepare("INSERT INTO storage_units(warehouse_name,location) VALUES(?,?)");
    $stmt->execute([trim($data['warehouse_name']),trim($data['location'])]);
    response(true,'Gudang berhasil dibuat',['id'=>$pdo->lastInsertId()],201);
}

if($method==='PUT'){
    $id=(int)($_GET['id']??0);
    $stmt=$pdo->prepare("UPDATE storage_units SET warehouse_name=?,location=? WHERE id=?");
    $stmt->execute([trim($data['warehouse_name']),trim($data['location']),$id]);
    response(true,'Gudang berhasil diperbarui');
}

if($method==='DELETE'){
    $id=(int)($_GET['id']??0);
    try{
        $stmt=$pdo->prepare("DELETE FROM storage_units WHERE id=?");
        $stmt->execute([$id]);
        response(true,'Gudang berhasil dihapus');
    }catch(PDOException $e){
        response(false,'Gudang masih digunakan oleh inventory',null,409);
    }
}

response(false,'Method tidak didukung',null,405);
