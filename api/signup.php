<?php 
require("../api/config.php");

if (isset($_POST['nameCreate'], $_POST['emailCreate'], $_POST['passwordCreate'])) {
    $name     = $_POST['nameCreate'];
    $email    = $_POST['emailCreate'];
    $password = $_POST['passwordCreate'];

    $sql = "INSERT INTO Users (userName, Email, Password) VALUES ('$name', '$email', '$password')";
    $ok  = $dp->query($sql) === TRUE;

    $nextOnSuccess = '../pages/login.php';
    $nextOnError   = '../pages/login.php'; 


    if ($ok) {
        header("Location: ../pages/loading.php?action=signup&status=success&next=" . rawurlencode($nextOnSuccess));
        exit;
    } else {
        header("Location: ../pages/loading.php?action=signup&status=error&next=" . rawurlencode($nextOnError));
        exit;
    }
}
?>