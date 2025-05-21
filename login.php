<?php
session_start();
include('server/connection.php');
if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; // Do not hash here; use password_verify.

    // Prepare the statement
    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email=? LIMIT 1");
    if (!$stmt) {
        die("Statement preparation failed: " . $conn->error);
    }
    $stmt->bind_param('s', $email);
    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $hashed_password);
        $stmt->store_result();
        // Check if user exists
        if ($stmt->num_rows == 1) {
            $stmt->fetch();
           // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Set session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['logged_in'] = true;
             header('location: account.php?message=Logged in successfully');
                exit;
            } else {
                // Invalid password
                header('location: login.php?error=Invalid email or password');
                exit;
            }
        } else {
            // User not found
            header('location: login.php?error=Invalid email or password');
            exit;
        }
    } else {
        // Execution error
        header('location: login.php?error=Something went wrong');
        exit;
    }
}
?>

<?php
include('layouts/header.php');
?>

  <!--login-->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Login</h2>
      <hr class="mx-auto">

    </div>
    <div class="mx-auto container">
      <form id="login-form" method="POST" action="login.php">
      <p style="color: red" class="text-center"><?php if(isset($_GET['error'])) {echo $_GET['error'];} ?></p>
      <p style="color: red" class="text-center"><?php if(isset($_GET['message'])) {echo $_GET['message'];} ?></p>
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login">
        </div>
        <div class="form-group">
         <a id="register-url" class="btn" href="register.php">Don't have account? Register</a>
        </div>
      </form>
    </div>
  </section>














  <?php
include('layouts/footer.php');
?>