<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the name and email from the POST request
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));

    // Simple server-side validation
    if (empty($name) || empty($email)) {
        echo "Both fields are required.";
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Here you would typically save the data to a database or send it via email.
    // For demonstration, we'll just echo back a success message
    echo "Thank you, $name! You have subscribed with the email: $email.";
} else {
    // Redirect if accessed directly
    header("Location: subscribe.php");
    exit();
}
?>
