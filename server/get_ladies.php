<?php
include('connection.php');
$stmt= $conn->prepare("Select * from products where product_category='ladies'");
$stmt->execute();
$ladies= $stmt->get_result();
?>