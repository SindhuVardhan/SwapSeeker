<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <?php
    include "includes/header.php";
    if (!isset($_SESSION['uid'])) {
        $_SESSION['uid'] = null; // Set whatever default value you need
    }
    
    $product_id = isset($_GET["id"]) ? $_GET["id"] : null;
$GetProductDetails = "SELECT * FROM add_product WHERE id = '$product_id'";
$ProductImages = array();
$Result = mysqli_query($conn, $GetProductDetails);

if (mysqli_num_rows($Result) > 0) {
    while ($records = mysqli_fetch_assoc($Result)) {
        $ProductName = $records["product_name"];
        $ProductImageLink = $records["image_name"];
        $ProductImages = explode(",", $ProductImageLink);
        $price = $records["price"];
        $description = $records["description"];
        $name = $records["name"];
        $email = $records["email"];
        $phone = $records["phone"];
        $contact_way = $records["contact_way"];
        $location = $records["location"];
        $age = $records["product_age"];
    }
}

// Handle Report Submission
if (isset($_POST['report_submit'])) {
    if (isset($_SESSION['uid']) && $_SESSION['uid']) {
        $user_id = $_SESSION['uid'];

        // Check if the user has already reported this product
        $checkReportedQuery = "SELECT COUNT(*) AS total FROM product_reports WHERE product_id = '$product_id' AND user_id = '$user_id'";
        $reportResult = mysqli_query($conn, $checkReportedQuery);
        $reportedRow = mysqli_fetch_assoc($reportResult);
        $alreadyReported = $reportedRow['total'] > 0;

        if (!$alreadyReported) {
            // Insert a new report record
            $reason = mysqli_real_escape_string($conn, $_POST['report_reason']);
            $insertReportQuery = "INSERT INTO product_reports (product_id, user_id, reason) VALUES ('$product_id', '$user_id', '$reason')";
            mysqli_query($conn, $insertReportQuery);

            // Increment the report count in add_product table
            $updateReportCountQuery = "UPDATE add_product SET report_count = report_count + 1 WHERE id = '$product_id'";
            mysqli_query($conn, $updateReportCountQuery);

            // Redirect back to the product page or wherever needed
            header("Location: product.php?id=$product_id");
            exit();
        } else {
            // User has already reported this product
            // Handle this case as needed (display message, redirect, etc.)
            echo "You have already reported this product.";
        }
    } else {
        // User is not logged in
        // Handle this case as needed (display message, redirect to login page, etc.)
        echo "Please log in to report this product.";
    }
}
?>



<style>
        body {
            background-color: #ffffff;
        }

        .product-page {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #ffffff;
        }

        .image-container {
            max-width: 60%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 500px;
            height: 550px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-left: 30px;
            margin-top: 30px;
            border-radius: 20px;
        }

        .scrolling-container {
            display: flex;
            overflow-x: scroll;
        }

        .scrolling-container img {
            max-width: 100%;
            height: auto;
            margin-right: 5px;
        }

        .product-details-container {
            width: 700px;
            height: auto;
            padding: 20px;
            margin-right: 30px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        .padding-box {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #buy-button, #chat-button, #call-button {
            background-color: #45b6fedb;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 0px;
        }

        .buy-button-container {
            text-align: right;
        }

        #buy-button:hover, #chat-button:hover, #call-button:hover {
            background-color: #45b6fedb;
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
        }

        #custCarousel .carousel-indicators {
            position: static;
            margin-top:20px;
        }

        #custCarousel .carousel-indicators > li {
            width: 100px;
        }

        #custCarousel .carousel-indicators li img {
            display: block;
            opacity: 0.5;
        }

        #custCarousel .carousel-indicators li.active img {
            opacity: 1;
        }

        #custCarousel .carousel-indicators li:hover img {
            opacity: 0.75;
        }

        .carousel-item img {
            width: 80%;
        }

        #add-to-cart-button {
            background-color: #45b6fedb;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 0px;
        }

        #add-to-cart-button:hover {
            background-color: #009900;
        }

        #buy-button {
            background-color: #45b6fedb;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 0px;
        }

        #buy-button:hover {
            background-color: #0056b3;
        }

        .button-container {
            text-align: right;
        }

        .product-details-container h1 {
            font-size: 24px;
        }

        .product-details-container h2 {
            font-size: 18px;
        }

        /* Modal styles */
        #inquiryModal {
            display: none;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-dialog {
            margin-top: 10%;
        }
    </style>
    
</head>
<body>

<div class="product-page">
    <div class="image-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                        <div class="carousel-inner">
                            <?php
                            $DisplayIndex = 0;
                            foreach ($ProductImages as $Images) {
                                if ($DisplayIndex == 0) {
                                    echo "<div class='carousel-item active'><img src='uploads/$Images'></div>";
                                } else {
                                    echo "<div class='carousel-item'><img src='uploads/$Images'></div>";
                                }
                                ++$DisplayIndex;
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#custCarousel" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#custCarousel" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                        <ol class="carousel-indicators list-inline">
                            <?php
                            $ThumbIndex = 0;
                            foreach ($ProductImages as $Images) {
                                if ($ThumbIndex == 0) {
                                    echo "<li class='list-inline-item active'>
                                            <a id='carousel-selector-$ThumbIndex' class='selected' data-slide-to='$ThumbIndex' data-target='#custCarousel'>
                                            <img src='uploads/$Images' class='img-fluid'>
                                            </a></li>";
                                } else {
                                    echo "<li class='list-inline-item'>
                                            <a id='carousel-selector-$ThumbIndex' data-slide-to='$ThumbIndex' data-target='#custCarousel'>
                                            <img src='uploads/$Images' class='img-fluid'>
                                            </a></li>";
                                }
                                ++$ThumbIndex;
                            }
                            ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-details-container">
        <div class="padding-box">
            <h1><?php echo $ProductName; ?></h1>
            <p>Price: ₹<?php echo $price; ?>/-</p>
            <p>Location: <?php echo $location; ?></p>
            <div class="button-container">
                <?php
                $productInCart = false;
                $checkProductInCartQuery = "SELECT COUNT(*) FROM cart WHERE productid = '$product_id' AND userid = '{$_SESSION['uid']}'";
                $result = mysqli_query($conn, $checkProductInCartQuery);

                if ($result) {
                    $row = mysqli_fetch_array($result);
                    $productInCart = $row[0] > 0;
                }

                if ($productInCart) {
                    echo '<p class="text-success">Product is in Cart</p>';
                    echo '<a href="cart.php" class="btn btn-primary">Go to Cart</a>';
                } else {
                    echo '<a href="cart.php?action=add&product_id=' . $product_id . '&product_name=' . urlencode($ProductName) . '&product_price=' . $price . '" class="add-to-cart" data-id="1">
                            <button id="add-to-cart-button">Add to Cart</button>
                        </a>';
                }
                ?>
            </div>
        </div>
        <div class="padding-box">
            <h2>Description</h2>
            <p><?php echo $description; ?></p>
        </div>
        <div class="padding-box">
            <h2>Contact Details</h2>
            <?php
            if (isset($_SESSION['uid']) && $_SESSION['uid']) {
                // User is logged in, show contact details
                ?>
                <p><b>Owner:</b> <?php echo $name; ?></p>
                <p><b>Email:</b> <?php echo $email; ?></p>
                <p><b>Phone:</b> <?php echo $phone; ?></p>
                <p><b>Preferable contact way:</b> <?php echo $contact_way; ?></p>
                <?php
            } else {
                // User is not logged in, show message and login button
                ?>
                <p><b>Please login to view contact details.</b></p>
                <a href="login.php" class="btn btn-primary">Login</a>
                <?php
            }
            ?>
            
            <!-- WhatsApp Chat Button -->
            <a href="https://api.whatsapp.com/send?phone=<?php echo $phone; ?>" target="_blank" class="whatsapp-icon-link">
                
                <img src="img/whatsapp-icon.png" alt="WhatsApp Chat" class="whatsapp-icon" style="width: 40px; height: 40px;">
                <span >Chat with WhatsApp</span>
            </a>
        </div>

        <div class="padding-box">
    <h2>Report This Product</h2><br>
    <?php
    if (isset($_SESSION['uid']) && $_SESSION['uid']) {
        // User is logged in, show report button
        ?>
        <button class="btn btn-danger open-report-modal">Report</button>
        <?php
    } else {
        // User is not logged in, show message to login
        ?>
        <p><b>Please login to report this product.</b></p>
        <a href="login.php" class="btn btn-primary">Login</a>
        <?php
    }
    ?>
</div>

<!-- Report Modal -->
<div class="modal" id="reportModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Report Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="reportForm">
                    <div class="form-group">
                        <label for="reason">Reason for Report:</label>
                        <textarea class="form-control" id="reason" name="reason" rows="4" required></textarea>
                        <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Report</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".open-report-modal").click(function () {
            $("#reportModal").modal("show");
        });

        $("#reportForm").submit(function (e) {
            e.preventDefault();
            var reason = $("#reason").val();
            var product_id = $("#product_id").val();

            // AJAX to send data to PHP script
            $.ajax({
                url: "report_product.php",
                type: "POST",
                data: {
                    reason: reason,
                    product_id: product_id
                },
                success: function (response) {
                    $("#reportModal").modal("hide");
                    // You can display a success message or handle response as needed
                    alert("Product reported successfully!");
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>
</html>
