<?php
// Start the session if needed
session_start();



// Include database connection
include_once "db_connection.php";

// Fetch reports data from database
$queryReports = "SELECT * FROM product_reports";
$resultReports = mysqli_query($conn, $queryReports);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
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
            padding: 8px;
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
        .no-reports {
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Reports</h1>
    <?php if (mysqli_num_rows($resultReports) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Product ID</th>
                    <th>User ID</th>
                    <th>Reason</th>
                    <th>Report Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultReports)) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['reason']; ?></td>
                        <td><?php echo $row['report_date']; ?></td>
                        <td>
                            <form method="post" onsubmit="return confirm('Are you sure you want to delete this report?');">
                                <input type="hidden" name="report_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="remove_report" class="btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="no-reports">No reports found.</p>
    <?php endif; ?>
</body>
</html>

<?php
// If admin submits the form to remove a report
if (isset($_POST['remove_report'])) {
    $report_id = $_POST['report_id'];

    // Prepare a delete statement
    $queryDeleteReport = "DELETE FROM product_reports WHERE id = ?";

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $queryDeleteReport);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $report_id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check if deletion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo '<script>alert("Report deleted successfully!");</script>';
        // Redirect to refresh the page after deletion
        echo '<script>window.location.replace("reports.php");</script>';
    } else {
        echo '<script>alert("Failed to delete report.");</script>';
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
