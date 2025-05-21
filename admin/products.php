
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="content"><?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete product
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE product_id=$product_id";
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #4CAF50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            margin: 0 5px;
        }

        .actions a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>All Products</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
            <th>Color</th>
            <th>Special Offer</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['product_category']; ?></td>
                <td><?php echo $row['product_description']; ?></td>
                <td><img src="../assets/imgs/<?php echo $row['product_image']; ?>" alt="Product Image" width="100"></td>
                <td><?php echo $row['product_price']; ?></td>
                <td><?php echo $row['product_color']; ?></td>
                <td><?php echo $row['product_special_offer'] == 1 ? 'Yes' : 'No'; ?></td>
                <td class="actions">
                    <a href="edit_products.php?edit=<?php echo $row['product_id']; ?>">Edit</a> | 
                    <a href="products.php?delete=<?php echo $row['product_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?></div>

<?php include('includes/footer.php'); ?>

