<?php
require("../api/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    
    $res = $dp->query("SELECT image, imagepng FROM Company WHERE id = '$id'");
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if (!empty($row['image']) && file_exists($row['image'])) {
            unlink($row['image']);
        }
        if (!empty($row['imagepng']) && file_exists($row['imagepng'])) {
            unlink($row['imagepng']);
        }
    }

    $sql = "DELETE FROM Company WHERE id = '$id'";
    if ($dp->query($sql)) {
        echo "success";
        exit;
    } else {
        echo "db_error";
        exit;
    }
}

echo "invalid_request";
