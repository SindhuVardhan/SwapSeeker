<?php
// Include your config file and database connection here
include "../includes/config.php";

$ResponseArray = array();

if (isset($_POST['query'])) {  // Change to $_POST
    $searchTerm = mysqli_real_escape_string($conn, $_POST['query']);

    // Modify the query based on your database schema and structure
    $searchQuery = "SELECT * FROM add_product WHERE product_name LIKE '%$searchTerm%'";
    $searchResults = mysqli_query($conn, $searchQuery);

    if ($searchResults) {
        $ResponseArray["status"] = "200";
        $ResponseArray["message"] = "Search successful";
        $ResponseArray["results"] = array();

        while ($row = mysqli_fetch_assoc($searchResults)) {
            // Adjust the structure based on your database schema
            $resultItem = array(
                'id' => $row['id'],
                'name' => $row['product_name'],
                'category' => $row['category'],
                'age' => $row['product_age'],
                'price' => $row['price'],
                'description' => $row['description'],
                'image_name' => $row['image_name'],
                // Add more fields as needed
            );
            $ResponseArray["results"][] = $resultItem;
        }
    } else {
        $ResponseArray["status"] = "404";
        $ResponseArray["message"] = "No results found";
    }
} else {
    $ResponseArray["status"] = "400";
    $ResponseArray["message"] = "Invalid query parameter";
}

$Response = json_encode($ResponseArray, true);
echo $Response;
exit;
?>
