
<?php
include "includes/header.php";

$id = $_SESSION['uid'];

$userId = $_SESSION['uid'];


$totalprice = 0; // Initialize $totalprice as an integer

$GetProductDetails = "SELECT cart.id, productid, add_product.product_name, add_product.image_name, add_product.price  
                     FROM cart 
                     LEFT JOIN add_product ON cart.productid = add_product.id 
                     WHERE userid='{$_SESSION['uid']}'";

$ProductImages = array();
$Result = mysqli_query($conn, $GetProductDetails);
?>
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<?php
$id = $_SESSION['uid'];

$name = '';
$email = '';
$mobile = '';
$addressone = '';
$addresstwo = '';
$country = '';
$city = '';
$state = '';

$res = mysqli_query($conn, "SELECT * FROM userdetails WHERE userid='{$_SESSION['uid']}'");
if ($row = mysqli_fetch_array($res)) {
    $name = $row['name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $addressone = $row['addressone'];
    $addresstwo = $row['addresstwo'];
    $country = $row['country'];
    $city = $row['city'];
    $state = $row['state'];
}
?>
      
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
            <div class="bg-light p-30 mb-5">
                <form action="billing.php" method="post">
                <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input name="name" class="form-control" type="text"  required 
                            value="<?php echo $name;?>">
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input name="email" value="<?php echo $email;?>" class="form-control" type="text" ="example@email.com" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input name="mobile" class="form-control" type="text" value="<?php echo $mobile;?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input name="addressone" class="form-control" type="text" value="<?php echo $addressone;?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input  name="addresstwo" class="form-control" type="text" value="<?php echo $addresstwo;?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <input  name="country" class="form-control" type="text" value="<?php echo $country;?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input name="city" class="form-control" type="text" value="<?php echo $city;?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input name="state" class="form-control" type="text" value="<?php echo $state;?>" required>
                        </div>
                        
                        <div class="col-md-12 form-group">
                                <input type="submit" name="save address" id="save address" 
                                class="btn btn-block btn-primary font-weight-bold py-3" style="width: 48%;"value="Save Address"/>
                                
                        </div>
                        
                    </div>
                </form>
            </div>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Saved Address</span></h5>
           
                <?php
                // Replace with your database credentials
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "swapseeker";

                // Create a database connection
                $conn = mysqli_connect($host, $username, $password, $database);

                // Check the connection
                if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch the user's ID from the session
                $userId = $_SESSION['uid'];

                // SQL query to retrieve data from the "userdetails" table for a specific user
                $sql = "SELECT id, name, email, mobile, addressone, addresstwo, country, city, state FROM userdetails WHERE userid='$userId'";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                echo '<div class="bg-light p-30 mb-5">';
                echo '<form action="billing.php" method="post">';

                $addressIndex = 1; // Index for radio buttons

                while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="accordion" id="addressAccordion">
                    <div class="card">
                        <div class="card-header" id="addressHeading' . $addressIndex . '">
                            <h2 class="mb-0">
                                <input type="radio" id="addressRadio' . $addressIndex . '" name="selectedAddress" value="' . $row["id"] . '">
                                <label for="addressRadio' . $addressIndex . '">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#addressCollapse' . $addressIndex . '" aria-expanded="true" aria-controls="addressCollapse' . $addressIndex . '">
                                        Saved Address ' . $addressIndex . '
                                    </button>
                                </label>
                            </h2>
                        </div>
                        <div id="addressCollapse' . $addressIndex . '" class="collapse" aria-labelledby="addressHeading' . $addressIndex . '" data-parent="#addressAccordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label><strong>Name:</strong></label>
                                        ' . $row["name"] . '
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><strong>E-mail:</strong></label>
                                        ' . $row["email"] . '
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><strong>Mobile No:</strong></label>
                                        ' . $row["mobile"] . '
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><strong>Address Line 1:</strong></label>
                                        ' . $row["addressone"] . '
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><strong>Address Line 2:</strong></label>
                                        ' . $row["addresstwo"] . '
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><strong>Country:</strong></label>
                                        ' . $row["country"] . '
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><strong>City:</strong></label>
                                        ' . $row["city"] . '
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><strong>State:</strong></label>
                                        ' . $row["state"] . '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                $addressIndex++;
                }

                echo '</div></form>';
                } else {
                echo "No saved addresses found.";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>

        </div>
        

        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>

                    <?php
                    if (mysqli_num_rows($Result) > 0) {
                        while ($rows = mysqli_fetch_assoc($Result)) {
                            $rprice = $rows['price'];
                            $totalprice += (int)str_replace(",", "", $rprice);
                    ?>
                            <div class="d-flex justify-content-between">
                                <p><?php echo $rows['product_name']; ?></p>
                                <p><?php echo number_format(str_replace(",", "", $rows['price'])); ?></p>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5><?php echo $totalprice; ?></h5>
                    </div>
                </div>
            </div>

            <div class="mb-5">
            <button 
                    class="btn btn-block btn-primary font-weight-bold py-3 buynow" 
                    data-price="<?php echo $totalprice; ?>" 
                    data-product-id="<?php echo $productId; ?>" 
                    data-user-id="<?php echo $_SESSION['uid']; ?>" >
                    Place Order
                </button>
            
            <input type="hidden" id="userId" value="<?php echo $_SESSION['uid']; ?>">
            </div>
        </div>
    </div>
</div>

<!-- Checkout End -->

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
    $('body').on('click', '.buynow', function(e) {
        var totalAmount = $(this).data("price"); // Read the dynamic price from the button
        var productId = $(this).data("product-id"); // Read the product ID from the button
        var userId = $(this).data("user-id"); // Read the user ID from the button

        var options = {
            "key": "rzp_test_PBuhh7QvWrBpOp",
            "amount": <?php echo $totalprice * 100; ?>, // Convert to the smallest currency unit and pass as integer
            "name": "SwapSeeker",
            "description": "Payment",
            "handler": function(response) {
                $.ajax({
                    url: 'store_payment.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        razorpay_payment_id: response.razorpay_payment_id,
                        totalAmount: totalAmount,
                        product_id: productId, // Pass the product ID to store_payment.php
                        user_id: userId // Pass the user ID to store_payment.php
                    },
                    success: function(msg) {
                        window.location.href = 'index.php';
                    }
                });
            },
            "theme": {
                "color": "#528FF0"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
        e.preventDefault();
    });
});
</script>
</body>

</html>
