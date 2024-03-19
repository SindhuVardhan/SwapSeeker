<?php
include "includes/config.php";

$uploadDirectory = __DIR__ . '/uploads/';

// Ensure the uploads directory exists
if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0755, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user_id from the session
    $user_id = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

    if ($user_id !== null) {
        // User is authenticated, continue with the database insert

        $product_name = $_POST['product-name'];
        $category = $_POST['category'];
        $product_age = $_POST['age'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $name = $_POST['name'];
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize email
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT); // Sanitize phone number
        $contact_way = $_POST['contact-way'];
        $location = $_POST['location'];
        $sell_rent = $_POST['sell_rent'];

        $image_file_paths = [];

        foreach ($_FILES["image"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["image"]["name"][$key];
            $file_tmp = $_FILES["image"]["tmp_name"][$key];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);

            if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif', 'PNG', 'webp'])) {
                $newFileName = time() . "_" . $file_name;
                $uploadPath = $uploadDirectory . $newFileName;

                if (move_uploaded_file($file_tmp, $uploadPath)) {
                    $image_file_paths[] = $newFileName;
                } else {
                    echo "Error uploading file: " . $_FILES["image"]["error"][$key];
                }
            }
        }

        // Check if any images were uploaded successfully
        if (empty($image_file_paths)) {
            echo "Error: No valid images were uploaded.";
        } else {
            // Insert data into the database using prepared statements
            $imagePathsString = implode(",", $image_file_paths);

            $sql = "INSERT INTO add_product (user_id, product_name, category, product_age, price, description, image_name, name, email, phone, contact_way, location, sell_rent)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);

            // Check if the statement was prepared successfully
            if ($stmt) {
                // Bind parameters
                mysqli_stmt_bind_param($stmt, "issssssssssss", $user_id, $product_name, $category, $product_age, $price, $description, $imagePathsString, $name, $email, $phone, $contact_way, $location, $sell_rent);

                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script type='text/javascript'>alert('Product added successfully.');window.location.href='ok.php';</script>";
                } else {
                    echo "Error executing statement: " . mysqli_stmt_error($stmt);
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing statement: " . mysqli_error($conn);
            }

            // Close the connection
            mysqli_close($conn);
        }
    } else {
        // User is not authenticated, show an error message
        echo "Error: User not authenticated.";
    }
}
?>
