<?php
include "includes/header.php";

// Establish a MySQLi database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swapseeker";

$Style = 'style="border:none;outline:none;text-align:center"';
$Style2 = 'style="border:none;outline:none;display:block;"';
$Style3 = 'style="margin-bottom:10px;display:block;"';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$userID = isset($_SESSION["uid"]) ? $_SESSION["uid"] : null;

// Check if user ID is available
if (!$userID) {
    echo "User ID not found. Please log in.";
    exit;
}

// Retrieve address details based on the user ID
$query = "SELECT * FROM userdetails WHERE userid = $userID";
$result = $conn->query($query);

$addressDetails = array(); // Initialize an array to store address details

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $addressDetails[] = $row; // Store each address detail in the array
    }
} else {
    echo "No addresses found.";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['edit'])) {
        $productId = $_POST['productId'];
        $productName = $_POST['name'];
        $category = $_POST['category'];
        $age = $_POST['age'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $sellRent = $_POST['sell_rent'];
        $visibility = isset($_POST['visibility']) ? ($_POST['visibility'] == 'true' ? 1 : 0) : 0;

        // Update product details in the database
        $updateQuery = "UPDATE add_product SET product_name = '$productName', category = '$category', product_age = '$age', price = '$price', description = '$description', sell_rent = '$sellRent', visibility = $visibility WHERE id = $productId";
        if ($conn->query($updateQuery)) {
            echo "Product details updated successfully.";
        } else {
            echo "Error updating product details: " . $conn->error;
        }
    }

    if(isset($_POST['delete'])) {
        $deleteProductId = $_POST['deleteProductId'];

        // Delete product from the database
        $deleteQuery = "DELETE FROM add_product WHERE id = $deleteProductId";
        if ($conn->query($deleteQuery)) {
            echo "Product deleted successfully.";
            // Refresh the page or update the product list
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit;
        } else {
            echo "Error deleting product: " . $conn->error;
        }
    }
}


// Retrieve user's products from the database
if ($userID) {
    $query = "SELECT * FROM add_product WHERE user_id = $userID";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $userProducts = $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>

<!-- Edit Address Form within Table -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">My Products</span></h5>
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Age</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Sell/Rent</th>
                        <th>Visibility</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php foreach ($userProducts as $product): ?>
                        <tr>
                            <form method="post">
                                <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                                <td><input type="text" name="name" <?php echo isset($_POST['edit'.$product['id']]) ? '' : $Style; ?> value="<?php echo $product['product_name']; ?>" <?php echo isset($_POST['edit'.$product['id']]) ? '' : 'readonly'; ?>></td>
                                <td><input type="text" name="category" <?php echo isset($_POST['edit'.$product['id']]) ? '' : $Style; ?> value="<?php echo $product['category']; ?>" <?php echo isset($_POST['edit'.$product['id']]) ? '' : 'readonly'; ?>></td>
                                <td><input type="text" name="age" <?php echo isset($_POST['edit'.$product['id']]) ? '' : $Style; ?> value="<?php echo $product['product_age']; ?>" <?php echo isset($_POST['edit'.$product['id']]) ? '' : 'readonly'; ?>></td>
                                <td><input type="text" name="price" <?php echo isset($_POST['edit'.$product['id']]) ? '' : $Style; ?> value="<?php echo $product['price']; ?>" <?php echo isset($_POST['edit'.$product['id']]) ? '' : 'readonly'; ?>></td>
                                <td><input type="text" name="description" <?php echo isset($_POST['edit'.$product['id']]) ? '' : $Style; ?> value="<?php echo $product['description']; ?>" <?php echo isset($_POST['edit'.$product['id']]) ? '' : 'readonly'; ?>></td>
                                <td><input type="text" name="sell_rent" <?php echo isset($_POST['edit'.$product['id']]) ? '' : $Style; ?> value="<?php echo $product['sell_rent']; ?>" <?php echo isset($_POST['edit'.$product['id']]) ? '' : 'readonly'; ?>></td>
                                <td>
                                    <select name="visibility" <?php echo isset($_POST['edit'.$product['id']]) ? '' : 'disabled'; ?>>
                                        <option value='true' <?php echo $product['visibility'] ? 'selected' : ''; ?>>Active</option>
                                        <option value='false' <?php echo !$product['visibility'] ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                </td>


                                <td>
                                    <?php if(isset($_POST['edit'.$product['id']])): ?>
                                        <input type="submit" name="edit" value="Save" class="btn btn-primary">
                                    <?php else: ?>
                                        <input type="submit" name="edit<?php echo $product['id']; ?>" value="Edit" class="btn btn-primary">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        <input type="hidden" name="deleteProductId" value="<?php echo $product['id']; ?>">
                                        <button type="submit" name="delete" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i> 
                                        </button>
                                    </form>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$conn->close();
?>
