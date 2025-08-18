<?php
// Make sure this path is correct
require("../api/config.php"); // your mysqli connection

header('Content-Type: text/plain'); // for debugging

if(isset($_POST['id']) && isset($_POST['status'])){
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    // Debug: log received values
    error_log("Received ID: $id, Status: $status");

    // Prepare statement
    if($stmt = $dp->prepare("UPDATE orders SET Status=? WHERE ProductId=?")) {
        $stmt->bind_param("si", $status, $id);
        if($stmt->execute()){
            echo "Status updated successfully";
        } else {
            echo "Error executing query: ".$stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: ".$dp->error;
    }
} else {
    echo "ID or status not received";
}
?>
