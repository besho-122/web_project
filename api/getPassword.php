<?php
header('Content-Type: application/json; charset=utf-8');
require("../api/config.php");
$input = json_decode(file_get_contents('php://input'), true);
$email = $input['email'] ?? $_POST['email'] ?? null;
if (!$email) {
    echo json_encode(['success' => false, 'message' => 'Email is required']);
    exit;
}
try {
    $stmt = $dp->prepare("SELECT `Password` FROM `Users` WHERE `email` = ? LIMIT 1");
    if (!$stmt) throw new Exception("Prepare failed: " . $dp->error);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($password);
    if ($stmt->fetch()) {
        echo json_encode(['success' => true, 'password' => $password]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
    $stmt->close();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}
