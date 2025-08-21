<?php
require("config.php");
session_start();
header("Content-Type: application/json; charset=utf-8");
$id = $_SESSION['lastAddedCarId'] ?? 0;
if ($id <= 0) {
    echo json_encode(["success"=>false, "message"=>"No car in session"]);
    exit;
}
$res = $dp->prepare("SELECT 
    P.id, P.Name AS carName, P.Model, P.Year, P.Price, 
    P.Exterior AS color, P.Interior AS color2, P.img1 AS image_url, 
    C.Name AS company
FROM Product P 
LEFT JOIN Company C ON P.CompanyId = C.id
WHERE P.id = ? LIMIT 1");
$res->bind_param("i", $id);
$res->execute();
$car = $res->get_result()->fetch_assoc();
if ($car) {
    echo json_encode($car);
} else {
    echo json_encode(["success"=>false, "message"=>"Car not found"]);
}