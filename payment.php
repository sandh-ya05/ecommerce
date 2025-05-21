<?php
session_start();

if (isset($_POST['order_pay_btn'])) {
    $order_status = isset($_POST['order_status']) ? $_POST['order_status'] : null;
    $order_total_price = isset($_POST['order_total_price']) ? $_POST['order_total_price'] : 0;

    // Optionally, you can save these values in the session for later use
    $_SESSION['order_status'] = $order_status;
    $_SESSION['order_total_price'] = $order_total_price;
}
?>

<?php
include('layouts/header.php');
?>



      <!--payment-->
      <section class="my-5 py-5">
<div class="container text-center mt-3 pt-5">
<h2 class="form-weight-bold">Payment</h2>
<hr class="mx-auto">
</div>
<div class="mx-auto container text-center">
<?php if(isset($_POST['order_status']) && $_POST['order_status']=="on_hold") {?>
    <?php $amount= strval($_SESSION['order_total_price']);?>
    <?php $order_id=$_POST['order_id'];?>
    <p>Total payment: Rs <?php echo  $_POST['order_total_price'];?></p>
    <div id="paypal-button-container"></div>
<!--<input class="btn btn-primary" type="submit" value="Pay Now"/>-->  

<?php } elseif(isset($_SESSION['total']) && $_SESSION['total']!=0){ ?>
  <?php $amount=strval($_SESSION['total']);?>
    <?php $order_id=$_SESSION['order_id'];?>
  <p>Total payment: Rs <?php echo   $_SESSION['total']; ?></p>
  <!--<input class="btn btn-primary" type="submit" value="Pay Now"/>-->
  <div id="paypal-button-container"></div>




  <?php } else { ?>
    <p>You don't have a order</p>  

    <?php } ?>

<!-- PayPal Button Container -->
 
</div>
</section>
    




 <!-- Initialize the JS-SDK -->
<script
  src="https://www.paypal.com/sdk/js?client-id=Ab0C5ceG1k5tJQmtQKJQt2BZpPthPqNTtvBvAitikMxh2--VxRugqLDMgRjkLLhcJL_TVF-Y5wgSY30y&currency=USD&components=buttons&disable-funding=credit,card,venmo,paylater"
></script>
<script>
window.paypal
  .Buttons({
    style: {
      shape: "rect",
      layout: "vertical",
      color: "gold",
      label: "paypal",
      height: 40,
    },
    
    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [
          {
            amount: {
              value: '<?php echo $amount; ?>', // PHP variable echoed
            },
          },
        ],
      });
    },
    onApprove: function (data, actions) {
      return actions.order.capture().then(function (details) {
        const transactionStatus = details.status;
        const transactionId = details.id;
        alert(`Transaction ${transactionStatus}: ${transactionId}`);
        console.log("Transaction Details:", details);

        window.location.href =
          "server/complete_payment.php?transaction_id=" +
          transactionId +
          "&order_id=" +
          <?php echo $order_id; ?>;
      });
    },
    onError: function (err) {
      console.error("PayPal Button Error:", err);
    },
  })
  .render("#paypal-button-container");
</script>









      <?php
include('layouts/footer.php');
?>

  