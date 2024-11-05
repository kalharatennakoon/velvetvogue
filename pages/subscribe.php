<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Optional custom styles -->
    <title>Subscribe to Newsletter</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        h2 {
            margin-bottom: 30px;
        }
    </style>
    
</head>
<body>
    <div class="container mt-5">
        <!-- Back to Home -->
        <a href="../index.php" class="btn btn-sm btn-secondary me-3 justify-content-start mb-3">
            <i class="fa-solid fa-house"></i> Back to Home
        </a>
        <h2 class="text-center">Subscribe to Our Newsletter</h2>
        <form id="subscribeForm" method="POST" action="process-subscribe.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-dark btn-block">Subscribe</button>
        </form>
        <div id="message" class="mt-3"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script>
    // script.js

    $(document).ready(function() {
        $('#subscribeForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Clear any previous messages
            $('#message').empty();

            // Get form values
            var name = $('#name').val().trim();
            var email = $('#email').val().trim();

            // Simple validation
            if (name === '') {
                $('#message').html('<div class="alert alert-danger">Name is required.</div>');
                return; // Stop form submission
            }

            if (email === '') {
                $('#message').html('<div class="alert alert-danger">Email is required.</div>');
                return; // Stop form submission
            }

            // Regular expression for email validation
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                $('#message').html('<div class="alert alert-danger">Please enter a valid email address.</div>');
                return; // Stop form submission
            }

            // Prepare data for AJAX submission
            var formData = {
                name: name,
                email: email
            };

            // AJAX request
            $.ajax({
                type: 'POST',
                url: 'process-subscribe.php', // URL to your PHP processing file
                data: formData,
                success: function(response) {
                    // Handle success response
                    $('#message').html('<div class="alert alert-success">' + response + '</div>');
                    $('#subscribeForm')[0].reset(); // Clear the form
                },
                error: function() {
                    // Handle error response
                    $('#message').html('<div class="alert alert-danger">An error occurred while subscribing. Please try again later.</div>');
                }
            });
        });
    });

    </script>

</body>
</html>