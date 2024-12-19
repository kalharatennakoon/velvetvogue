<?php
// config.php - Central configuration for the project

define('BASE_URL', 'http://localhost/velvetvogue'); // Replace with your actual project URL
define('IMAGE_UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . "/velvetvogue/assets/images/customer-images/");
define('PRODUCT_IMAGE_PATH', 'assets/images/products'); // Only the relative path

$site_title = 'VELVET VOGUE';

// Database credentials
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "velvet_vogue"; 

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "<script>console.error('Connection failed: " . $conn->connect_error . "');</script>";
} else {
    echo "<script>console.log('Successfully connected to the database.');</script>";
}
?>
<?php