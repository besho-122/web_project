<?php
require("config.php");
header("Content-Type: application/json; charset=utf-8");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    echo json_encode(["success"=>false, "message"=>"Invalid product id"]);
    exit;
}


$stmt = $dp->prepare("SELECT 
    P.id, 
    P.Name AS carName, 
    P.Model, 
    P.Year, 
    P.Price, 
    P.Exterior AS color, 
    P.Interior AS color2, 
    P.img1 AS image_url, 
    C.Name AS company
FROM Product P 
LEFT JOIN Company C ON P.CompanyId = C.id
WHERE P.id = ? LIMIT 1");

if (!$stmt) {
    echo json_encode(["success"=>false, "message"=>"DB prepare failed"]);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$car = $res->fetch_assoc();
$stmt->close();

if ($car) {
    echo json_encode(["success"=>true, "car"=>$car]);
} else {
    echo json_encode(["success"=>false, "message"=>"Car not found"]);
}