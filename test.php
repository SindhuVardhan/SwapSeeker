<!-- my_products.php -->
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

// Handle form submission for visibility updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updateVisibility'])) {
        $newVisibility = $_POST['visibility'] == 'true' ? 1 : 0;
        $productId = $_POST['productId'];

        // Update visibility in the database
        $updateQuery = "UPDATE add_product SET visibility = $newVisibility WHERE id = $productId";
        if ($conn->query($updateQuery)) {
            echo "Visibility updated successfully.";
        } else {
            echo "Error updating visibility: " . $conn->error;
        }
    } elseif (isset($_POST['editProduct'])) {
        $productId = $_POST['productId'];
        $productName = $_POST['productName'];
        // Retrieve other form fields as needed

        // Update product details in the database
        $updateQuery = "UPDATE add_product SET product_name = '$productName' WHERE id = $productId";
        if ($conn->query($updateQuery)) {
            echo "Product details updated successfully.";
        } else {
            echo "Error updating product details: " . $conn->error;
        }
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
                    <th>Action</th>
                </thead>
                <tbody class="align-middle">
                    <?php
                    if (isset($userProducts) && is_array($userProducts)) {
                        foreach ($userProducts as $product) {
                            echo "<tr>";
                            echo "<td class='align-middle'><img src='img/" . explode(',', $product['image_name'])[0] . "' alt='' style='width: 50px;'> <input type='text' name='product_name' value='{$product['product_name']}' readonly></td>";
                            echo "<td class='align-middle'><input type='text' name='category' value='{$product['category']}' readonly></td>";
                            echo "<td class='align-middle'><input type='text' name='product_age' value='{$product['product_age']}' readonly></td>";
                            echo "<td class='align-middle'><input type='text' name='price' value='{$product['price']}' readonly></td>";
                            echo "<td class='align-middle'><input type='text' name='description' value='{$product['description']}' readonly></td>";
                            echo "<td class='align-middle'><input type='text' name='sell_rent' value='{$product['sell_rent']}' readonly></td>";
                            echo "<td class='align-middle'>";
                            echo "<form method='post' action=''>";
                            echo "<select class='visibility-dropdown' name='visibility'>";
                            $visibleOption = $product['visibility'] ? 'active' : 'inactive';
                            $invisibleOption = $product['visibility'] ? 'inactive' : 'active';
                            echo "<option value='true' " . ($product['visibility'] ? 'selected' : '') . ">$visibleOption</option>";
                            echo "<option value='false' " . (!$product['visibility'] ? 'selected' : '') . ">$invisibleOption</option>";
                            echo "</select>";
                            echo "<input type='hidden' name='productId' value='{$product['id']}'>";
                            echo "<input type='submit' class='btn btn-primary' name='updateVisibility' value='Save'>";
                            echo "</form>";
                            echo "</td>";

                            echo "<td class='align-middle'>";
                            echo "<button class='btn btn-success py-2 px-4 edit-btn' onclick='enableEditMode(this)'>Edit</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No visible products found for the user.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Main Product Display End -->

<script>
    function enableEditMode(button) {
        // Find the parent row
        var row = button.closest('tr');

        // Find all input fields within the row and remove the readonly attribute
        row.querySelectorAll('input').forEach(function(input) {
            input.removeAttribute('readonly');
        });

        // Change the button text to "Save"
        button.innerText = 'Save';

        // Remove the click event listener
        button.removeEventListener('click', enableEditMode);

        // Attach a new click event listener for saving the changes
        button.addEventListener('click', function() {
            // Find the parent form
            var form = button.closest('form');

            // Submit the form
            form.submit();

            // Prevent default form submission
            event.preventDefault();
        });
    }
</script>
