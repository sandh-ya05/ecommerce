
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

// Fetch product data for editing
$product_data = [];
if (isset($_GET['edit'])) {
    $product_id = $_GET['edit'];
    $sql = "SELECT * FROM products WHERE product_id=$product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product_data = $result->fetch_assoc();
    } else {
        echo "Product not found!";
    }
}

// Update product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];
    $product_image = $_POST['product_image'];
    $product_price = $_POST['product_price'];
    $product_color = $_POST['product_color'];
    $product_special_offer = $_POST['product_special_offer'];

    $sql = "UPDATE products SET 
            product_name='$product_name',
            product_category='$product_category',
            product_description='$product_description',
            product_image='$product_image',
            product_price='$product_price',
            product_color='$product_color',
            product_special_offer='$product_special_offer' 
            WHERE product_id=$product_id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully. <a href='products.php'>Go back to products list</a>";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit Product</h2>

    <form method="POST" action="edit_products.php">
        <input type="hidden" name="product_id" value="<?php echo $product_data['product_id']; ?>">

        <input type="text" name="product_name" placeholder="Product Name" value="<?php echo $product_data['product_name']; ?>" required><br>
        <input type="text" name="product_category" placeholder="Product Category" value="<?php echo $product_data['product_category']; ?>" required><br>
        <textarea name="product_description" placeholder="Product Description" required><?php echo $product_data['product_description']; ?></textarea><br>
        <input type="text" name="product_image" placeholder="Product Image URL" value="<?php echo $product_data['product_image']; ?>" required><br>
        <input type="number" step="0.01" name="product_price" placeholder="Product Price" value="<?php echo $product_data['product_price']; ?>" required><br>
        <input type="text" name="product_color" placeholder="Product Color" value="<?php echo $product_data['product_color']; ?>" required><br>
        <input type="number" name="product_special_offer" placeholder="Special Offer (1 = Yes, 0 = No)" value="<?php echo $product_data['product_special_offer']; ?>" required><br>

        <button type="submit" name="edit_product">Update Product</button>
    </form>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
</div>

<?php include('includes/footer.php'); ?>
