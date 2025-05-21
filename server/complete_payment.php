<?php
session_start();
include('connection.php');


if(isset($_GET['transaction_id']) && isset($_GET['order_id'])){
    //change order status

    $order_id=$_GET['order_id'];
    $order_status="paid";
    $transaction_id=$_GET['transaction_id'];
    $user_id=$_SESSION['user_id'];
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si', $order_status, $order_id);

    $stmt->execute();

//store payment info
$stmt1 = $conn->prepare("INSERT INTO payments (order_id,  user_id,transaction_id) VALUES (?, ?, ?)");

// Bind parameters and execute the statement
$stmt1->bind_param('iii', $order_id, $user_id, $transaction_id);
$stmt1= $stmt1->execute();


//go to user acount
header('location: ../account.php?payment_message=Payment Successful!Thanks for choosing us!');
}