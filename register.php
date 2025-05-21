<?php
session_start();
include('server/connection.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable MySQLi error reporting
// ifuser registered
if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        header('location: register.php?error=Password does not match.');
        exit;
    } else if (strlen($password) < 6) {
        header('location: register.php?error=Password must be greater than 6 characters.');
        exit;
    } else {
        // Check if the user exists
        $stmt1 = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_email=?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->fetch();
        $stmt1->close();

        if ($num_rows != 0) {
            header('location: register.php?error=User with this email already exists.');
            exit;
        } else {
            // Insert the new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
            if (!$stmt) {
                die("Statement preparation failed: " . $conn->error);
            }
            $stmt->bind_param('sss', $name, $email, $hashed_password);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {

            $user_id=$stmt->insert_id;
            $_SESSION['user_id'] = $user_id;
                // Save session details
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;

                // Redirect to account page
                header('location: account.php?register_success=Your account was created successfully.');
                exit;
            } else {
                header('location: register.php?error=Account could not be created.');
                exit;
            }
        }
    }
} 

?>



<?php
include('layouts/header.php');
?>

  <!--register-->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Register</h2>
      <hr class="mx-auto">

    </div>
    <div class="mx-auto container">
      <form id="register-form" method="POST" action="register.php">
      <p style="color: red;"><?php if(isset($_GET['error'])) {echo $_GET['error'];} ?></p>
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" id="register-name" name="name"  required>
        </div><div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" id="register-email" name="email"  required>
      </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="register-password" name="password"  required>
        </div>
        <div class="form-group">
            <label> Confirm Password</label>
            <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" required>
          </div>
        <div class="form-group">
          <input type="submit" class="btn" id="register-btn" name="register" value="Register">
        </div>
        <div class="form-group">
         <a id="login-url" class="btn" href="login.php">Do you have account? Login</a>
        </div>
      </form>
    </div>
  </section>













  <?php
include('layouts/footer.php');
?>