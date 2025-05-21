<?php
session_start(); // Start the session
include("includes/db.php"); // Include the database connection file
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <!-- container Starts -->
        <form class="form-login" action="" method="post">
            <!-- form-login Starts -->
            <h2 class="form-login-heading">Admin Login</h2>

            <input type="text" class="form-control" name="admin_email" placeholder="Email Address" required>
            <input type="password" class="form-control" name="admin_password" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login">
                Log in
            </button>
        </form>
        <!-- form-login Ends -->
    </div>
    <!-- container Ends -->
</body>

</html>

<?php
if (isset($_POST['admin_login'])) {
    // Get input values
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    // Debugging: Print email and password
    // echo "Email: $admin_email, Password: $admin_password";

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM admins WHERE admin_email = ? AND admin_password = ?");
    
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    // Bind parameters
    $stmt->bind_param("ss", $admin_email, $admin_password);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Login successful
        $_SESSION['admin_email'] = $admin_email;

        // Debugging: Print session variable
        // echo "Session Email: " . $_SESSION['admin_email'];

        echo "<script>alert('You are logged in to the admin panel');</script>";
        echo "<script>window.location.href = 'dashboard.php?dashboard';</script>";
        exit();
    } else {
        // Login failed
        echo "<script>alert('Email or Password is incorrect');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
mysqli_close($conn);
?>
