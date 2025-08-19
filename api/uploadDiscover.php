<?php
header('Content-Type: application/json; charset=utf-8');

$targetDir = __DIR__ . "/../assets/photos/discover/";
if (!is_dir($targetDir)) {
  mkdir($targetDir, 0777, true);
}

$response = ["success" => false];

foreach (["discover1","discover2","discover3"] as $name) {
  if (!empty($_FILES[$name]["tmp_name"]) && is_uploaded_file($_FILES[$name]["tmp_name"])) {
    $fileIndex = str_replace("discover", "", $name);
    $targetFile = $targetDir . "img{$fileIndex}.jpg";

    if (move_uploaded_file($_FILES[$name]["tmp_name"], $targetFile)) {
      $response[$name] = "../assets/photos/discover/img{$fileIndex}.jpg";
      $response["success"] = true;
    } else {
      $response["message"] = "Error uploading $name";
    }
  }
}

echo json_encode($response);
exit;