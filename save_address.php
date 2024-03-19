<?php
include "includes/header.php";

// Establish a MySQLi database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swapseeker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userID = isset($_SESSION["uid"]) ? $_SESSION["uid"] : null;

$editMode = false;

// Retrieve only visible user products from the database
if ($userID) {
    $query = "SELECT * FROM userdetails WHERE userid = $userID";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $userDetails = $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

<!-- Main Product Display Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Saved Address</span></h5>
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile.no</th>
                    <th>Street-1</th>
                    <th>Street-2</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Actions</th> <!-- Add a new column for actions -->
                </thead>
                <tbody class="align-middle">
                    <?php
                    if (isset($userDetails) && is_array($userDetails)) {
                        foreach ($userDetails as $details) {
                            echo "<tr>";
                            echo "<td class='align-middle'>{$details['name']}</td>";
                            echo "<td class='align-middle'>{$details['email']}</td>";
                            echo "<td class='align-middle'>{$details['mobile']}</td>";
                            echo "<td class='align-middle'>{$details['addressone']}</td>";
                            echo "<td class='align-middle'>{$details['addresstwo']}</td>";
                            echo "<td class='align-middle'>{$details['country']}</td>";
                            echo "<td class='align-middle'>{$details['city']}</td>";
                            echo "<td class='align-middle'>{$details['state']}</td>";
                            echo "<td class='align-middle'>";
                            echo "<a href='edit_address.php?id={$details['id']}' class='btn btn-primary btn-sm mr-2'>Edit</a>"; // Edit button
                            echo "<a href='delete_address.php?id={$details['id']}' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>"; // Delete icon
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No visible Saved Address found for the user.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Main Product Display End -->

