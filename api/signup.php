<?php 
require("config.php");

if (isset($_POST['nameCreate']) && isset($_POST['emailCreate']) && isset($_POST['passwordCreate'])) {
    $name = $_POST['nameCreate'];
    $email = $_POST['emailCreate'];
    $password = $_POST['passwordCreate'];

    $sql = "INSERT INTO Users (userName, email, Password) VALUES ('$name', '$email', '$password')";
    if ($dp->query($sql) === TRUE) {
        redirect("../index.html");
        
    } else {
         redirect("../login.html");
    }
}



