<?php
$activePage = 'rent';
include "includes/header.php";

?>


    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/r2.png" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">SwapSeeker</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">A Quick Marketplace</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/r1.png" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Affordable Luxury</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn"> through Our Renting Options</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/r3.png" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Rent Products</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Quality Rentals for Quality Experiences</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

<!-- Categories Start -->
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        <?php
        // Database connection
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'swapseeker';

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to select categories
        $categoryQuery = "SELECT * FROM tbl_category";
        $categoryResult = $conn->query($categoryQuery);

        if ($categoryResult->num_rows > 0) {
            while ($row = $categoryResult->fetch_assoc()) {
                $category_id = $row["cid"];
                $category_name = $row["category_name"];
                $category_image = $row["category_image"];
                $sub_category = $row["sub_category"];
                $purpose = $row["purpose"]; // Retrieve the "purpose" column from the database

                // Check if the purpose is 'shop' or 'both'
                if ($purpose === 'rent' || $purpose === 'both') {
                    // Replace spaces with underscores in the category name for URLs
                    $category_name_url = str_replace(' ', '_', $category_name);

                    // Create links to individual category pages
                    echo '
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <a class="text-decoration-none" href="view.php?category=' . $category_name_url . '">
                            <div class="cat-item d-flex align-items-center mb-4">
                                <div class="overflow-hidden" style="width: 100px; height: 100px;">
                                    <img class="img-fluid" src="' . $category_image . '" alt="' . $category_name . '">
                                </div>
                                <div class="flex-fill pl-3">
                                    <h6>' . $category_name . '</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    ';
                }
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>
<!-- Categories End -->


    
    <?php
// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'swapseeker';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch and display products
function displayProducts($conn, $sell_rent, $sectionTitle) {
    // Query to select the latest 8 products based on the 'sell_rent' value
    $sql = "SELECT * FROM add_product WHERE visibility='1' and sell_rent = '$sell_rent' ORDER BY id DESC LIMIT 8";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container-fluid pt-5">';
        echo "<h2 class='section-title position-relative text-uppercase mx-xl-5 mb-4'><span class='bg-secondary pr-3'>$sectionTitle</span></h2>";
        echo '<div class="row px-xl-5">';

        while ($row = $result->fetch_assoc()) {
            $product_id = $row["id"];
            $product_name = $row['product_name'];
            $price = $row['price'];
            $image_path = $row['image_name'];
            $images = explode(",", $image_path);
            $firstImageFromFrame = isset($images[0]) ? $images[0] : 'default_image.jpg';

            echo '<div class="col-lg-3 col-md-4 col-sm-6 pb-1">';
            $productPage = ($sell_rent === 'rent') ? 'rinfo.php' : 'info.php';
            echo "<a href=\"$productPage?id=$product_id\" class=\"text-decoration-none\">";
            echo '<div class="product-item bg-light mb-4">';
            echo '<div class="product-img position-relative overflow-hidden">';
            echo "<img class='product-image img-fluid w-100' src='uploads/$firstImageFromFrame' alt='Product Image'>";
            echo '<div class="product-action">';
            // echo '<a class="btn btn-outline-dark btn-square" href="cart.php"><i class="fa fa-shopping-cart"></i></a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="text-center py-4">';
            echo "<a class='h6 text-decoration-none text-truncate' href=\"$productPage?id=$product_id\">$product_name</a>";
            echo '<div class="d-flex align-items-center justify-content-center mt-2">';
            echo "<h5>₹$price</h5>"; // Add the currency symbol here
            echo '</div>';
            // Add any additional product details or rating here
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
    } else {
        // Display the image when no rental products are found
        echo '<div class="container-fluid pt-5">';
        echo "<h2 class='section-title position-relative text-uppercase mx-xl-5 mb-4'><span class='bg-secondary pr-3'>$sectionTitle</span></h2>";
        echo '<div class="row px-xl-5 justify-content-center">';
        echo '<div class="col-lg-6 text-center">';
        echo '<img src="img/norent.jpg" alt="No rental products" class="img-fluid">';
        echo '<p class="mt-3">Sorry, No Rental Items Found</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

?>

<!-- Display FEATURED PRODUCTS -->

<!-- Display RENTAL PRODUCTS -->
<?php displayProducts($conn, 'rent', 'RENTAL PRODUCTS'); ?>
    </div>
</div>
<!-- Products End -->


  
<!-- <a href="" class="btn px-0 ml-3">
<i class="fas fa-shopping-cart text-primary"></i>
<span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
</a> -->

<?php
include "includes/footer.php";
?>


















