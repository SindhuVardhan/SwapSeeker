

<?php
$activePage = 'shop';
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
$sql = "SELECT * FROM add_product WHERE category='Smart Phones' LIMIT $productsPerPage OFFSET $offset";
$result = $conn->query($sql);

// Query to count the total number of products
$totalProductsQuery = "SELECT COUNT(*) as total FROM add_product WHERE category='Smart Phones'";
$totalProductsResult = $conn->query($totalProductsQuery);
$totalProducts = $totalProductsResult->fetch_assoc()['total'];

// Calculate the total number of pages
$totalPages = ceil($totalProducts / $productsPerPage);

?>
<!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Sort By</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">Latest</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">Hight-Low</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">Low-High</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">Relevence</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        
                    </form>
                </div>
                <!-- Price End -->
                
                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">All Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">Mobiles</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">Smart Phones</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">Accessories</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">Tablets</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Brands</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">Apple</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">Samsung</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">One Plus</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">Oppo</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">Realme</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


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

                // Extract the first image from the frames
                $firstImageFromFrame1 = isset($images[0]) ? $images[0] : 'default_image.jpg';
        ?>
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                    <a href="info.php?id=<?php echo $product_id; ?>" class="text-decoration-none">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden ">
                                <!-- Use the first image from frame 1 here -->
                                <img class="product-image img-fluid w-100" src="uploads/<?php echo $firstImageFromFrame1; ?>" alt="Product Image">
                                <div class="product-action ">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="info.php?id=<?php echo $product_id; ?>"><?php echo $product_name; ?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5><?php echo $price; ?></h5>
                                    <!-- You can add the discount price here if available -->
                                </div>
                                <!-- Your star rating or any additional product details can go here -->
                            </div>
                        </div>
                    </a>
                </div>
        <?php
            }
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

