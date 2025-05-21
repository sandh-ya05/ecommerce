<?php
include('connection.php');
$stmt= $conn->prepare("Select * from products where product_category='men'");
$stmt->execute();
$men= $stmt->get_result();
?>