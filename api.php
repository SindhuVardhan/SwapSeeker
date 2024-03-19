<?php
header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "swapseeker";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => true, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Sample API endpoint to fetch products
if ($_GET['action'] == 'getProducts') {
    $result = $conn->query("SELECT * FROM add_product");
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode(['success' => true, 'products' => $products]);
}

// API endpoint to check user credentials
if ($_GET['action'] == 'getUserCredentials') {
    $email = $conn->real_escape_string($_GET['email']); // Use real_escape_string for basic protection against SQL injection
    $password = $conn->real_escape_string($_GET['password']);

    // Note: Use prepared statements to prevent SQL injection.
    $stmt = $conn->prepare("SELECT * FROM signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $user['password'])) {
            // Passwords match
            unset($user['password']); // Do not include the password in the response

            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            echo json_encode(['error' => true, 'message' => 'Invalid credentials']);
        }
    } else {
        echo json_encode(['error' => true, 'message' => 'Invalid credentials']);
    }

    $stmt->close();
}

// Sample API endpoint to fetch user details from other tables
if ($_GET['action'] == 'getUserDetails') {
    $userId = intval($_GET['userId']); // Assuming userId is passed from the Android app

    // Fetch user details from multiple tables
    $result = $conn->query("SELECT * FROM signup s
                            LEFT JOIN userdetails u ON s.id = u.userid
                            LEFT JOIN cart c ON s.id = c.userid
                            WHERE s.id = $userId");

    if ($result) {
        $userDetails = $result->fetch_assoc();
        echo json_encode(['success' => true, 'userDetails' => $userDetails]);
    } else {
        echo json_encode(['error' => true, 'message' => 'Error fetching user details']);
    }
}

// Close the connection
$conn->close();
?>
