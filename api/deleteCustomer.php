<?php
require("../api/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userName'])) {
    $userName = $dp->real_escape_string($_POST['userName']);
    $sql = "DELETE FROM Users WHERE userName = '$userName'";
    if ($dp->query($sql)) {
        echo "success";
        exit;
    } else {
        echo "db_error";
        exit;
    }
}

echo "invalid_request";
