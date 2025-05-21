<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect the user to the login page after logging out
header("Location: index.php");
exit();
?>
