<?php
require("../api/config.php");

// Get form data & clean
$model      = $_POST['Model'] ?? '';
$interior   = $_POST['Interior'] ?? '';
$exterior   = $_POST['Exterior'] ?? '';
$mileage    = $_POST['MileAge'] ?? ''; 
$year       = $_POST['Year'] ?? '';
$price      = $_POST['Price'] ?? '';
$condition  = $_POST['Condition'] ?? '';
$companyId  = $_POST['CompanyId'] ?? '';
$name       = $_POST['Name'] ?? '';

// Base paths
$baseFs = realpath(__DIR__ . "/.."); 
$img1Fs = $baseFs . "/assets/photos/Products/img1/";
$img2Fs = $baseFs . "/assets/photos/Products/img2/";
$img3Fs = $baseFs . "/assets/photos/Products/img3/";
$img4Fs = $baseFs . "/assets/photos/Products/img4/";
$img5Fs = $baseFs . "/assets/photos/Products/img5/";

$img1Web = "../assets/photos/Products/img1/";
$img2Web = "../assets/photos/Products/img2/";
$img3Web = "../assets/photos/Products/img3/";
$img4Web = "../assets/photos/Products/img4/";
$img5Web = "../assets/photos/Products/img5/";

// Create folders if not exist
foreach ([$img1Fs, $img2Fs, $img3Fs, $img4Fs, $img5Fs] as $dir) {
    if (!is_dir($dir)) { mkdir($dir, 0777, true); }
}

// Upload each image separately
$img1Path = "";
if (!empty($_FILES['img1']['name'])) {
    $fileName = basename($_FILES['img1']['name']);
    move_uploaded_file($_FILES['img1']['tmp_name'], $img1Fs . $fileName);
    $img1Path = $img1Web . $fileName;
}

$img2Path = "";
if (!empty($_FILES['img2']['name'])) {
    $fileName = basename($_FILES['img2']['name']);
    move_uploaded_file($_FILES['img2']['tmp_name'], $img2Fs . $fileName);
    $img2Path = $img2Web . $fileName;
}

$img3Path = "";
if (!empty($_FILES['img3']['name'])) {
    $fileName = basename($_FILES['img3']['name']);
    move_uploaded_file($_FILES['img3']['tmp_name'], $img3Fs . $fileName);
    $img3Path = $img3Web . $fileName;
}

$img4Path = "";
if (!empty($_FILES['img4']['name'])) {
    $fileName = basename($_FILES['img4']['name']);
    move_uploaded_file($_FILES['img4']['tmp_name'], $img4Fs . $fileName);
    $img4Path = $img4Web . $fileName;
}

$img5Path = "";
if (!empty($_FILES['img5']['name'])) {
    $fileName = basename($_FILES['img5']['name']);
    move_uploaded_file($_FILES['img5']['tmp_name'], $img5Fs . $fileName);
    $img5Path = $img5Web . $fileName;
}

// Insert into DB
$sql = "INSERT INTO Product 
        (Name, CompanyId, `Condition`, Price, `Year`, MileAge, Exterior, Interior, Model, img1, img2, img3, img4, img5)
        VALUES 
        ('$name', '$companyId', '$condition', '$price', '$year', $mileage, '$exterior', '$interior', '$model', 
         '$img1Path', '$img2Path', '$img3Path', '$img4Path', '$img5Path')";

if ($dp->query($sql)) {
    header("Location: ../pages/dashboard.php#products");
    exit;
} else {
    echo "db_error: " . $dp->error;
    exit;
}
?>
