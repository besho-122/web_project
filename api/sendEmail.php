<?php
require("../api/config.php");

if (!empty($_POST['email'])) {
    $email = $_POST['email'];

    $sql = "SELECT Password, userName FROM Users WHERE email = ?";
    $stmt = $dp->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($password, $userName); 

    if ($stmt->fetch()) {
        echo json_encode([
            'password' => $password,
            'userName' => $userName
        ]);
    } else {
        echo "NOT_FOUND";
    }
    $stmt->close();
}
?>