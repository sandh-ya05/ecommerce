<?php
include("server/connection.php");
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add to cart functionality
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    
    // Ensure the cart session is an array and contains product details
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], "product_id");

        // Check if the product is already in the cart
        if (!in_array($product_id, $products_array_ids)) {
            // Get and sanitize product data
            $product_name = trim($_POST['product_name'], '/');
            $product_price = trim($_POST['product_price'], '/');
            $product_image = $_POST['product_image'];
            $product_quantity = (int)$_POST['product_quantity']; // Ensure it's an integer
            
            // Prepare product array to store in the cart
            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_quantity' => $product_quantity
            );
            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            echo '<script>alert("Product is already added to the cart.");</script>';
        }
    } else {
        // If the cart doesn't exist, initialize it with the first product
        $product_name = trim($_POST['product_name'], '/');
        $product_price = trim($_POST['product_price'], '/');
        $product_image = $_POST['product_image'];
        $product_quantity = (int)$_POST['product_quantity']; // Ensure it's an integer

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );
        $_SESSION['cart'][$product_id] = $product_array;
    }

    // Recalculate total after adding the product
    calculateTotalCart();
}

// Remove product from cart
else if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];

    // Remove the product from the cart
    unset($_SESSION['cart'][$product_id]);

    // Recalculate total
    calculateTotalCart();
}

// Edit quantity of a product in the cart
else if (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $product_quantity = (int)$_POST['product_quantity']; // Ensure it's an integer

    // Ensure product exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // Update product quantity
        $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
        calculateTotalCart();
    }
}

// Function to calculate total cart value
function calculateTotalCart() {
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];
        $total += ($price * $quantity);
    }
    $_SESSION['total'] = $total;
}

?>

<?php
include('layouts/header.php');
?>

<!--cart-->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bolde">Your Cart</h2>
      
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>

        <?php foreach($_SESSION['cart']as $key=>$value){ ?>
        <tr>
            <td>
                <div class="product-info">
                    <img src="assets/imgs/<?php echo $value['product_image']; ?>">
                
                <div>
                    <p><?php echo $value['product_name']; ?></p>
                    <small><span>Rs</span><?php echo $value['product_price']; ?></small>
                <br>
                <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id"  value="<?php echo $value['product_id']; ?>"/>
                  <input type="submit" name="remove_product" class="remove-btn" value="Remove">
        </form></div></div>

            </td>
            <td>
         
                <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id"  value="<?php echo $value['product_id']; ?>"/>
                  <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
                  <input type="submit" name="edit_quantity" class="edit-btn" value="Edit">
        </form> </td>
            <td>
                <span>Rs</span>
                <span class="product-price"><?php echo  $value['product_quantity']* $value['product_price']; ?></span>            </td>
        </tr>
       <?php } ?>
       
    </table>
    <div class="cart-total">
        <table>

<tr>
    <td>Total</td>
    <td>Rs <?php echo isset($_SESSION['total']) ? $_SESSION['total'] : 0; ?></td>

        </table>
    </div>
    <div class="checkout-container">
          <form method="POST" action="checkout.php">
         <input type="submit" name="checkout" class="btn checkout-btn" value="Checkout">
</form>
    </div>
   
</section>


















<?php
include('layouts/footer.php');
?>