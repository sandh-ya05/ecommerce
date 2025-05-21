<?php
session_start();

if (!empty($_SESSION['cart'])) {
    // Redirect to index.php if cart is empty or checkout is not set
    // Ensure script stops execution after the redirect
}else{
  header('location: index.php');

}

// Let user proceed if cart is not empty and checkout is set
// Your checkout logic here
?>



?>
<?php
include('layouts/header.php');
?>


      <!--checkout-->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
          <h2 class="form-weight-bold">Check Out</h2>
          <hr class="mx-auto">
    
        </div>
        <div class="mx-auto container">
                      <form id="checkout-form" method="POST" action="server/place_order.php">
                  <p class="text-center" style="color: red;">
                      <?php if(isset($_GET['message'])){ echo $_GET['message']; }?>
                      <?php if(isset($_GET['message'])){ ?>
                          <a href="login.php" class="btn btn-primary">Login</a>
                      <?php } ?>
                  </p>
             

            <div class="form-group checkout-small-element">
              <label>Name</label>
              <input type="text" class="form-control" id="checkout-name" name="name"  required>
            </div>
            <div class="form-group checkout-small-element">
            <label>Email</label>
            <input type="text" class="form-control" id="checkout-email" name="email"  required>
          </div>
            <div class="form-group checkout-small-element">
              <label>Phone</label>
              <input type="tel" class="form-control" id="checkout-phone" name="phone"  required>
            </div>
            <div class="form-group checkout-small-element">
                <label> City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" required>
              </div>
              <div class="form-group checkout-large-element">
                <label>Address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" required>
              </div>
            <div class="form-group text-end">
              <p class="fw-bold">Total amount :Rs <?php echo $_SESSION['total']; ?> </p>
              <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
            </div>
            
          </form>
        </div>
      </section>
    














      <?php
include('layouts/footer.php');
?>