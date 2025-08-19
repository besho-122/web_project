<?php
$targetDir = "../assets/videos/homePage/";
$targetFile = $targetDir . "main.mp4";  

if (!isset($_FILES['video']) || $_FILES['video']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo "Error uploading the video.";
    exit;
}

if (move_uploaded_file($_FILES['video']['tmp_name'], $targetFile)) {
    echo "Video replaced successfully!";
} else {
    http_response_code(500);
    echo "Error replacing the video.";
}