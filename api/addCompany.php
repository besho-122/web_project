<?php
require("../api/config.php");

$name        = $_POST['companyName'] ?? '';
$description = $_POST['companyDescription'] ?? '';

$baseFs  = realpath(__DIR__ . "/.."); 
$logoFs  = $baseFs . "/assets/photos/Companies/Logos/"; 
$pngFs   = $baseFs . "/assets/photos/Companies/Pngs/";

$logoWeb = "../assets/photos/Companies/Logos/";
$pngWeb  = "../assets/photos/Companies/Pngs/";

if (!is_dir($logoFs)) { mkdir($logoFs, 0777, true); }
if (!is_dir($pngFs))  { mkdir($pngFs, 0777, true); }

$imagePath = "";
if (!empty($_FILES['imagecompany']['name'])) {
    $fileName = basename($_FILES['imagecompany']['name']);
    $destFs  = $logoFs . $fileName;           
    move_uploaded_file($_FILES['imagecompany']['tmp_name'], $destFs);
    $imagePath = $logoWeb . $fileName;         
}

$imagePngPath = "";
if (!empty($_FILES['imagepngcompany']['name'])) {
    $fileName = basename($_FILES['imagepngcompany']['name']);
    $destFs   = $pngFs . $fileName;
    move_uploaded_file($_FILES['imagepngcompany']['tmp_name'], $destFs);
    $imagePngPath = $pngWeb . $fileName;
}

$sql = "INSERT INTO Company (Name, Description, image, imagepng)
        VALUES ('$name', '$description', '$imagePath', '$imagePngPath')";

if ($dp->query($sql)) {
    header("Location: ../pages/dashboard.php#companies");
    exit;
} else {
    echo "db_error";
    exit;
}