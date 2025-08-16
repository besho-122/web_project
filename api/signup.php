<?php 
require("config.php");

// نقبل حقول الفورم العادي أو تسجيل جوجل
if (
    (isset($_POST['nameCreate'], $_POST['emailCreate'], $_POST['passwordCreate'])) ||
    (isset($_POST['userName'], $_POST['Email'], $_POST['Password']))
) {
    // خذ القيم حسب المتوفّر
    $name     = $_POST['nameCreate']     ?? $_POST['userName'];
    $email    = $_POST['emailCreate']    ?? $_POST['Email'];
    $password = $_POST['passwordCreate'] ?? $_POST['Password'];

    $sql = "INSERT INTO Users (userName, Email, Password) VALUES ('$name', '$email', '$password')";
    $ok  = $dp->query($sql) === TRUE;

    // توحيد صفحة التحويل لتتوافق مع باقي الكود
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