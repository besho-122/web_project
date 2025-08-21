<?php
require("config.php");
header("Content-Type: application/json; charset=utf-8");
$res = $dp->query("SELECT Email FROM Users WHERE role = 'user'and Notifications = 'Yes'");
$emails = $res->fetch_all(MYSQLI_ASSOC);
echo json_encode($emails);
$dp->close();
?>