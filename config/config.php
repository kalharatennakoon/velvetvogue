<?php
// config.php - Central configuration for the project

// setting BASE_URL to http://localhost/velvetvogue/ for local development
define('BASE_URL', 'http://localhost/velvetvogue'); // REPLACE this with your actual project URL

// Ensure this path is correct, pointing to your project's root and the target folder
define('IMAGE_UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . "/velvetvogue/assets/images/customer-images/");

// In config.php
define('PRODUCT_IMAGE_PATH', BASE_URL . '/assets/images/products/');



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

// If you have other database connections, you can add them here
// For example, if you want to create another connection for a different database
// $conn2 = new mysqli('localhost', 'root', '', 'other_database_name');

// If you need to check for errors in another connection:
if (isset($conn2) && $conn2->connect_error) {
    echo "<script>console.error('Connection failed to second database: " . $conn2->connect_error . "');</script>";
} else {
    echo "<script>console.log('Successfully connected to the second database.');</script>";
}


?>



