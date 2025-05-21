<?php
session_start();
include('server/connection.php');
if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
 exit;
}
if(isset($_GET['logout']))
{
  if(isset($_SESSION['logged_in']))
{
  unset($_SESSION['logged_in']);
  unset($_SESSION['user_email']);
  unset($_SESSION['user_name']);
  header('location: login.php');
  exit;
}}

if (isset($_POST['change_password'])) {
  $password = $_POST['password'];
  $confirm_password = $_POST['confirmPassword'];
  $user_email = $_SESSION['user_email'];

  // Validate password
  if ($password !== $confirm_password) {
      header('location: account.php?error=Passwords do not match.');
      exit;
  } else if (strlen($password) < 6) {
      header('location: account.php?error=Password must be greater than 6 characters.');
      exit;
  }

  // Hash the password securely
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Update the password in the database
  $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
  if (!$stmt) {
      die("Statement preparation failed: " . $conn->error);
  }
  $stmt->bind_param('ss', $hashed_password, $user_email);

  if ($stmt->execute()) {
      header('location: account.php?message=Password updated successfully');
      exit;
  } else {
      header('location: account.php?error=Could not update password');
      exit;
  }

}

//get order
if(isset($_SESSION['logged_in'])){
$user_id=$_SESSION['user_id']; 
$stmt= $conn->prepare("Select * from orders where user_id=?");
$stmt->bind_param('i',$user_id);
$stmt->execute();
$orders= $stmt->get_result();

}

?>


<?php
include('layouts/header.php');
?>
  <!--account-->
  <section class="my-5 py-5">
    <div class=" row container mx-auto">
    <p style="color: orange" class="text-center mt-5"><?php if(isset($_GET['payment_message'])) {echo $_GET['payment_message'];} ?></p>
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
      
            <h3 class="font-weight-bold">Account Info</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p>Name: <span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} ?></span></p>
                <p>Email: <span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];} ?></span></p>
                <p><a href="#orders" id="order-btn">Your Orders</a></p>
                <p><a href=" account.php?logout=1" id="logout-btn">Logout</a></p>
            </div>
            
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <form id="account-form" method="POST" action="account.php">
            <p style="color: red" class="text-center"><?php if(isset($_GET['error'])) {echo $_GET['error'];} ?></p>
            <p style="color: orange" class="text-center"><?php if(isset($_GET['message'])) {echo $_GET['message'];} ?></p>
                <h3>Change Password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label>Password</label>
<input type="password"class="form-control" id="account-password"name="password" required>

                </div>
                <div class="form-group">
                    <label> Confirm Password</label>
<input type="password"class="form-control" id="account-password-confirm"name="confirmPassword" required>

                </div>
                <div class="form-group">
                    
<input type="submit"class="btn" id="change-pass-btn" name="change_password" value="Change Password">

                </div>
            </form>
        </div>
    </div>
  
  </section>

  <!-- orders -->
  <section class="orders container my-5 py-5">
  <div class="container">
    <h2 style="font-weight: bold; text-align: center;">Your Orders</h2>
    <hr style="margin: 0 auto;">
  </div>
  <table style="width: 100%; border-collapse: collapse; margin-top: 50px; text-align: left;">
    <!-- Table Header -->
    <tr style="background-color: coral; color: white;">
      <th style="padding: 10px 15px; width: 15%; text-align: left;">Order ID</th>
      <th style="padding: 10px 15px; width: 20%; text-align: right;">Order Cost</th>
      <th style="padding: 10px 15px; width: 20%; text-align: left;">Order Status</th>
      <th style="padding: 10px 15px; width: 25%; text-align: left;">Order Date</th>
      <th style="padding: 10px 15px; width: 20%; text-align: center;">Order Details</th>
    </tr>

    <!-- Table Rows -->
    <?php while ($row = $orders->fetch_assoc()) { ?>
      <tr style="border-bottom: 1px solid #ddd;">
        <!-- Order ID -->
        <td style="padding: 10px 15px; width: 15%; text-align: left;"><?php echo $row['order_id']; ?></td>

        <!-- Order Cost -->
        <td style="padding: 10px 15px; width: 20%; text-align: right;">Rs <?php echo $row['order_cost']; ?></td>

        <!-- Order Status -->
        <td style="padding: 10px 15px; width: 20%; text-align: left;"><?php echo $row['order_status']; ?></td>

        <!-- Order Date -->
        <td style="padding: 10px 15px; width: 25%; text-align: left;"><?php echo $row['order_date']; ?></td>

        <!-- Order Details Button -->
        <td style="padding: 10px 15px; width: 20%; text-align: center;">
          <form method="POST" action="order_details.php">
          <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status" />
            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id" />
            <input class="btn order-details-btn" 
                   name="order_details_btn" 
                   style="background-color: coral; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;" 
                   type="submit" 
                   value="Details" />
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>
</section>















<?php
include('layouts/footer.php');