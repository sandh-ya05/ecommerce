<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="content">
<?php
// Include database connection
include('./includes/db.php');

// Fetch all payment data from the payments table
$query = "
    SELECT payment_id, order_id, user_id, transaction_id 
    FROM php_project.payments
";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        a {
            text-decoration: none;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            margin: 5px;
            cursor: pointer;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Payment List</h2>

    <!-- Payment Table -->
    <table>
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Transaction ID</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['payment_id']; ?></td>
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['transaction_id']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
</div>

<?php include('includes/footer.php'); ?>
