<?php
session_start();
require("config.php");

if (isset($_POST['emailLogin']) && isset($_POST['passwordLogin'])) {
    $email = $_POST['emailLogin'];
    $password = $_POST['passwordLogin'];
    $sql = "SELECT * FROM Users WHERE email = '$email' AND Password = '$password'";
    $result = $dp->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['isLoggedIn'] = true;
        $_SESSION['userName']    = $row['userName'] ?? null;
        $_SESSION['role']       = $row['role'] ?? 'user';

        $next = ($row['role'] === 'admin') ? '../pages/dashboard.php' : '../index.php';

        header("Location: ../pages/loading.php?status=success&next=" . urlencode($next));
        exit;
    } else {
        $_SESSION['isLoggedIn'] = false;
        header("Location: ../pages/loading.php?status=error&next=" . urlencode("../pages/login.php"));
        exit;
    }
}
