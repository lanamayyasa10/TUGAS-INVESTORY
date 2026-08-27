<?php
require_once '../config/database.php';
require_once '../config/auth.php';
require_once 'helpers.php';
requireLogin();

if($_SERVER['REQUEST_METHOD']!=='POST')
    response(false,'Gunakan POST untuk transaksi stok',null,405);

$data=jsonInput();
$inventoryId=(int)($data['inventory_id']??0);
$type=strtoupper($data['transaction_type']??'');
$qty=(int)($data['quantity']??0);
$note=trim($data['note']??'');

if(!$inventoryId||!in_array($type,['IN','OUT'])||$qty<=0)
    response(false,'Data transaksi tidak valid',null,422);

$pdo->beginTransaction();
try{
    $stmt=$pdo->prepare("SELECT quantity FROM inventory WHERE id=? FOR UPDATE");
    $stmt->execute([$inventoryId]);
    $item=$stmt->fetch();
    if(!$item) throw new Exception('Barang tidak ditemukan');

    $newQty=$type==='IN' ? $item['quantity']+$qty : $item['quantity']-$qty;
    if($newQty<0) throw new Exception('Stok tidak mencukupi');

    $stmt=$pdo->prepare("UPDATE inventory SET quantity=? WHERE id=?");
    $stmt->execute([$newQty,$inventoryId]);

    $stmt=$pdo->prepare("INSERT INTO stock_transactions
    (inventory_id,admin_id,transaction_type,quantity,note) VALUES(?,?,?,?,?)");
    $stmt->execute([$inventoryId,$_SESSION['admin_id'],$type,$qty,$note]);

    $pdo->commit();
    response(true,'Transaksi stok berhasil',['new_quantity'=>$newQty]);
}catch(Throwable $e){
    $pdo->rollBack();
    response(false,$e->getMessage(),null,400);
}
