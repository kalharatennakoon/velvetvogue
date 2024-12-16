<?php 
    include_once('../config/config.php'); 
    $page_title = 'Admin Login';
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

    <!-- Admin Login Section -->
    <section class="login-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="card shadow-sm border-light">
                        <div class="card-body p-5">
                            <h2 class="login-title text-center mb-4"><i class="fa fa-lock"></i> Admin Login</h2>

                            <!-- Login Form -->
                            <form action="admin-login-process.php" method="POST" id="loginForm" novalidate>
                                <!-- Username or Email -->
                                <div class="mb-3">
                                    <label for="username" class="form-label"><i class="fa fa-user me-2"></i> Username or Email</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                    <div class="invalid-feedback">Please enter your username or email.</div>
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label"><i class="fa fa-key me-2"></i> Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="invalid-feedback">Please enter your password.</div>
                                </div>

                                <!-- Remember Me Checkbox -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-dark w-100">
                                    <i class="fa fa-sign-in-alt me-2"></i> Login
                                </button>
                            </form>

                            <!-- Forgot Password Link -->
                            <div class="text-center mt-3">
                                <a href="admin-forgot-password.php" class="text-decoration-none text-muted">
                                    <i class="fa fa-question-circle me-2"></i> Forgot Password?
                                </a>
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

            const form = document.getElementById('loginForm');
            
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                // Check form validity
                if (form.checkValidity()) {
                    // Proceed with form submission (you can use AJAX or post data here)
                    alert("Login successful!");
                    form.submit();
                }
                
                form.classList.add('was-validated'); // Add Bootstrap validation classes
            });
        })();
    </script>
</body>
</html>
