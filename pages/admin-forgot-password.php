<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - VELVET VOGUE Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin-styles.css" />

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

    <!-- Forgot Password Section -->
    <section class="forgot-password-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <!-- Forgot Password Form -->
                    <div class="forgot-password-form">
                        <h2 class="forgot-password-title">Forgot Password</h2>

                        <!-- Form Start -->
                        <form action="admin-forgot-password-process.php" method="POST" id="forgotPasswordForm" novalidate>
                            <div class="mb-3">
                                <label for="email" class="form-label">Enter Your Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark">Reset Password</button>
                            </div>

                            <div class="mt-3 text-center">
                                <p>Remember your password? <a href="admin-login.php">Login here</a></p>
                            </div>
                        </form>
                        <!-- Form End -->

                        <!-- Success Message (Initially hidden) -->
                        <div id="successMessage" class="alert alert-success mt-4 d-none" role="alert">
                            A password reset link has been sent to your email.
                        </div>

                        <!-- Error Message (Initially hidden) -->
                        <div id="errorMessage" class="alert alert-danger mt-4 d-none" role="alert">
                            Sorry, we couldn't find an account with that email address. Please try again.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- JavaScript for Form Handling -->
    <script>
        (function() {
            'use strict';

            // Fetch form elements
            const form = document.getElementById('forgotPasswordForm');
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Simulate form submission process (replace with actual server-side process)
                if (form.checkValidity()) {
                    successMessage.classList.remove('d-none'); // Show success message
                    form.reset(); // Reset form fields

                    // Hide success message after 4 seconds
                    setTimeout(() => {
                        successMessage.classList.add('d-none');
                    }, 4000);
                } else {
                    errorMessage.classList.remove('d-none'); // Show error message
                }

                form.classList.add('was-validated'); // Add Bootstrap validation classes
            });
        })();
    </script>
</body>
</html>
