<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        include_once('../config/config.php');
        $page_title = 'Login';
        include_once('../includes/head-links.php');

        // Start the session
        session_start();

        // Initialize variables for error messages
        $emailError = $passwordError = $loginError = '';

        // Handle login form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Validate email and password
            if (empty($email)) {
                $emailError = 'Email is required';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = 'Invalid email format';
            }

            if (empty($password)) {
                $passwordError = 'Password is required';
            }

            // Check credentials if no errors
            if (empty($emailError) && empty($passwordError)) {
                // Check the database for matching email
                $query = "SELECT * FROM customers WHERE email = ? LIMIT 1";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if user exists
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

                    // Verify the password against the hash stored in the database
                    if (password_verify($password, $user['password'])) {
                        // Password is correct, set session and redirect
                        $_SESSION['user_id'] = $user['customer_id'];
                        $_SESSION['user_email'] = $user['email'];
                        $_SESSION['logged_in'] = true;
                        
                        echo "<script>console.log('Session started for user ID: " . $user['customer_id'] . "');</script>";

                        // Redirect to homepage after successful login
                       // header("Location: " . BASE_URL . "/index.php");
                       
                        // TEST: redirect to customer profile page
                        header("Location: " . BASE_URL . "/pages/customer-profile.php");

                        exit; // Stop the script after redirect
                    } else {
                        $loginError = 'Incorrect email or password. Please try again.';
                    }
                } else {
                    $loginError = 'No user found with that email address. Please try again.';
                }
                $stmt->close();
            }
        }
    ?>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/customer-styles.css" />
</head>
<body>

    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">

                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-start h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <h5 class="fw-bold">Hello There!</h5>
                                    </div>
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <small class="text-center fw-bold">Welcome 😊 you’ve been missed.<br />Please enter your data to log in.</small>
                                    </div>

                                    <!-- Success Message -->
                                    <div id="successMessage" class="alert alert-success d-none text-center" role="alert">
                                        Login successful! Redirecting...
                                    </div>

                                    <!-- Login Form -->
                                    <form class="mx-1 mx-md-4" action="customer-login.php" method="POST" id="login-form">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fa-solid fa-user fa-lg me-3"></i>
                                            <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" />
                                            <small><span id="emailError" class="error"><?php echo $emailError; ?></span><br></small>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-0">
                                            <i class="fa-solid fa-lock fa-lg me-3"></i>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
                                            <small><span id="passwordError" class="error"><?php echo $passwordError; ?></span><br></small>
                                        </div>

                                        <!-- Login Error -->
                                        <?php if ($loginError): ?>
                                            <div class="alert alert-danger mt-3 text-center" role="alert">
                                                <?php echo $loginError; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="d-flex flex-row justify-content-end mb-4">
                                            <small>
                                                <a href="#" class="text-muted text-decoration-none">
                                                    <i class="fa fa-question-circle me-2"></i>Forgot password?
                                                </a>
                                            </small>
                                        </div>

                                        <div class="d-grid gap-2 mb-4">
                                            <button type="submit" class="btn btn-dark btn-lg" id="loginButton">Login</button>
                                        </div>
                                    </form>

                                    <div class="d-flex justify-content-center mx-4 mb-1">
                                        <p class="text-muted">Don't have an account? <a href="<?php echo BASE_URL; ?>/pages/customer-register.php" class="text-decoration-none">Sign up</a></p>
                                    </div>

                                    <!-- Back to Home -->
                                    <div class="d-flex justify-content-center mx-4">
                                        <a href="<?php echo BASE_URL; ?>/index.php" class="btn btn-sm btn-secondary me-3">
                                            <i class="fa-solid fa-house"></i> Back to Home
                                        </a>
                                    </div>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="<?php echo BASE_URL; ?>/assets/images/login.png" class="img-fluid" alt="Sample image">
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

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Session Timeout Script: user automatically signed out after 5 seconds -->
    
</body>
</html>
