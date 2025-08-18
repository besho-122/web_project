<?php
require_once __DIR__ . '/config.php';
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success'=>false, 'message'=>'Invalid method']); exit;
}

$id     = isset($_POST['order_id']) ? (int)$_POST['order_id'] : 0;
$status = trim($_POST['new_status'] ?? '');

if ($id <= 0 || $status === '') {
  echo json_encode(['success'=>false, 'message'=>'Missing params']); exit;
}

$stmt = $dp->prepare("UPDATE `Order` SET `Status`=? WHERE `id`=?");
if (!$stmt) { echo json_encode(['success'=>false, 'message'=>'Prepare failed: '.$dp->error]); exit; }

$stmt->bind_param('si', $status, $id);
$ok = $stmt->execute();
$stmt->close();

echo json_encode([
  'success' => (bool)$ok,
  'message' => $ok ? 'Status updated' : 'Execute failed'
]);