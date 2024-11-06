<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - VELVET VOGUE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin-styles.css" />

</head>
<body>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">VELVET VOGUE</a>
            </div>
        </nav>
    </header>

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


    <!-- Admin Footer -->
    <footer class="text-white p-4 bg-dark mt-5">
        <div class="container">
            <div class="row">
                <!-- Brand and Description -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <h6 class="text-uppercase fw-bold mb-4">VELVET VOGUE</h6>
                    <p>Admin Dashboard: Manage, monitor, and control your product listings, orders, and user interactions.</p>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <h6 class="text-uppercase fw-bold mb-4">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="admin-dashboard.php" class="text-reset text-white">Dashboard</a></li>
                        <li><a href="admin-products.php" class="text-reset text-white">Manage Products</a></li>
                        <li><a href="admin-orders.php" class="text-reset text-white">Orders</a></li>
                        <li><a href="admin-users.php" class="text-reset text-white">User Management</a></li>
                    </ul>
                </div>

                <!-- Support and Documentation -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <h6 class="text-uppercase fw-bold mb-4">Support & Docs</h6>
                    <ul class="list-unstyled">
                        <li><a href="admin-help.php" class="text-reset text-white">Help & Support</a></li>
                        <li><a href="admin-logs.php" class="text-reset text-white">System Logs</a></li>
                        <li><a href="admin-faq.php" class="text-reset text-white">FAQs</a></li>
                    </ul>
                </div>

                <!-- Account Settings -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <h6 class="text-uppercase fw-bold mb-4">Account Settings</h6>
                    <ul class="list-unstyled">
                        <li><a href="admin-profile.php" class="text-reset text-white">Profile</a></li>
                        <li><a href="admin-change-password.php" class="text-reset text-white">Change Password</a></li>
                        <li><a href="admin-logout.php" class="text-reset text-white">Logout</a></li>
                    </ul>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Social Media & Contact Links -->
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <h6 class="text-uppercase fw-bold mb-4">Follow Us</h6>
                    <div class="d-flex">
                        <a href="#" class="text-reset me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-reset me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-reset me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-reset me-3"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 text-end">
                    <div class="text-center">
                        <small>© 2024 VELVET VOGUE - Admin Panel. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </footer>



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
