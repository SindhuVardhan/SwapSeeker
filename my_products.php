
<?php
include "includes/header.php";

// Establish a MySQLi database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swapseeker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userID = isset($_SESSION["uid"]) ? $_SESSION["uid"] : null;

$editMode = false;

// Handle form submission for visibility updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newVisibility = $_POST['visibility'] == 'true' ? 1 : 0;
    $productId = $_POST['productId'];

    // Update visibility in the database
    $updateQuery = "UPDATE add_product SET visibility = $newVisibility WHERE id = $productId";
    if ($conn->query($updateQuery)) {
        echo "Visibility updated successfully.";
    } else {
        echo "Error updating visibility: " . $conn->error;
    }
}


// Retrieve only visible user products from the database
if ($userID) {
    $query = "SELECT * FROM add_product WHERE user_id = $userID";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $userProducts = $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

<!-- Main Product Display Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <th>Product</th>
                    <th>Category</th>
                    <th>Age</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Sell/Rent</th>
                    <th>Available</th>
                    <!-- <th>Remove</th>
                    <th>Edit</th> -->
                    <!-- Add more columns as needed -->
                </thead>
                <tbody class="align-middle">
                    <?php
                    if (isset($userProducts) && is_array($userProducts)) {
                        foreach ($userProducts as $product) {
                            echo "<tr>";
                            echo "<td class='align-middle'><img src='img/" . explode(',', $product['image_name'])[0] . "' alt='' style='width: 50px;'> {$product['product_name']}</td>";
                            echo "<td class='align-middle'>{$product['category']}</td>";
                            echo "<td class='align-middle'>{$product['product_age']}</td>";
                            echo "<td class='align-middle'>{$product['price']}</td>";
                            echo "<td class='align-middle'>{$product['description']}</td>";
                            echo "<td class='align-middle'>{$product['sell_rent']}</td>";
                            echo "<td class='align-middle'>";
                            echo "<form method='post' action=''>";  // Add form element
                            echo "<select class='visibility-dropdown' name='visibility'>"; 

                            $visibleOption = $product['visibility'] ? 'active' : 'active';
                            $invisibleOption = $product['visibility'] ? 'inactive' : 'inactive';

                            echo "<option value='true' " . ($product['visibility'] ? 'selected' : '') . ">$visibleOption</option>";
                            echo "<option value='false' " . (!$product['visibility'] ? 'selected' : '') . ">$invisibleOption</option>";

                            echo "</select>";
                            echo "<input type='hidden' name='productId' value='{$product['id']}'>";  
                            echo "<input type='submit' class='btn btn-primary' value='Save'>";  // Add submit button
                            echo "</form>";
                            echo "</td>";

                            // echo "<td class='align-middle'><button class='btn btn-sm btn-danger'><i class='fa fa-times'></i></button></td>";
                            // echo "<td><button class='btn btn-success py-2 px-4' type='submit' id='saveChanges' name='saveChanges'>Edit</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No visible products found for the user.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Main Product Display End -->
