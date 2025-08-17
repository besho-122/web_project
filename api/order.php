<?php
require 'config.php';
header('Content-Type: application/json; charset=utf-8');

if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$userName = $_SESSION['userName'] ?? 'Guest';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $raw  = file_get_contents('php://input');
    $data = json_decode($raw, true);

    if (!isset($data['cars']) || !is_array($data['cars'])) {
        echo json_encode(['success'=>false, 'message'=>'Invalid data']); exit;
    }
    if (empty($data['cars'])) {
        echo json_encode(['success'=>false, 'message'=>'Cart is empty']); exit;
    }
    $dp->begin_transaction();
    $sel = $dp->prepare('SELECT Name, Price FROM Product WHERE id = ? LIMIT 1');
    $ins = $dp->prepare('INSERT INTO `Order` (userName, ProductId, ProductName, ProductPrice, Status)
                         VALUES (?, ?, ?, ?, ?)');

    $status = 'pending';

    foreach ($data['cars'] as $car) {
        $pid = (int)($car['id'] ?? 0);
        if ($pid <= 0) throw new Exception('Invalid product id');
        $sel->bind_param('i', $pid);
        $sel->execute();
        $row = $sel->get_result()->fetch_assoc();
        if (!$row) throw new Exception("Product #$pid not found");

        $name  = $row['Name'];
        $price = (float)$row['Price'];
        $ins->bind_param('sisss', $userName, $pid, $name, $price, $status);
        $ins->bind_param('sisds', $userName, $pid, $name, $price, $status);
        $ins->execute();
    }

    $sel->close();
    $ins->close();
    $dp->commit();

    echo json_encode(['success'=>true, 'message'=>'Order saved successfully']);
} catch (Throwable $e) {
    if ($dp->errno === 0) { /* ignore */ }
    try { $dp->rollback(); } catch (Throwable $ignored) {}
    echo json_encode(['success'=>false, 'message'=>$e->getMessage()]);
}