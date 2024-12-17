<?php
$conn = mysqli_connect('localhost', 'root', '', 'velvet_vogue');
if ($conn) {
    echo "<script>console.log('Database connection successful!');</script>";
} else {
    echo "<script>console.error('Connection failed: " . mysqli_connect_error() . "');</script>";
}
?>