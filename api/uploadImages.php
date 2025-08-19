<?php

header('Content-Type: application/json; charset=utf-8');

$targetDir = __DIR__ . "/../assets/photos/sectionTwo/";
if (!is_dir($targetDir)) {
  mkdir($targetDir, 0777, true);
}

$response = ["success" => false];

foreach (["img1","img2","img3"] as $name) {
  if (!empty($_FILES[$name]["tmp_name"]) && is_uploaded_file($_FILES[$name]["tmp_name"])) {
    $targetFile = $targetDir . $name . ".jpg";
    if (move_uploaded_file($_FILES[$name]["tmp_name"], $targetFile)) {
      $response[$name] = "../assets/photos/sectionTwo/{$name}.jpg";
      $response["success"] = true;
    } else {
      $response["message"] = "Error uploading $name";
    }
  }
}

echo json_encode($response);
exit;