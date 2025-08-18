<?php
require("../api/config.php");

$id          = $_POST['companyId'] ?? '';
$name        = $_POST['companyName'] ?? '';
$description = $_POST['companyDescription'] ?? '';

$baseFs = realpath(__DIR__ . "/..");
$logoFs = $baseFs . "/assets/photos/Companies/Logos/";
$pngFs  = $baseFs . "/assets/photos/Companies/Pngs/";
$logoWeb = "../assets/photos/Companies/Logos/";
$pngWeb  = "../assets/photos/Companies/Pngs/";

if (!is_dir($logoFs)) mkdir($logoFs, 0777, true);
if (!is_dir($pngFs))  mkdir($pngFs, 0777, true);

// Current images from hidden inputs
$imagePath    = $_POST['currentImage'] ?? '';
$imagePngPath = $_POST['currentImagePng'] ?? '';

// Only overwrite if a new file is uploaded
if (!empty($_FILES['imagecompany']['name'])) {
    $fileName = basename($_FILES['imagecompany']['name']);
    $destFs   = $logoFs . $fileName;
    if (move_uploaded_file($_FILES['imagecompany']['tmp_name'], $destFs)) {
        $imagePath = $logoWeb . $fileName;
    }
}

if (!empty($_FILES['imagepngcompany']['name'])) {
    $fileName = basename($_FILES['imagepngcompany']['name']);
    $destFs   = $pngFs . $fileName;
    if (move_uploaded_file($_FILES['imagepngcompany']['tmp_name'], $destFs)) {
        $imagePngPath = $pngWeb . $fileName;
    }
}

// Update database
$sql = "UPDATE Company 
        SET Name = ?, Description = ?, image = ?, imagepng = ?
        WHERE id = ?";
$stmt = $dp->prepare($sql);
$stmt->bind_param("ssssi", $name, $description, $imagePath, $imagePngPath, $id);

if ($stmt->execute()) {
    header("Location: ../pages/dashboard.php#companies");
    exit;
} else {
    echo "db_error: " . $stmt->error;
    exit;
}
?>
