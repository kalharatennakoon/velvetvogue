<?php
// config.php - Central configuration for the project

// setting BASE_URL to http://localhost/velvetvogue/ for local development
define('BASE_URL', 'http://localhost/velvetvogue'); // REPLACE this with your actual project URL

// Ensure this path is correct, pointing to your project's root and the target folder
define('IMAGE_UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . "/velvetvogue/assets/images/customer-images/");



// This will be the common part of the title
$site_title = 'VELVET VOGUE';

// Database credentials
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "velvet_vogue"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log error to the browser console
    echo "<script>console.error('Connection failed: " . $conn->connect_error . "');</script>";
} else {
    // Log success to the browser console
    echo "<script>console.log('Successfully connected to the database.');</script>";
}


?>

