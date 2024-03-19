<?php

include "../../includes/config.php";

$RequestMethod = $_SERVER["REQUEST_METHOD"];

if ($RequestMethod == "GET") {
    try {
        // Fetch products from the database
        $sql = "SELECT * FROM add_product WHERE visibility = 1";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $products = array();

            // Fetch product data
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = array(
                    'product_id' => $row['id'],
                    'user_id' => $row['user_id'],
                    'product_name' => $row['product_name'],
                    'category' => $row['category'],
                    'product_age' => $row['product_age'],
                    'price' => $row['price'],
                    'description' => $row['description'],
                    'image_name' => $row['image_name'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'contact_way' => $row['contact_way'],
                    'location' => $row['location'],
                    'sell_rent' => $row['sell_rent']
                );
            }

            // Return products as JSON
            $response = [
                'status' => 200,
                'products' => $products
            ];

            header("HTTP/1.0 200 OK");
            echo json_encode($response);
        } else {
            $response = [
                'status' => 500,
                'message' => 'Error fetching products: ' . mysqli_error($conn)
            ];

            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($response);
        }

        // Close the connection
        mysqli_close($conn);
    } catch (Exception $ex) {
        $response = [
            'status' => 500,
            'message' => 'Server Error: Something went wrong'
        ];

        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($response);
    }
} else {
    $response = [
        'status' => 405,
        'message' => $RequestMethod . ' Method Not Allowed'
    ];

    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($response);
}

?>
