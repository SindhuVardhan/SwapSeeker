<?php

include "../../includes/config.php";

$RequestMethod = $_SERVER["REQUEST_METHOD"];

if ($RequestMethod == "POST") {

    try {
        // Retrieve data from the POST request
        $user_id = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

        if ($user_id !== null) {
            // User is authenticated, continue with the database insert

            $product_name = addslashes(trim($_POST['product-name']));
            $category = addslashes(trim($_POST['category']));
            $product_age = addslashes(trim($_POST['age']));
            $price = addslashes(trim($_POST['price']));
            $description = addslashes(trim($_POST['description']));
            $name = addslashes(trim($_POST['name']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize email
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT); // Sanitize phone number
            $contact_way = addslashes(trim($_POST['contact-way']));
            $location = addslashes(trim($_POST['location']));
            $sell_rent = addslashes(trim($_POST['sell_rent']));

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
                        $Data = [
                            'status' => 400,
                            'message' => "Error uploading file: " . $_FILES["image"]["error"][$key]
                        ];

                        header("HTTP/1.0 400 Bad Request");
                        echo json_encode($Data);
                        exit;
                    }
                }
            }

            // Check if any images were uploaded successfully
            if (empty($image_file_paths)) {
                $Data = [
                    'status' => 400,
                    'message' => "Error: No valid images were uploaded."
                ];

                header("HTTP/1.0 400 Bad Request");
                echo json_encode($Data);
                exit;
            }

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
                    $Data = [
                        'status' => 200,
                        'message' => 'Product added successfully.'
                    ];
                    header("HTTP/1.0 200 Success");
                    echo json_encode($Data);
                } else {
                    $Data = [
                        'status' => 500,
                        'message' => "Error executing statement: " . mysqli_stmt_error($stmt)
                    ];
                    header("HTTP/1.0 500 Internal Server Error");
                    echo json_encode($Data);
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                $Data = [
                    'status' => 500,
                    'message' => "Error preparing statement: " . mysqli_error($conn)
                ];
                header("HTTP/1.0 500 Internal Server Error");
                echo json_encode($Data);
            }

            // Close the connection
            mysqli_close($conn);
        } else {
            // User is not authenticated, show an error message
            $Data = [
                'status' => 401,
                'message' => 'Error: User not authenticated.'
            ];
            header("HTTP/1.0 401 Unauthorized");
            echo json_encode($Data);
        }
    } catch (Exception $ex) {
        $Data = [
            'status' => 500,
            'message' => 'Server Error: Something went wrong'
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($Data);
    }
} else {
    $Data = [
        'status' => 405,
        'message' => $RequestMethod . ' Method Not Allowed'
    ];

    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($Data);
}
?>
