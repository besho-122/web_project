<?php
// Clean JSON response for AJAX
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

require("../api/config.php");

$response = ["success" => false, "message" => "Invalid request"];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    // Map POST fields
    $data = [
        'Name'      => $_POST['Name'] ?? '',
        'Price'     => $_POST['Price'] ?? '',
        'Year'      => $_POST['Year'] ?? '',
        'Condition' => $_POST['Condition'] ?? '',
        'MileAge'   => $_POST['MileAge'] ?? '',
        'Exterior'  => $_POST['Exterior'] ?? '',
        'Interior'  => $_POST['Interior'] ?? '',
        'CompanyId' => $_POST['CompanyId'] ?? '',
        'Model'     => $_POST['Model'] ?? ''
    ];

    // Handle images
    $images = [];
    $uploadDir = realpath(__DIR__ . "/../assets/photos/products/") . "/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    for ($i = 1; $i <= 5; $i++) {
        $field = 'img' . $i;
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === 0) {
            // Delete old image if exists
            $res = $dp->query("SELECT `$field` FROM Product WHERE id = '$id'");
            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                if (!empty($row[$field]) && file_exists(__DIR__ . "/.." . substr($row[$field], 2))) {
                    @unlink(__DIR__ . "/.." . substr($row[$field], 2));
                }
            }

            // Save new image
            $filename = time() . "_$i_" . basename($_FILES[$field]['name']);
            $filepath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $filepath)) {
                $images[$field] = "../assets/photos/products/" . $filename;
            }
        }
    }

    // Prepare SQL
    $numericColumns = ['Price','Year','MileAge','CompanyId'];
    $updates = [];

    foreach ($data as $col => $value) {
        if (in_array($col, $numericColumns)) {
            $updates[] = "`$col`=" . ($value !== '' ? (int)$value : "NULL");
        } else {
            $updates[] = "`$col`='" . $dp->real_escape_string($value) . "'";
        }
    }

    foreach ($images as $field => $path) {
        $updates[] = "`$field`='" . $dp->real_escape_string($path) . "'";
    }

    $sql = "UPDATE Product SET " . implode(", ", $updates) . " WHERE id='$id'";

    if ($dp->query($sql)) {
        $response = ["success" => true];
    } else {
        $response = ["success" => false, "message" => $dp->error];
    }
}

echo json_encode($response);
exit;
