<?php
session_start(); // Start the session

// Clear the session data
session_unset();
session_destroy();

// Redirect to the login page
header('Location: admin_login.php');
exit();
?>
