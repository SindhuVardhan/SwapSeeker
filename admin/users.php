<?php
// Include database connection and other necessary files
include_once "db_connection.php";

// If user submits the form to remove a user
if (isset($_POST['remove_user'])) {
    $user_id = $_POST['user_id'];

    // Prepare a delete statement
    $queryDeleteUser = "DELETE FROM signup WHERE id = ?";
    
    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $queryDeleteUser);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $user_id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check if deletion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo '<script>alert("User deleted successfully!");</script>';
    } else {
        echo '<script>alert("Failed to delete user.");</script>';
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Fetch users data from the signup table
$queryUsers = "SELECT * FROM signup";
$resultUsers = mysqli_query($conn, $queryUsers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <!-- Basic CSS for table styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Users page content -->
    <h1>Users</h1>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th> <!-- New column for remove button -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultUsers)) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Are you sure you want to remove this user?');">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="remove_user" class="btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
