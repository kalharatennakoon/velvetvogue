<?php
// Start session
session_start();

// Destroy the current session
session_destroy();

// Redirect to the customer login page
header('Location: customer-login.php');
exit;
?>
