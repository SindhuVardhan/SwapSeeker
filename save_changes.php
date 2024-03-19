<?php
include "includes/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update user details in the sign-up table
    $user_id = $_SESSION["uid"];
    $updateUserQuery = "UPDATE signup SET username = '$username', email = '$email', phone = '$phone' WHERE id = '$user_id'";
    $updateUserResult = mysqli_query($conn, $updateUserQuery);

    if ($updateUserResult) {
        echo 'Changes saved successfully.';
    } else {
        echo 'Error occurred while saving changes.';
    }
} else {
    echo 'Invalid request method.';
}
?>
