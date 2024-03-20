<?php
include "includes/header.php";

// Establish a MySQLi database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swapseeker";

$Style = 'style="border:none;outline:none;text-align:center"';
$Style2 = 'style="border:none;outline:none;display:block;"';
$Style3 = 'style="margin-bottom:10px;display:block;"';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in and get the user ID
$userID = isset($_SESSION["uid"]) ? $_SESSION["uid"] : null;

// Check if user ID is available
if (!$userID) {
    echo "User ID not found. Please log in.";
    exit;
}

// Retrieve address details based on the user ID
$query = "SELECT * FROM userdetails WHERE userid = $userID";
$result = $conn->query($query);

$addressDetails = array(); // Initialize an array to store address details

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $addressDetails[] = $row; // Store each address detail in the array
    }
} else {
    echo "No addresses found.";
    exit;
}


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $addressone = $_POST["addressone"];
    $addresstwo = $_POST["addresstwo"];
    // $country = $_POST["country"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $addressID = $_POST["address_id"];

    // Update address details in the database
    $updateQuery = "UPDATE userdetails SET name='$name', email='$email', mobile='$mobile', addressone='$addressone', addresstwo='$addresstwo', city='$city', state='$state' WHERE userid=$userID AND id=$addressID";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Address details updated successfully.";
    } else {
        echo "Error updating address details: " . $conn->error;
    }
}


?>

<!-- Edit Address Form within Table -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Saved Address</span></h5>
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile.no</th>
                    <th>Address</th>
                    <th>State</th>
                    <th>Actions</th> <!-- Add a new column for actions -->
                </thead>
                <tbody class="align-middle">
                    <?php foreach ($addressDetails as $address): ?>
                    <tr>
                        <form method="post">
                            <input type="hidden" name="address_id" value="<?php echo $address['id']; ?>">
                            <td><input type="text" name="name" <?php echo isset($_POST['edit'.$address['id']]) ? '' : $Style; ?> value="<?php echo $address['name']; ?>" <?php echo isset($_POST['edit'.$address['id']]) ? '' : 'readonly'; ?>></td>
                            <td><input type="email" name="email" <?php echo isset($_POST['edit'.$address['id']]) ? '' : $Style; ?> value="<?php echo $address['email']; ?>" <?php echo isset($_POST['edit'.$address['id']]) ? '' : 'readonly'; ?>></td>
                            <td><input type="text" name="mobile" <?php echo isset($_POST['edit'.$address['id']]) ? '' : $Style; ?> value="<?php echo $address['mobile']; ?>" <?php echo isset($_POST['edit'.$address['id']]) ? '' : 'readonly'; ?>></td>
                            <td>
                                <input type="text" name="addressone" <?php echo isset($_POST['edit'.$address['id']]) ? $Style3 : $Style2; ?> value="<?php echo $address['addressone']; ?>" <?php echo isset($_POST['edit'.$address['id']]) ? '' : 'readonly'; ?>>
                                <input type="text" name="addresstwo" <?php echo isset($_POST['edit'.$address['id']]) ? $Style3 : $Style2; ?> value="<?php echo $address['addresstwo']; ?>" <?php echo isset($_POST['edit'.$address['id']]) ? '' : 'readonly'; ?>>
                                <input type="text" name="city" <?php echo isset($_POST['edit'.$address['id']]) ? $Style3 : $Style2; ?> value="<?php echo $address['city']; ?>" <?php echo isset($_POST['edit'.$address['id']]) ? '' : 'readonly'; ?>>
                            </td>
                            <td><input type="text" name="state" <?php echo isset($_POST['edit'.$address['id']]) ? '' : $Style; ?> value="<?php echo $address['state']; ?>" <?php echo isset($_POST['edit'.$address['id']]) ? '' : 'readonly'; ?>></td>
                            <td>
                                <?php if(isset($_POST['edit'.$address['id']])): ?>
                                    
                                    <input type="submit" name="edit<?php echo $address['id']; ?>" value="Save" class="btn btn-primary">
                                <?php else: ?>
                                    <input type="submit" name="edit<?php echo $address['id']; ?>" value="Edit" class="btn btn-primary">
                                <?php endif; ?>
                            </td>
                        </form>
                    </tr>
                 
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$conn->close();

?>
