<?php
include('connection.php');
$stmt= $conn->prepare("Select * from products where product_category='branded'");
$stmt->execute();
$branded= $stmt->get_result();
?>