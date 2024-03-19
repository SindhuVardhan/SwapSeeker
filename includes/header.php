<?php
include "includes/config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SwapSeeker</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- <link href="path/to/your/fontawesome/css/all.min.css" rel="stylesheet"> -->


    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Add this to your existing CSS or in a new style block */
        #myAccountDropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        #myAccountDropdown a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
        }

        #myAccountDropdown a:hover {
            background-color: #f0f0f0;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#myAccountBtn").on("click", function () {
                $("#myAccountDropdown").slideToggle("fast");
            });

            // Hide the dropdown when clicking outside of it
            $(document).on("click", function (event) {
                if (!$(event.target).closest("#myAccountBtn").length && !$(event.target).closest("#myAccountDropdown").length) {
                    $("#myAccountDropdown").slideUp("fast");
                }
            });
        });
    </script>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="" id="searchForm">
                    <div class="input-group">
                        
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
             
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-30">
        <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
        <a href="" class="text-decoration-none d-flex align-items-center">
            <!-- <span class="h1 text-uppercase text-primary px-2">SWAP</span>
            <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">SEEKER</span> -->
            <img id="image" src="img/logoss.png" style="height: 65px;width: 240px;margin: 0px auto;">

        </a>

                <!-- <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        
                    </div>
                </nav>  -->
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <!-- <span class="h1 text-uppercase text-dark bg-light px-2">SWAP</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">SEEKER</span> -->
                        <img id="image" src="img/logoss.png" style="height: 100px; width: 350px;">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse" style="margin: 0px 15px;">
                    <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link <?php echo ($activePage == 'home') ? 'active' : ''; ?>">Home</a>
                            <a href="shop.php" class="nav-item nav-link <?php echo ($activePage == 'shop') ? 'active' : ''; ?>">Shop</a>
                            <a href="rent.php" class="nav-item nav-link <?php echo ($activePage == 'rent') ? 'active' : ''; ?>">Rent</a>
                            <a href="add.php" class="nav-item nav-link <?php echo ($activePage == 'add') ? 'active' : ''; ?>">ADD</a>
                        </div>

                        
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <!-- <a href=search.php><i class="fa fa-search text-primary"></i></a> -->
                            <?php
                            // Check if the user is logged in (based on the session variable)
                            
                                // Check if the logged-in user is an admin
                                if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] == true) {
                                    // ... show admin-specific content ...
                                    echo '<div class="btn-group">
                                            <button type="button" class="btn px-0 ml-3 dropdown-toggle active" data-toggle="dropdown">
                                                Welcome! admin
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Admin-specific dropdown items -->
                                                <a class="dropdown-item" href="admin/admin.php"><i class="fa fa-cog" aria-hidden="true"></i> Admin Dashboard</a>
                                                <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                                            </div>
                                        </div>';
                                } elseif (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true) {
                                    // ... show regular user content ...
                                    echo '<a class="btn px-0 ml-3" href="cart.php"><i class="fas fa-shopping-cart text-primary"></i></a>'; // Cart icon here
                                    echo '<div class="btn-group">
                                            <button type="button" class="btn px-0 ml-3 dropdown-toggle active" data-toggle="dropdown">
                                                My Account
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="profile2.php"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                                                <a class="dropdown-item" href="my_products.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> My Products</a>
                                                <a class="dropdown-item" href="save_address.php"><i class="fa fa-address-book" aria-hidden="true"></i> Saved Address</a>
                                                <a class="dropdown-item" href="logout.php"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Logout</a>
                                            </div>
                                        </div>';
                                } else {
                                    // ... show content for users who are not logged in ...
                                    echo '<a class="btn px-0 ml-3" href="cart.php"><i class="fas fa-shopping-cart text-primary"></i></a>'; // Cart icon here
                                    echo '<div class="btn-group">
                                            <button type="button" class="btn px-0 ml-3 dropdown-toggle" data-toggle="dropdown">
                                                Login/Signup
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</a>';
                                                // Add more dropdown items as needed
                                                echo '<a class="dropdown-item" href="login.php">Signup</a>
                                            </div>
                                        </div>';
                                }
                            ?>
                        </div>






                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->






