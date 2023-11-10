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

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <!-- <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="contact.html">Contact</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">Sign in</button>
                            <button class="dropdown-item" type="button">Sign up</button>
                        </div>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div> -->
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary px-2">SWAP</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">SEEKER</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Laptops & PC's <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="" class="dropdown-item">Laptops</a>
                                <a href="" class="dropdown-item">Computers</a>
                                <a href="" class="dropdown-item">Accessories</a>
                            </div>
                        </div>
                        <a href="" class="nav-item nav-link">Old is Gold</a>
                        <a href="" class="nav-item nav-link">SmartPhones</a>
                        <a href="" class="nav-item nav-link">Property</a>
                        <a href="" class="nav-item nav-link">Auto Mobiles</a>
                        <a href="" class="nav-item nav-link">Home Appliances</a>
                        <a href="" class="nav-item nav-link">Gaming</a>
                        <a href="" class="nav-item nav-link">Cosmetics</a>
                        <a href="" class="nav-item nav-link">Cameras</a>
                        <a href="" class="nav-item nav-link">Toys</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">SWAP</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">SEEKER</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse" style="margin: 0px 15px;">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <a href="rent.php" class="nav-item nav-link">Rent</a>
                            <a href="add.php" class="nav-item nav-link"> ADD</a>

                            
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                                <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                                    <?php
                                    // Check if the user is logged in (based on the session variable)
                                    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true) {
                                        echo '<a class="btn px-0 ml-3" href="cart.php"><i class="fas fa-shopping-cart text-primary"></i></a>';
                                        echo '<div class="btn-group">
                                                <button type="button" class="btn px-0 ml-3 dropdown-toggle active" data-toggle="dropdown">
                                                    My Account
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="profile.php"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>';
                                                    // Add more dropdown items as needed
                                                    echo '<a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                                                </div>
                                            </div>';
                                    } else {
                                        echo '<a class="btn px-0 ml-3" href="shopping-cart.php"><i class="fas fa-shopping-cart text-primary"></i></a>';
                                        echo '<div class="btn-group">
                                                <button type="button" class="btn px-0 ml-3 dropdown-toggle" data-toggle="dropdown">
                                                    Login/Signup
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="login.php">Login</a>';
                                                    // Add more dropdown items as needed
                                                    echo '<a class="dropdown-item" href="signup.php">Signup</a>
                                                </div>
                                            </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>





                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->