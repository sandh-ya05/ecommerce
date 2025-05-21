<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="content">
<?php
// Include the database connection
include('./includes/db.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_special_offer = $_POST['product_special_offer'];
    $product_color = $_POST['product_color'];

    // Handle file upload for product images
    $product_image = $_FILES['product_image']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];
    $product_image4 = $_FILES['product_image4']['name'];

    // Upload directories
    $target_dir = "../assets/imgs/";
    $target_file1 = $target_dir . basename($product_image);
    $target_file2 = $target_dir . basename($product_image2);
    $target_file3 = $target_dir . basename($product_image3);
    $target_file4 = $target_dir . basename($product_image4);

    // Move uploaded images to the target directory
    move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file1);
    move_uploaded_file($_FILES['product_image2']['tmp_name'], $target_file2);
    move_uploaded_file($_FILES['product_image3']['tmp_name'], $target_file3);
    move_uploaded_file($_FILES['product_image4']['tmp_name'], $target_file4);

    // Insert product data into the database
    $query = "
        INSERT INTO php_project.products (product_name, product_category, product_description, 
            product_image, product_image2, product_image3, product_image4, product_price, 
            product_special_offer, product_color)
        VALUES ('$product_name', '$product_category', '$product_description', 
            '$product_image', '$product_image2', '$product_image3', '$product_image4', 
            '$product_price', '$product_special_offer', '$product_color')
    ";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product added successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        form input[type="text"], form input[type="number"], form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Add New Product</h2>

    <form method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="product_name" required><br>

        <label>Product Category:</label>
        <input type="text" name="product_category" required><br>

        <label>Product Description:</label>
        <textarea name="product_description" rows="4" required></textarea><br>

        <label>Product Price:</label>
        <input type="number" name="product_price" step="0.01" required><br>

        <label>Product Special Offer:</label>
        <input type="number" name="product_special_offer" required><br>

        <label>Product Color:</label>
        <input type="text" name="product_color" required><br>

        <label>Product Image:</label>
        <input type="file" name="product_image" accept="image/*" required><br>

        <label>Product Image 2:</label>
        <input type="file" name="product_image2" accept="image/*"><br>

        <label>Product Image 3:</label>
        <input type="file" name="product_image3" accept="image/*"><br>

        <label>Product Image 4:</label>
        <input type="file" name="product_image4" accept="image/*"><br>

        <input type="submit" name="submit" value="Add Product">
    </form>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
</div>

<?php include('includes/footer.php'); ?>
