<?php
include "includes/header.php";

?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Admin Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Admin Options Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"></h5>
            <div class="p-4 mb-30" style="background-color: #45b6fead; height: 500px;">
                
                
                <!-- Admin Options -->
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3" style="color: #fff;">
                    <a href="#usersSubmenu" id="usersContent" data-toggle="collapse" aria-expanded="false" onclick="showContent('users')" style="text-decoration: none;">Users</a>
                </div>
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <a href="#ordersSubmenu" data-toggle="collapse" aria-expanded="false" onclick="showContent('orders')" style="text-decoration: none;">Orders</a>
                </div>
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <a href="#productsSubmenu" data-toggle="collapse" aria-expanded="false" onclick="showContent('products')" style="text-decoration: none;">Products</a>
                </div>
            </div>
            <!-- Admin Options End -->
        </div>
        <!-- Admin Sidebar End -->

        <!-- Admin Main Content Start -->
        <div class="col-lg-9 col-md-8">
            <!-- Your main content goes here -->

           
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // JavaScript function to show content based on the selected submenu
    function showContent(contentType) {
        // Hide all content sections
        $('#usersContent, #ordersContent, #productsContent').hide();

        // Show the selected content
        $('#' + contentType + 'Content').show();
    }

    // JavaScript function to remove a user
    function removeUser(userId) {
        // Implement the logic to remove the user from the database
        alert('Remove user with ID ' + userId);
    }

    // JavaScript function to remove a product
    function removeProduct(productId) {
        // Implement the logic to remove the product from the database
        alert('Remove product with ID ' + productId);
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/pmain.js"></script>
<script src="js/script.js"></script>
</body>

</html>
