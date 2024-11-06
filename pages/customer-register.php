<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Signup - VELVET VOGUE</title>

    <!-- config.php file  -->
        <?php include_once('../config/config.php'); ?>
    
    <!-- head-link.php file -->
        <?php include_once('../includes/head-links.php'); ?>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/customer-styles.css" />


</head>
<body>

    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <section class="h-100 p-4" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">

                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-start h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Create Your Account</p>

                                    <!-- Success Message -->
                                    <div id="successMessage" class="alert alert-success d-none text-center" role="alert">
                                        Congratulations, Your Account created successfully! Redirecting to login...
                                    </div>

                                    <form id="registration-form">
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <div class="form-outline flex-fill mb-0 me-3">
                                                <input type="text" id="firstName" class="form-control" placeholder="First Name" />
                                                <small><span class="error" id="firstNameError"></span><br></small>
                                            </div>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="lastName" class="form-control" placeholder="Last Name" />
                                                <small><span class="error" id="lastNameError"></span><br></small>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="email" class="form-control" placeholder="Email" />
                                                <small><span class="error" id="emailError"></span><br></small>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="password" class="form-control" placeholder="Password" />
                                                <small><span class="error" id="passwordError"></span><br></small>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-5">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm Password" />
                                                <small><span class="error" id="confirmPasswordError"></span><br></small>
                                            </div>
                                        </div>

                                        <label class="mb-1" for="newsletter">
                                            <input type="checkbox" id="subscribeNewsletter" name="newsletter">
                                                <small>Subscribe to our newsletter</small>
                                        </label>

                                        <div class="mb-3">
                                            <label for="terms">
                                                <input type="checkbox" id="agreeTerms" name="terms" /> 
                                                <small>I agree to the <a href="<?php echo BASE_URL; ?>/pages/terms-and-conditions.php" target="_blank">Terms and Conditions</a> and <a href="<?php echo BASE_URL; ?>/pages/privacy-policy.php" target="_blank">Privacy Policy</a></small><br>
                                                <small><span class="error" id="termsError"></span><br></small>
                                            </label>
                                        </div>

                                        <div class="d-grid gap-2 mb-4">
                                            <button type="button" class="btn btn-dark btn-lg" id="registerButton">Register</button>
                                        </div>
                                    
                                    </form>

                                    <!-- Login -->
                                    <div class="d-flex justify-content-center mx-4">
                                        <p class="text-muted">Already have an account? <a href="<?php echo BASE_URL; ?>/pages/customer-login.php" class="text-decoration-none">Login</a></p>
                                    </div>

                                    <!-- Back to Home -->
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <a href="<?php echo BASE_URL; ?>/index.php" class="btn btn-sm btn-secondary me-3">
                                            <i class="fa-solid fa-house"></i> Back to Home
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="<?php echo BASE_URL; ?>/assets/images/sign_up.png" class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Validation JS -->
    <script>
        async function validateForm() {
            const isValid = validateFields(); // Check if fields are valid

            if (isValid) {
                // Show success message
                const successMessage = document.getElementById("successMessage");
                successMessage.classList.remove("d-none"); // Show the success message

                // Redirect after 2 seconds
                setTimeout(() => {
                    window.location.href = "./customer-login.html"; // Change this to your actual login page
                }, 2000);
            }
        }

        function validateFields() {
            const firstName = document.getElementById("firstName").value.trim();
            const lastName = document.getElementById("lastName").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;
            const agreeTerms = document.getElementById("agreeTerms").checked;

            // Validation patterns
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordPattern = /^(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

            // Clear previous errors
            document.getElementById("firstNameError").textContent = firstName ? "" : "First Name cannot be empty";
            document.getElementById("lastNameError").textContent = lastName ? "" : "Last Name cannot be empty";
            document.getElementById("emailError").textContent = email 
                ? (emailPattern.test(email) ? "" : "Invalid email format")
                : "Required";
            document.getElementById("passwordError").textContent = password 
                ? (passwordPattern.test(password) ? "" : "Password must be 8+ characters with a special character.")
                : "Required";
            document.getElementById("confirmPasswordError").textContent = confirmPassword 
                ? (password === confirmPassword ? "" : "Passwords must match")
                : "Required";
            document.getElementById("termsError").textContent = agreeTerms ? "" : "You must agree to terms";

            // Check if all fields are valid
            return firstName && lastName && emailPattern.test(email) && passwordPattern.test(password) && (password === confirmPassword) && agreeTerms;
        }

        // Add input event listeners for dynamic validation
        document.getElementById("firstName").addEventListener("input", validateFields);
        document.getElementById("lastName").addEventListener("input", validateFields);
        document.getElementById("email").addEventListener("input", validateFields);
        document.getElementById("password").addEventListener("input", validateFields);
        document.getElementById("confirmPassword").addEventListener("input", validateFields);
        document.getElementById("agreeTerms").addEventListener("change", validateFields);

        // Register button click event
        document.getElementById("registerButton").addEventListener("click", validateForm);
    </script>


</body>
</html>
