<?php

    // config.php - Central configuration for the project

    define('BASE_URL', 'http://localhost/velvetvogue'); // Replace with the actual project URL
    define('CUSTOMER_IMAGE_PATH', 'assets/images/customer-images'); // Path to store customer images
    define('PRODUCT_IMAGE_PATH', 'assets/images/products'); // Path to store product images

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




