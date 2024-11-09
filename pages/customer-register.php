<?php
    // Start session
    session_start();

    // Include config file for database connection
    include_once('../config/config.php'); 

    $page_title = 'Register';
    include_once('../includes/head-links.php');

    // Redirect to homepage if already logged in
    if (isset($_SESSION['customer_id'])) {
        echo "<script>console.log('User already logged in. Redirecting to home page.');</script>";
        header("location: " . BASE_URL . "/index.php");
        exit;
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Log POST data for debugging
        // echo "<script>console.log('POST Data: ', " . json_encode($_POST) . ");</script>";
        // Check if form inputs are set and not empty
        if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'])) {
            // Collect form inputs and Sanitize input data
            $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
            $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = $_POST['password'];
            $status = 'active'; // Default status
            $subscribeNewsletter = isset($_POST['newsletter']) ? 1 : 0; // 1 if subscribed, 0 if not

            // Basic validation
            if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
                echo "<script>console.error('All fields are required.');</script>";
                echo '<div class="alert alert-danger">All fields are required.</div>';
            } else {
                // Check if the email is already taken
                $checkEmail = $conn->prepare("SELECT email FROM customers WHERE email = ?");
                $checkEmail->bind_param("s", $email);
                $checkEmail->execute();
                $checkEmail->store_result();

                if ($checkEmail->num_rows > 0) {
                    echo "<script>console.error('Email is already registered.');</script>";
                    echo '<div class="alert alert-danger">Email is already registered. Please use a different email.</div>';
                } else {
                    // Hash the password before storing in the database
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    // Prepare SQL to insert the new customer
                    $sql = "INSERT INTO customers (first_name, last_name, email, password, status, newsletter_subscription) 
                            VALUES (?, ?, ?, ?, ?, ?)";

                    if ($stmt = $conn->prepare($sql)) {
                        // Bind parameters
                        $stmt->bind_param("sssssi", $firstName, $lastName, $email, $passwordHash, $status, $subscribeNewsletter);

                        // TEST: Log the input values to the console
                        echo "<script>
                            console.log('First Name: " . $firstName . "');
                            console.log('Last Name: " . $lastName . "');
                            console.log('Email: " . $email . "');
                            console.log('Password Hash: " . $passwordHash . "');
                            console.log('Status: " . $status . "');
                            console.log('Newsletter Subscription: " . $subscribeNewsletter . "');
                        </script>";

                        // Execute the query
                        if ($stmt->execute()) {
                            // Display success message
                            echo "<div id='successMessage' class='alert alert-success text-center' role='alert'>
                                Account successfully created! Redirecting to Login...
                            </div>";

                            // JavaScript for redirect after 2 seconds
                            echo "<script>
                                setTimeout(function() {
                                    const BASE_URL = '" . BASE_URL . "';
                                    window.location.href = BASE_URL + '/pages/customer-login.php'; // Redirect using BASE_URL
                                }, 2000);  // Delay redirect by 2 seconds to show success message
                            </script>";
                        } else {
                            // Log the error
                            echo "<script>console.error('Error executing the query: " . $stmt->error . "');</script>";
                            echo '<div class="alert alert-danger">Error executing the query: ' . $stmt->error . '</div>';
                        }

                        // Close statement
                        $stmt->close();
                    } else {
                        // Log the error
                        echo "<script>console.error('Error preparing query: " . $conn->error . "');</script>";
                        echo '<div class="alert alert-danger">Error preparing query: ' . $conn->error . '</div>';
                    }
                    $checkEmail->close();
                }
            }
        } else {
            echo "<script>console.error('Required POST fields not set.');</script>";
            echo '<div class="alert alert-danger">Required POST fields not set.</div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once('../includes/head-links.php'); ?>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/customer-styles.css" />
    
</head>
<body>

    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <section class="h-100 p-4">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-start h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Create Your Account</p>

                                    <!-- Success or Error Message -->
                                    <div id="successMessage" class="alert alert-success text-center" role="alert" style="display: none;"></div>
                                    <div id="errorMessage" class="alert alert-danger d-none text-center" role="alert"></div>

                                    <!-- Registration Form -->
                                    <form id="registration-form" method="POST">
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <div class="form-outline flex-fill mb-0 me-3">
                                                <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name" />
                                                <small><span class="error" id="firstNameError"></span><br></small>
                                            </div>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last Name" />
                                                <small><span class="error" id="lastNameError"></span><br></small>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="email" name="email" class="form-control" placeholder="Email" />
                                                <small><span class="error" id="emailError"></span><br></small>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
                                                <small><span class="error" id="passwordError"></span><br></small>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-5">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password" />
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
                                            <button type="submit" class="btn btn-dark btn-lg" id="registerButton">Register</button>
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


<!-- JavaScript validation for registration form -->
    <script>
        async function validateForm(event) {
            event.preventDefault();  // Prevent default form submission
            const isValid = validateFields(); // Check if fields are valid

            if (isValid) {
                // Show success message
                const successMessage = document.getElementById("successMessage");
                successMessage.classList.remove("d-none"); // Show the success message

                // Manually submit the form if valid - TEST
                document.getElementById("registration-form").submit();  // Submit the form

                // Redirect after a short delay (2 seconds)
                setTimeout(function() {
                    const BASE_URL = "<?php echo BASE_URL; ?>";  // Pass BASE_URL from PHP to JS
                    window.location.href = BASE_URL + '/pages/customer-login.php'; // Redirect using BASE_URL
                }, 2000); // 2000ms = 2 seconds

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
