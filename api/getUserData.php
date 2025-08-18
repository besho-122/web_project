<?php
require_once __DIR__ . '/config.php';
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success'=>false,'message'=>'Invalid method']); exit;
}

$orderId = isset($_POST['order_id']) ? (int)$_POST['order_id'] : 0;
if ($orderId <= 0) {
  echo json_encode(['success'=>false,'message'=>'Invalid order id']); exit;
}

$stmt = $dp->prepare("SELECT userName, ProductName FROM `Order` WHERE id=? LIMIT 1");
if (!$stmt) { echo json_encode(['success'=>false,'message'=>'DB error (prepare 1)']); exit; }
$stmt->bind_param('i', $orderId);
$stmt->execute();
$res   = $stmt->get_result();
$order = $res->fetch_assoc();
$stmt->close();

if (!$order) {
  echo json_encode(['success'=>false,'message'=>'Order not found']); exit;
}

$userName = $order['userName'] ?? '';
$product  = $order['ProductName'] ?? '';

$stmt2 = $dp->prepare("SELECT Email FROM Users WHERE userName=? LIMIT 1");
if (!$stmt2) { echo json_encode(['success'=>false,'message'=>'DB error (prepare 2)']); exit; }
$stmt2->bind_param('s', $userName);
$stmt2->execute();
$res2 = $stmt2->get_result();
$user = $res2->fetch_assoc();
$stmt2->close();

$email = $user['Email'] ?? '';
if (!$email) {
  echo json_encode(['success'=>false,'message'=>'User email not found']); exit;
}

echo json_encode([
  'success'     => true,
  'orderId'     => $orderId,
  'userName'    => $userName,
  'email'       => $email,
  'productName' => $product
]);
