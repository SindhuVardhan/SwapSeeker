<?php
// Start the session if needed
session_start();

// Check if user is logged in, otherwise redirect to login page


// Include database connection and other necessary files
include_once "db_connection.php";

// Fetch products data from database
$queryProducts = "SELECT * FROM add_product";
$resultProducts = mysqli_query($conn, $queryProducts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .product-images {
            display: flex;
            gap: 5px;
        }
        .product-images img {
            max-width: 100px;
            max-height: 100px;
            width: auto;
            height: auto;
            object-fit: contain;
        }
        .carousel {
            position: relative;
            max-width: 100px;
            max-height: 100px;
            overflow: hidden;
        }
        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-item {
            flex: 0 0 auto;
            margin-right: 10px;
        }
        .carousel-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
            background: none;
            border: none;
            color: #333;
        }
        .carousel-button.prev {
            left: 0;
        }
        .carousel-button.next {
            right: 0;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Products</h1>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Product Age</th>
                <th>Price</th>
                <!-- <th>Description</th> -->
                <th>Images</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Contact Way</th>
                <th>Location</th>
                <th>Sell/Rent</th>
                <th>Action</th> <!-- For Remove Product Button -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultProducts)) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['product_age']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    
                    <td class="product-images">
                        <div class="custCarousel">
                            <div class="carousel-inner">
                                <?php
                                // Explode the image names to get individual images
                                $images = explode(',', $row['image_name']);
                                foreach ($images as $image) {
                                    echo "<div class='carousel-item'><img src='../uploads/$image' alt='Product Image'></div>";
                                }
                                ?>
                            </div>
                            <button class="carousel-button prev">&#10094;</button>
                            <button class="carousel-button next">&#10095;</button>
                        </div>
                    </td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['contact_way']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['sell_rent']; ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Are you sure you want to remove this product?');">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="remove_product" class="btn-danger" >Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <script>
        document.querySelectorAll('.custCarousel').forEach(carousel => {
            const carouselInner = carousel.querySelector('.carousel-inner');
            const prevButton = carousel.querySelector('.carousel-button.prev');
            const nextButton = carousel.querySelector('.carousel-button.next');

            let index = 0;
            const maxIndex = carouselInner.children.length - 1;
            const itemWidth = carouselInner.children[0].clientWidth + 10;

            prevButton.addEventListener('click', () => {
                index = Math.max(index - 1, 0);
                updatePosition();
            });

            nextButton.addEventListener('click', () => {
                index = Math.min(index + 1, maxIndex);
                updatePosition();
            });

            function updatePosition() {
                const offset = -index * itemWidth;
                carouselInner.style.transform = `translateX(${offset}px)`;
            }
        });
    </script>
</body>
</html>

<?php
// If user submits the form to remove a product
if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];

    // Prepare a delete statement
    $queryDeleteProduct = "DELETE FROM add_product WHERE id = ?";

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $queryDeleteProduct);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $product_id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check if deletion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo '<script>alert("Product deleted successfully!");</script>';
        // Redirect to refresh the page after deletion
        echo '<script>window.location.replace("products.php");</script>';
    } else {
        echo '<script>alert("Failed to delete product.");</script>';
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
