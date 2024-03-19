<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">
     
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <title>Admin Dashboard Panel</title> 
</head>
<body>
    <nav>
    <div class="empty-header" style="height: 50px; display: flex; justify-content: center; align-items: center;">
        <img id="image" src="Images/logo.png" style="height: 80px; width: 250px;">
    </div>

    <div class="menu-items">
    <ul class="nav-links">
        <li><a href="admin.php">
            <i class="uil uil-estate"></i>
            <span class="link-name">Dashboard</span>
        </a></li>
        <li><a href="users.php">
            <i class="uil uil-users-alt"></i>
            <span class="link-name">Users</span>
        </a></li>
        <li><a href="products.php">
            <i class="uil uil-chart"></i>
            <span class="link-name">Products</span>
        </a></li>
        <li><a href="reports.php">
             <i class="uil uil-megaphone"></i>
            <span class="link-name">Reports</span>
        </a></li>
    </ul>

    <!-- Logout Link -->
    <ul class="logout-mode">
        <li>
            <a href="../logout.php">
                <i class="uil uil-signout"></i>
                <span class="link-name">Logout</span>
            </a>
        </li>
        <li class="mode">
            <a href="#">
                <i class="uil uil-moon"></i>
                <span class="link-name">Dark Mode</span>
            </a>
            <div class="mode-toggle">
                <span class="switch"></span>
            </div>
        </li>
    </ul>
</div>
    </nav>

    <section class="dashboard" id="dashboardContent">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>

        <div class="search-box">
            <i class="uil uil-search"></i>
            <input type="text" placeholder="Search here...">
        </div>
        
        <img src="images/" alt="">
    </div>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Dashboard</span>
            </div>

            <div class="boxes">
                <?php
                // Include the database connection file
                include_once "db_connection.php";

                // Query to get total users
                $queryUsers = "SELECT COUNT(*) AS totalUsers FROM signup";
                $resultUsers = mysqli_query($conn, $queryUsers);
                $rowUsers = mysqli_fetch_assoc($resultUsers);

                // Query to get total products
                $queryProducts = "SELECT COUNT(*) AS totalProducts FROM add_product";
                $resultProducts = mysqli_query($conn, $queryProducts);
                $rowProducts = mysqli_fetch_assoc($resultProducts);

                // Query to get total user details
                $queryUserDetails = "SELECT COUNT(*) AS totalUserDetails FROM userdetails";
                $resultUserDetails = mysqli_query($conn, $queryUserDetails);
                $rowUserDetails = mysqli_fetch_assoc($resultUserDetails);
                ?>
                <div class="box box1">
                    <i class="uil uil-users-alt"></i>
                    <span class="text">Users</span>
                    <span class="number"><?php echo $rowUsers['totalUsers']; ?></span>
                </div>
                <div class="box box2">
                    <i class="uil uil-box"></i>
                    <span class="text">Products</span>
                    <span class="number"><?php echo $rowProducts['totalProducts']; ?></span>
                </div>
                <div class="box box3">
                    <i class="uil uil-at"></i>
                    <span class="text">User Details</span>
                    <span class="number"><?php echo $rowUserDetails['totalUserDetails']; ?></span>
                </div>
            </div>
        </div>

        
    </div>
</section>


    <script src="script.js"></script>
    
</body>
</html>
