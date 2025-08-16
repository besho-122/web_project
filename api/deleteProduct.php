<?php
require("../api/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    // Fetch product images
    $res = $dp->query("SELECT img1, img2, img3, img4, img5 FROM Product WHERE id = '$id'");
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        for ($i = 1; $i <= 5; $i++) {
            $imgField = 'img'.$i;
            if (!empty($row[$imgField]) && file_exists($row[$imgField])) {
                unlink($row[$imgField]);
            }
        }
    }

    // Delete the product
    $sql = "DELETE FROM Product WHERE id = '$id'";
    if ($dp->query($sql)) {
        echo "success";
        exit;
    } else {
        echo "db_error";
        exit;
    }
}

echo "invalid_request";
?>
