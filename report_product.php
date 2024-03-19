<?php
// report_product.php

session_start();
include "includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reason = $_POST['reason'];
    $product_id = $_POST['product_id'];

    // You should validate and sanitize the inputs before using in the query to prevent SQL injection

    // Insert the report into the database
    $insertQuery = "INSERT INTO product_reports (product_id, user_id, reason) VALUES ('$product_id', '{$_SESSION['uid']}', '$reason')";
    if (mysqli_query($conn, $insertQuery)) {
        echo "Report added successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Invalid request!";
}
?>
