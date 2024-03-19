<?php
// Include the database connection configuration
include "config.php";

// Check if POST variables are set
if(isset($_POST['razorpay_payment_id'], $_POST['totalAmount'], $_POST['product_id'], $_POST['user_id'])) {
    // Store POST variables in local variables
    $payment_id = $_POST['razorpay_payment_id'];
    $amount = $_POST['totalAmount'];
    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id']; // Retrieve user ID from POST data

    // Use user_id as order_id
    $order_id = $user_id;

    // Insert order into the orders table
    $sql = "INSERT INTO orders (order_id, user_id, payment_id, amount, product_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $order_id, $user_id, $payment_id, $amount, $product_id);

    if ($stmt->execute()) {
        $arr = array('msg' => 'Payment successfully credited', 'status' => true);
        echo json_encode($arr);
    } else {
        $arr = array('msg' => 'Error: Unable to insert data into the database', 'status' => false);
        echo json_encode($arr);
    }

    // Close the statement
    $stmt->close();
} else {
    $arr = array('msg' => 'Error: POST variables not set', 'status' => false);
    echo json_encode($arr);
}

// Close the database connection
$conn->close();
?>
