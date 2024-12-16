<?php 
    include_once('../config/config.php'); 
    $page_title = 'Admin Register';
    include_once('../includes/head-links.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin-styles.css" />

</head>
<body>

    <!-- Header -->
    <?php include '../includes/admin-header.php'; ?>


    <!-- Admin Register Section -->
    <section class="register-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="card shadow-sm border-light">
                        <div class="card-body p-5">
                            <h2 class="register-title text-center mb-4"><i class="fa fa-user-plus"></i> Admin Register</h2>

                            <!-- Register Form -->
                            <form action="admin-register-process.php" method="POST" id="registerForm" novalidate>
                                <!-- Full Name -->
                                <div class="mb-3">
                                    <label for="fullName" class="form-label"><i class="fa fa-user me-2"></i> Full Name</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                                    <div class="invalid-feedback">Please enter your full name.</div>
                                </div>

                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="username" class="form-label"><i class="fa fa-user-circle me-2"></i> Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                    <div class="invalid-feedback">Please enter a username.</div>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label"><i class="fa fa-envelope me-2"></i> Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label"><i class="fa fa-key me-2"></i> Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="invalid-feedback">Please enter a password.</div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label"><i class="fa fa-key me-2"></i> Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                    <div class="invalid-feedback">Please confirm your password.</div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-dark w-100">
                                    <i class="fa fa-user-check me-2"></i> Register
                                </button>
                            </form>

                            <!-- Login Link -->
                            <div class="text-center mt-3">
                                <p class="text-muted">Already have an account? <a href="admin-login.php" class="text-decoration-none">Login here</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../includes/admin-footer.php'; ?>


    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- JavaScript for Form Validation -->
    <script>
        (function() {
            'use strict';

            const form = document.getElementById('registerForm');
            
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                // Check form validity
                if (form.checkValidity()) {
                    // Password match validation
                    const password = document.getElementById('password').value;
                    const confirmPassword = document.getElementById('confirm-password').value;
                    if (password !== confirmPassword) {
                        alert("Passwords do not match!");
                        return;
                    }

                    // Proceed with form submission (you can use AJAX or post data here)
                    alert("Registration successful!");
                    form.submit();
                }
                
                form.classList.add('was-validated'); // Add Bootstrap validation classes
            });
        })();
    </script>
</body>
</html>
