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

    // Base paths for images
    $baseFs = realpath(__DIR__ . "/.."); 
    $imgDirs = [
        "img1" => [$baseFs . "/assets/photos/Products/img1/", "../assets/photos/Products/img1/"],
        "img2" => [$baseFs . "/assets/photos/Products/img2/", "../assets/photos/Products/img2/"],
        "img3" => [$baseFs . "/assets/photos/Products/img3/", "../assets/photos/Products/img3/"],
        "img4" => [$baseFs . "/assets/photos/Products/img4/", "../assets/photos/Products/img4/"],
        "img5" => [$baseFs . "/assets/photos/Products/img5/", "../assets/photos/Products/img5/"]
    ];

    // إنشاء المجلدات إذا مش موجودة
    foreach ($imgDirs as [$fsDir, $webDir]) {
        if (!is_dir($fsDir)) mkdir($fsDir, 0777, true);
    }

    // Handle images
    $images = [];
    foreach ($imgDirs as $field => [$fsDir, $webDir]) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === 0) {
            // احذف الصورة القديمة
            $res = $dp->query("SELECT `$field` FROM Product WHERE id='$id'");
            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                if (!empty($row[$field]) && file_exists(__DIR__ . "/.." . substr($row[$field], 2))) {
                    @unlink(__DIR__ . "/.." . substr($row[$field], 2));
                }
            }

            // ارفع الصورة الجديدة
            $fileName = time() . "_" . basename($_FILES[$field]['name']);
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $fsDir . $fileName)) {
                $images[$field] = $webDir . $fileName;
            }
        }
    }

    // جهّز أعمدة التحديث
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

    // نفذ SQL
    $sql = "UPDATE Product SET " . implode(", ", $updates) . " WHERE id='$id'";

    if ($dp->query($sql)) {
        $response = ["success" => true];
    } else {
        $response = ["success" => false, "message" => $dp->error];
    }
}

echo json_encode($response);
exit;
?>