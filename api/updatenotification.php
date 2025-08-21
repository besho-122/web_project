<?php
require('config.php');
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['userName'])) {
  echo json_encode(['success' => false, 'message' => 'Not authenticated']);
  exit;
}

$raw = file_get_contents('php://input');
$payload = json_decode($raw, true);
$value = trim($payload['value'] ?? '');

if (!in_array($value, ['Yes','No'], true)) {
  echo json_encode(['success' => false, 'message' => 'Invalid value (use Yes/No)']);
  exit;
}

$userName = $_SESSION['userName'];

$stmt = $dp->prepare("UPDATE Users SET Notifications = ? WHERE userName = ? LIMIT 1");
if (!$stmt) {
  echo json_encode(['success' => false, 'message' => 'DB prepare failed']);
  exit;
}
$stmt->bind_param('ss', $value, $userName);
$ok = $stmt->execute();
$stmt->close();

echo json_encode(['success' => (bool)$ok, 'message' => $ok ? 'OK' : 'DB update failed']);
exit;
?>