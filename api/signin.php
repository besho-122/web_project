<?php 
require("config.php");

if (isset($_POST['emailLogin'])&& isset($_POST['passwordLogin'])) {
    $email = $_POST['emailLogin'];
    $password = $_POST['passwordLogin'];

    $sql = "Select * from Users where email = '$email' and Password = '$password'";
    $result = $dp->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
         if ($row['role'] == 'admin') {
            

            redirect("../pages/dashboard.php");
           
        }
        else {
             redirect("../pages/products.html");
        }
    } else {
        redirect("../pages/login.html");
    }
    
}


