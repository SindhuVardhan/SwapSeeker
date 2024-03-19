

<?php
// $activePage = 'shop';
include "includes/header.php";

// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'swapseeker';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Number of products per page
$productsPerPage = 20;

// Get the current page number
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the query
$offset = ($current_page - 1) * $productsPerPage;

// Query to select products for the current page
$sql = "SELECT * FROM add_product  LIMIT $productsPerPage OFFSET $offset";
$result = $conn->query($sql);

// Query to count the total number of products
$totalProductsQuery = "SELECT COUNT(*) as total FROM add_product ";
$totalProductsResult = $conn->query($totalProductsQuery);
$totalProducts = $totalProductsResult->fetch_assoc()['total'];

// Calculate the total number of pages
$totalPages = ceil($totalProducts / $productsPerPage);

?>
<!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            


<!-- Shop Product Start -->
<div class="col-lg-9 col-md-8">
    <div class="row pb-3">
        <div class="col-12 pb-1">
            <!-- Your sorting buttons and dropdowns can remain static here -->
        </div>

        <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $product_id = $row["id"];
                        $product_name = $row['product_name'];
                        $price = $row['price'];
                        $image_path = $row['image_name'];
                        $images = explode(",", $row['image_name']);
                        $sell_rent = $row['sell_rent']; // New column

                        // Extract the first image from the frames
                        $firstImageFromFrame1 = isset($images[0]) ? $images[0] : 'default_image.jpg';
                ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <a href="<?php echo ($sell_rent == 'sell') ? 'info.php' : 'rinfo.php'; ?>?id=<?php echo $product_id; ?>" class="text-decoration-none">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="product-image img-fluid w-100" src="uploads/<?php echo $firstImageFromFrame1; ?>" alt="Product Image">
                                        <div class="product-action">
                                            <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a> -->
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="info.php?id=<?php echo $product_id; ?>"><?php echo $product_name; ?></a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>&#8377;<?php echo $price; ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                } else {
                    // Display a placeholder image when no products are found
                ?>
            <div class="col-12 text-center">
                <img src="img/not.png" alt="No Products Found" class="img-fluid">
                
            </div>
        <?php
        }
        ?>

        <div class="col-12">
            <nav>
                <ul class="pagination justify-content-center">
                    <?php
                    // Previous Page
                    $prevPage = $current_page - 1;
                    echo '<li class="page-item ' . ($current_page == 1 ? 'disabled' : '') . '"><a class="page-link" href="?page=' . $prevPage . '">Previous</a></li>';

                    // Numbered Pages
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item ' . ($current_page == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }

                    // Next Page
                    $nextPage = $current_page + 1;
                    echo '<li class="page-item ' . ($current_page == $totalPages ? 'disabled' : '') . '"><a class="page-link" href="?page=' . $nextPage . '">Next</a></li>';
                    ?>
                </ul>
            </nav>
        </div>

    </div>
</div>
<!-- Shop Product End -->


<?php
// Close the database connection
$conn->close();
?>

<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>

<?php

include "includes/footer.php";
?>