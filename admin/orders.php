<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>
<div class="content">
<?php
// Include database connection
include('./includes/db.php');

// Fetch orders data
$query = "
    SELECT order_id, order_status, order_date, order_cost
    FROM php_project.orders
";
$result = mysqli_query($conn, $query);

// Check for any errors in fetching data
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Handle the edit form submission
if (isset($_POST['edit'])) {
    // Get the updated values from the form
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $order_date = $_POST['order_date'];
    $order_cost = $_POST['order_cost'];

    // Update the order in the database
    $update_query = "
        UPDATE php_project.orders 
        SET order_status = '$order_status', order_date = '$order_date', order_cost = '$order_cost' 
        WHERE order_id = $order_id
    ";

    if (mysqli_query($conn, $update_query)) {
        // If update is successful, show a success message (optional)
        echo "<script>alert('Order updated successfully.');</script>";
    } else {
        echo "Error updating order: " . mysqli_error($conn);
    }
}

// Delete order if delete button is pressed
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];
    $delete_query = "DELETE FROM php_project.orders WHERE order_id = $order_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "Order deleted successfully.";
    } else {
        echo "Error deleting order: " . mysqli_error($conn);
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Admin Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <h2>Order List</h2>
    
    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo $row['order_status']; ?></td>
                <td><?php echo $row['order_date']; ?></td>
                <td><?php echo $row['order_cost']; ?></td>
                <td>
                    <!-- Edit Button -->
                    <a href="#" onclick="editOrder(<?php echo $row['order_id']; ?>, '<?php echo $row['order_status']; ?>', '<?php echo $row['order_date']; ?>', '<?php echo $row['order_cost']; ?>')">Edit</a>
                    
                    <!-- Delete Button -->
                    <a href="orders.php?delete=<?php echo $row['order_id']; ?>" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Edit Order Modal -->
    <div id="editModal" style="display:none;">
        <h3>Edit Order</h3>
        <form method="POST">
            <input type="hidden" name="order_id" id="edit_order_id">
            <label>Order Status:</label>
            <input type="text" name="order_status" id="edit_order_status" required><br>
            <label>Order Date:</label>
            <input type="text" name="order_date" id="edit_order_date" required><br>
            <label>Order Cost:</label>
            <input type="text" name="order_cost" id="edit_order_cost" required><br><br>
            <input type="submit" name="edit" value="Update Order">
            <button type="button" onclick="closeEditModal()">Cancel</button>
        </form>
    </div>

    <script>
        function editOrder(order_id, order_status, order_date, order_cost) {
            // Populate the modal with the current data
            document.getElementById('edit_order_id').value = order_id;
            document.getElementById('edit_order_status').value = order_status;
            document.getElementById('edit_order_date').value = order_date;
            document.getElementById('edit_order_cost').value = order_cost;

            // Show the modal
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>

</body>
</html>
    </div>
<?php
// Close the database connection
mysqli_close($conn);
?>

<?php include('includes/footer.php'); ?>