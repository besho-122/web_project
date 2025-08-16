<?php
require("../api/config.php");

$id = (int)($_GET['id'] ?? 0);

$sql = "SELECT * FROM Product WHERE id=$id LIMIT 1";
$result = $dp->query($sql);

if($result && $result->num_rows > 0){
    $product = $result->fetch_assoc();
    echo json_encode($product);
} else {
    echo json_encode([]);
}
?>
