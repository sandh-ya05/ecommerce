<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="content">
<?php
// Include database connection
include('./includes/db.php');

// Handle the delete operation
if (isset($_GET['delete'])) {
    $item_id = $_GET['delete'];
    
    // Delete the item from the order_items table
    $delete_query = "DELETE FROM php_project.order_items WHERE item_id = $item_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Item deleted successfully!'); window.location.href = 'items.php';</script>";
    } else {
        echo "Error deleting item: " . mysqli_error($conn);
    }
}

// Handle the edit operation
if (isset($_POST['edit_item'])) {
    $item_id = $_POST['item_id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    
    // Handle image upload if a new image is uploaded
    $product_image = $_FILES['product_image']['name'];
    if ($product_image) {
        move_uploaded_file($_FILES['product_image']['tmp_name'], "../assets/imgs/" . $product_image);
    }

    // Update the item details in the order_items table
    $update_query = "
        UPDATE php_project.order_items
        SET 
            product_id = '$product_id',
            product_name = '$product_name',
            product_price = '$product_price',
            product_image = IF('$product_image' != '', '$product_image', product_image)
        WHERE item_id = $item_id
    ";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Item updated successfully!'); window.location.href = 'items.php';</script>";
    } else {
        echo "Error updating item: " . mysqli_error($conn);
    }
}

// Fetch all items from the order_items table
$item_query = "SELECT * FROM php_project.order_items";
$item_result = mysqli_query($conn, $item_query);

// Check for any errors in fetching data
if (!$item_result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items - Admin Dashboard</title>
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
        /* Edit Modal Styling */
        #editModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 400px;
        }
        #editModal h3 {
            margin-bottom: 15px;
        }
        #editModal form {
            display: flex;
            flex-direction: column;
        }
        #editModal input {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        #editModal input[type="submit"], #editModal button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
        }
        #editModal input[type="submit"]:hover, #editModal button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Order Items List</h2>

    <!-- Items Table -->
    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Product Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($item_result)): ?>
            <tr>
                <td><?php echo $row['item_id']; ?></td>
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['product_price']; ?></td>
                <td><img src="../assets/imgs/<?php echo $row['product_image']; ?>" alt="Product Image" width="100"></td>
                <td>
                    <a href="#" onclick="editItem(<?php echo $row['item_id']; ?>, '<?php echo $row['product_id']; ?>', '<?php echo $row['product_name']; ?>', '<?php echo $row['product_price']; ?>', '<?php echo $row['product_image']; ?>')">Edit</a>
                    <a href="items.php?delete=<?php echo $row['item_id']; ?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Edit Item Modal -->
    <div id="editModal">
        <h3>Edit Item</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="item_id" id="edit_item_id">
            <label>Product ID:</label>
            <input type="text" name="product_id" id="edit_product_id" required><br><br>
            <label>Product Name:</label>
            <input type="text" name="product_name" id="edit_product_name" required><br><br>
            <label>Product Price:</label>
            <input type="text" name="product_price" id="edit_product_price" required><br><br>
            <label>Product Image:</label>
            <input type="file" name="product_image" id="edit_product_image"><br><br>
            <input type="submit" name="edit_item" value="Update Item">
            <button type="button" onclick="closeEditModal()">Cancel</button>
        </form>
    </div>

    <script>
        function editItem(item_id, product_id, product_name, product_price, product_image) {
            // Populate the modal with the current data
            document.getElementById('edit_item_id').value = item_id;
            document.getElementById('edit_product_id').value = product_id;
            document.getElementById('edit_product_name').value = product_name;
            document.getElementById('edit_product_price').value = product_price;

            // Set the current image (optional, you can show the existing image)
            document.getElementById('edit_product_image').value = '';

            // Show the modal
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
</div>

<?php include('includes/footer.php'); ?>
