<?php
include "config.php"; // Include your database connection file

// Check if the product_id and reason are set in the POST request
if (isset($_POST['product_id']) && isset($_POST['reason'])) {
    $productId = $_POST['product_id'];
    $reason = $_POST['reason'];

    // Update the report count for the product in the database
    $updateReportCountQuery = "UPDATE add_product SET report_count = report_count + 1 WHERE id = '$productId'";
    mysqli_query($conn, $updateReportCountQuery);

    // Optionally, you can insert the report details into a separate table for record-keeping
    // Insert the report into the product_reports table or perform any other necessary actions

    // Send a response indicating success
    $response = array('status' => 'success');
    echo json_encode($response);
} else {
    // Send a response indicating failure if product_id or reason is not set
    $response = array('status' => 'error', 'message' => 'Invalid request');
    echo json_encode($response);
}
?>
