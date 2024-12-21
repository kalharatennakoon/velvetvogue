<?php
    // Include database connection and other necessary files
    include_once('../config/config.php');

    // Start output buffering to prevent header issues
    ob_start();

    // Define constants for project root and customer image path if not already defined
    if (!defined('PROJECT_ROOT')) {
        define('PROJECT_ROOT', dirname(__DIR__));
    }
    if (!defined('CUSTOMER_IMAGE_PATH')) {
        define('CUSTOMER_IMAGE_PATH', 'uploads/customers');
    }

    // Start session to check user login status
    session_start();
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        // Redirect to login if user is not logged in
        header('Location: ' . BASE_URL . '/pages/customer-login.php');
        exit;
    }

    // Get the logged-in user's ID
    $user_id = $_SESSION['user_id'];

    // Fetch the current user details from the database
    $query = "SELECT * FROM customers WHERE customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // Initialize error and success message variables
    $error = '';
    $updateSuccess = '';
    $updateError = '';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $phone_number = trim($_POST['phone_number']);
        $address_line_1 = trim($_POST['address_line_1']);
        $address_line_2 = trim($_POST['address_line_2']);
        $city = trim($_POST['city']);
        $province = trim($_POST['province']);
        $zip_code = trim($_POST['zip_code']);
        $newsletter_subscription = isset($_POST['newsletter_subscription']) ? 1 : 0;

        // Handle image upload if a new image is selected
        $image_uploaded = false;
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['profile_image']['type'], $allowed_types)) {
                $error = 'Invalid file type. Only JPG, PNG, and GIF are allowed.';
            } else {
                $target_dir = PROJECT_ROOT . "/" . CUSTOMER_IMAGE_PATH . "/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                $file_extension = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
                $random_string = substr(md5(uniqid(mt_rand(), true)), 0, 6);
                $new_file_name = 'profile_pic_' . $user_id . '_' . strtolower(str_replace('@', '_', $user['email'])) . '_' . $random_string . '.' . $file_extension;
                $target_file = $target_dir . $new_file_name;

                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
                    // Image is uploaded successfully
                    $image_uploaded = true;
                    echo "Image uploaded successfully to: " . $target_file . "<br>";
                } else {
                    $error = 'Failed to upload image. Please try again.';
                    echo "Image upload failed.<br>";
                }
            }
        }

        // If an image was uploaded, update the image name for the database query
        $profile_image = $image_uploaded ? $new_file_name : $user['customer_image'];

        if (empty($error)) {
            // Prepare the SQL query for updating user profile details
            $query = "UPDATE customers SET first_name = ?, last_name = ?, email = ?, phone_number = ?, address_line_1 = ?, address_line_2 = ?, city = ?, province = ?, zip_code = ?, customer_image = ?, newsletter_subscription = ? WHERE customer_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssssssssii", $first_name, $last_name, $email, $phone_number, $address_line_1, $address_line_2, $city, $province, $zip_code, $profile_image, $newsletter_subscription, $user_id);

            // Execute the query
            if ($stmt->execute()) {
                // Debugging: Ensure the profile image is updated
                echo "Database update successful.<br>";
                // Update session and success message
                $_SESSION['user_email'] = $email;
                $updateSuccess = 'Profile updated successfully.';

                // Redirect to customer profile page to reflect changes
                header("Location: " . BASE_URL . "/pages/customer-profile.php");
                exit;
            } else {
                // Set error message if update fails
                $updateError = 'Failed to update profile. Please try again later.';
                echo "Database update failed.<br>";
            }
            $stmt->close();
        } else {
            // Set the error message if there is an issue with the upload or form data
            $updateError = $error;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
        $page_title = 'Customer Profile';
        include_once('../includes/head-links.php');
    ?>

    <!-- CSS links -->
    <link rel="stylesheet" type="text/css" href="../assets/css/customer-profile.css">

    <script>
        function toggleProfileInputs(disable) {
            document.querySelectorAll(".profile-input").forEach(el => el.disabled = disable);
            document.getElementById("updateButton").disabled = disable;
            document.getElementById("editButton").disabled = !disable;
        }
    </script>
</head>
<body>
    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <!-- Log Out Button -->
    <div class="logout-button">
        <a href="logout.php" class="btn btn-outline-danger">Log Out</a>
    </div>

    <section class="profile-section py-5">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="card">
                        <div class="card-body p-md-5">
                            <h2 class="text-center mb-4 fw-bold">My Profile</h2>
                            
                            <?php if ($updateSuccess): ?>
                                <div class="alert alert-success"><?php echo $updateSuccess; ?></div>
                            <?php elseif ($updateError): ?>
                                <div class="alert alert-danger"><?php echo $updateError; ?></div>
                            <?php endif; ?>

                            <form action="customer-profile.php" method="POST" enctype="multipart/form-data">
                                <div class="profile-container">
                                    <div class="text-center mb-4">
                                        <img src="<?php echo BASE_URL . '/' . CUSTOMER_IMAGE_PATH . '/' . htmlspecialchars($user['customer_image'] ?: 'default.jpg'); ?>" alt="Profile Picture" class="rounded-circle img-thumbnail mb-3">
                                        <label class="form-label d-block fw-semibold">Profile Picture</label>
                                        <input type="file" name="profile_image" class="form-control profile-input" disabled onchange="checkChanges()">
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="first_name" class="form-control profile-input" value="<?php echo htmlspecialchars($user['first_name']); ?>" disabled required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" name="last_name" class="form-control profile-input" value="<?php echo htmlspecialchars($user['last_name']); ?>" disabled required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control profile-input" value="<?php echo htmlspecialchars($user['email']); ?>" disabled required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control profile-input" value="<?php echo htmlspecialchars($user['phone_number']); ?>" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Address Line 1</label>
                                        <input type="text" name="address_line_1" class="form-control profile-input" value="<?php echo htmlspecialchars($user['address_line_1']); ?>" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Address Line 2</label>
                                        <input type="text" name="address_line_2" class="form-control profile-input" value="<?php echo htmlspecialchars($user['address_line_2']); ?>" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="form-control profile-input" value="<?php echo htmlspecialchars($user['city']); ?>" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Province</label>
                                        <select name="province" class="form-select profile-input" disabled>
                                            <option value="">Select Province</option>
                                            <?php
                                                $provinces = ['Central', 'Eastern', 'North Central', 'Northern', 'North Western', 'Sabaragamuwa', 'Southern', 'Uva', 'Western'];
                                                foreach ($provinces as $province) {
                                                    echo "<option value=\"$province\"";
                                                    echo $user['province'] == $province ? " selected" : "";
                                                    echo ">$province</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Zip Code</label>
                                        <input type="text" name="zip_code" class="form-control profile-input" value="<?php echo htmlspecialchars($user['zip_code']); ?>" disabled>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" name="newsletter_subscription" class="form-check-input profile-input" <?php echo $user['newsletter_subscription'] ? "checked" : ""; ?> disabled>
                                        <label class="form-check-label">Subscribe to Newsletter</label>
                                    </div>

                                    <div class="d-grid gap-2 mb-4">
                                        <button type="button" class="btn btn-outline-primary btn-lg" id="editButton" onclick="toggleProfileInputs(false)">Edit Profile</button>
                                        <button type="submit" class="btn btn-primary btn-lg" id="updateButton" disabled>Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

    <script>
        function enableEdit() {
            const inputs = document.querySelectorAll('.profile-input');
            inputs.forEach(input => input.disabled = false);
            document.getElementById('updateButton').disabled = false;
        }

    </script>
</body>
</html>


