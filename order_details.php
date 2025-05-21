<?php
/*on_hold
shipped
delivered */
include('server/connection.php');
if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){
 $order_id=$_POST['order_id'];
 $order_status=$_POST['order_status'];
 $stmt = $conn->prepare("select * from order_items where order_id=?");
 $stmt->bind_param('i',$order_id);
$stmt->execute();
$order_details= $stmt->get_result();
$order_total_price= calculateTotalOrderPrice($order_details);
}
else{
    header('location: account.php');
    exit;
}
function calculateTotalOrderPrice($order_details) {
    $total = 0;
    foreach ($order_details as $row) {
    $product_price=$row['product_price'];
    $product_quantity=$row['product_quantity'];
    $total += ($product_price * $product_quantity);
    }
   return $total;
   
}



?>



<?php
include('layouts/header.php');
?>

 

<section class="orders container my-5 py-3">
    <div class="container mt-5">
        <h2 style="font-weight: bold; text-align: center;">Orders Details</h2>
        <hr style="margin: 0 auto;">
    </div>
    <table style="width: 100%; border-collapse: collapse; text-align: left; margin-top: 50px; padding-top: 50px;">
        <!-- Header Row -->
        <tr style="background-color: coral; color: white;">
            <th style="padding: 10px 15px; text-align: left;">Product</th>
            <th style="padding: 10px 15px; text-align: left;">Price</th>
            <th style="padding: 10px 15px; text-align: center;">Quantity</th> <!-- Centered -->
        </tr>

        <!-- Data Rows -->
        <?php  foreach ($order_details as $row) { ?>
            <tr style="border-bottom: 1px solid #ddd;">
                <!-- Product Information -->
                <td style="padding: 10px 15px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" 
                             alt="Product Image" 
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                        <div>
                            <p style="margin-top: 10px;"><?php echo $row['product_name']; ?></p>
                        </div>
                    </div>
                </td>

                <!-- Price -->
                <td style="padding: 10px 15px;">Rs <?php echo $row['product_price']; ?></td>

                <!-- Quantity -->
                <td style="padding: 10px 15px; text-align: center;"><?php echo $row['product_quantity']; ?></td> <!-- Centered -->
            </tr>
        <?php } ?>
    </table>

    <?php if($order_status =="on_hold"){?>
        <form style="float:right;" method="POST" action="payment.php">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
            <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>"/>
            <input type="hidden" name="order_status" value="<?php echo $order_status; ?>"/>
            <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now" 
            style="background-color: coral; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;" />
        <?php } ?>
</section>














<?php
include('layouts/footer.php');
?>