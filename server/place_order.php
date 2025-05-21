<?php
session_start();
include('connection.php');
//if not logged in
if(!isset($_SESSION['logged_in'])){
    header('location: ../checkout.php? message=Please log in to place an order');
}else{

if (isset($_POST['place_order'])) {
    // Get user info from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    // Order details
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    $user_id = $_SESSION['user_id']; // Replace this with the actual logged-in user ID
    $order_date = date('Y-m-d H:i:s');

    // Insert into `orders` table
    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("SQL error (orders): " . $conn->error); // Debugging SQL error
    }

    // Bind parameters and execute the statement
    $stmt->bind_param('dsiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
    $stmt_status= $stmt->execute();
    if(!$stmt_status){
        header('location: ../index.php');
        exit;
    }
    $order_id = $stmt->insert_id;

    // Insert into `order_items` table
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];

        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt1) {
            die("SQL error (order_items): " . $conn->error); // Debugging SQL error
        }

        // Bind parameters and execute
        $stmt1->bind_param('isssdiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
        $stmt1->execute();
    }
//remove everything from cart

    //infrm user whether every thing is fine or there is problem\
$_SESSION['order_id']=$order_id;
header('location: ../payment.php?order_status= Order placed successfully');

}}
?>