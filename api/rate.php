<?php
require 'config.php';
header('Content-Type: application/json; charset=utf-8');
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$userName = $_SESSION['userName'] ?? '';
if ($userName === '') {
  http_response_code(401);
  echo json_encode(['success' => false, 'message' => 'Please log in first.']);
  exit;
}
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
$rating = isset($data['rating']) ? (int)$data['rating'] : 0;
if ($rating < 1 || $rating > 5) {
  echo json_encode(['success' => false, 'message' => 'Invalid rating value.']);
  exit;
}
try {
  $sql = "INSERT INTO `FeedBack` (`userName`, `Value`)
          VALUES (?, ?)
          ON DUPLICATE KEY UPDATE `Value` = VALUES(`Value`)";
  $stmt = $dp->prepare($sql);
  if (!$stmt) {
    http_response_code(500);
    echo json_encode([
      'success' => false,
      'message' => 'DB error (prepare).',
      'debug'   => $dp->error 
    ]);
    exit;
  }

  $stmt->bind_param('si', $userName, $rating);
  $ok = $stmt->execute();

  if (!$ok) {
    http_response_code(500);
    echo json_encode([
      'success' => false,
      'message' => 'DB error (execute).',
      'debug'   => $stmt->error 
    ]);
    $stmt->close();
    exit;
  }

  $stmt->close();

  echo json_encode([
    'success' => true,
    'message' => 'Your rating has been saved.'
  ]);

} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode([
    'success' => false,
    'message' => 'Server error.',
    'debug'   => $e->getMessage() 
  ]);
}