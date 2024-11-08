<?php
// Include database connection and other necessary files
include_once('../config/config.php');

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

    // Handle image upload if a new image is selected
    $image_uploaded = false;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        // Debug: Print file details to the console
        echo "<script>console.log('File details: ', " . json_encode($_FILES['profile_image']) . ");</script>";

        // Validate image type (allow jpg, png, gif)
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['profile_image']['type'], $allowed_types)) {
            echo "<script>console.error('Invalid file type. Only JPG, PNG, GIF allowed.');</script>";
            exit;
        }

        // Define upload directory and ensure it's correct
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/velvetvogue/assets/images/customer-images/";
        
        // Generate a new filename using the customer_id and email
        $file_extension = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
        $new_file_name = 'profile_pic_' . $user_id . '_' . strtolower(str_replace('@', '_', $user['email'])) . '.' . $file_extension;
        $target_file = $target_dir . $new_file_name;

        // Move uploaded file to the directory
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            echo "<script>console.log('Image uploaded successfully to: " . $target_file . "');</script>";
            $image_uploaded = true;
        } else {
            echo "<script>console.error('Image upload failed. Ensure permissions are set for " . $target_dir . ".');</script>";
            $error = 'Image upload failed. Please try again later.';
        }
    }


    // If no image was uploaded, use the current one
    $profile_image = $image_uploaded ? $new_file_name : $user['customer_image'];

    // Update user details in the database
    if (empty($error)) {
        $query = "UPDATE customers SET first_name = ?, last_name = ?, email = ?, phone_number = ?, address_line_1 = ?, address_line_2 = ?, city = ?, province = ?, zip_code = ?, customer_image = ? WHERE customer_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssssi", $first_name, $last_name, $email, $phone_number, $address_line_1, $address_line_2, $city, $province, $zip_code, $profile_image, $user_id);
        $stmt->execute();
        $stmt->close();

        // If successful, update the session with new data
        $_SESSION['user_email'] = $email;

        // Success message
        $updateSuccess = 'Profile updated successfully.';

        // Refresh the page to reflect changes
        header("Location: " . BASE_URL . "/pages/customer-profile.php");
        exit;
    } else {
        // Error message if something went wrong with image upload or any other issue
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
    <script>
        function enableEdit() {
            let elements = document.querySelectorAll(".profile-input");
            elements.forEach(el => el.disabled = false);
            document.getElementById("updateButton").disabled = false;
            document.getElementById("editButton").disabled = true;
        }

        function checkChanges() {
            document.getElementById("updateButton").disabled = false;
        }
    </script>
</head>
<body>
    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <section class="profile-section">
        <div class="container">
            <h2>Customer Profile</h2>
            
            <!-- Success/Error Messages -->
            <?php if ($updateSuccess): ?>
                <div class="alert alert-success"><?php echo $updateSuccess; ?></div>
            <?php elseif ($updateError): ?>
                <div class="alert alert-danger"><?php echo $updateError; ?></div>
            <?php endif; ?>

            <form action="customer-profile.php" method="POST" enctype="multipart/form-data">
                <div class="profile-container">
                    <div class="profile-image">
                    <img src="<?php echo BASE_URL; ?>/assets/images/customer-images/<?php echo htmlspecialchars($user['customer_image'] ?: 'default.jpg'); ?>" alt="Profile Picture">
                    <label>Profile Picture</label>
                        <input type="file" name="profile_image" class="profile-input" disabled>
                    </div>
                    
                    <!-- Profile Details -->
                    <label>First Name</label>
                    <input type="text" name="first_name" class="profile-input" value="<?php echo htmlspecialchars($user['first_name']); ?>" disabled required oninput="checkChanges()">
                    
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="profile-input" value="<?php echo htmlspecialchars($user['last_name']); ?>" disabled required oninput="checkChanges()">
                    
                    <label>Email</label>
                    <input type="email" name="email" class="profile-input" value="<?php echo htmlspecialchars($user['email']); ?>" disabled required oninput="checkChanges()">
                    
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="profile-input" value="<?php echo htmlspecialchars($user['phone_number']); ?>" disabled oninput="checkChanges()">
                    
                    <label>Address Line 1</label>
                    <input type="text" name="address_line_1" class="profile-input" value="<?php echo htmlspecialchars($user['address_line_1']); ?>" disabled oninput="checkChanges()">
                    
                    <label>Address Line 2</label>
                    <input type="text" name="address_line_2" class="profile-input" value="<?php echo htmlspecialchars($user['address_line_2']); ?>" disabled oninput="checkChanges()">
                    
                    <label>City</label>
                    <input type="text" name="city" class="profile-input" value="<?php echo htmlspecialchars($user['city']); ?>" disabled oninput="checkChanges()">
                    
                    <label>Province</label>
                    <select name="province" class="profile-input" disabled oninput="checkChanges()">
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
                    
                    <label>Zip Code</label>
                    <input type="text" name="zip_code" class="profile-input" value="<?php echo htmlspecialchars($user['zip_code']); ?>" disabled oninput="checkChanges()">
                    
                    <label>
                        <input type="checkbox" name="newsletter_subscription" class="profile-input" <?php echo $user['newsletter_subscription'] ? "checked" : ""; ?> disabled>
                        Subscribe to Newsletter
                    </label>
                    
                    <!-- Buttons -->
                    <button type="button" id="editButton" onclick="enableEdit()">Edit Profile</button>
                    <button type="submit" id="updateButton" class="btn btn-dark" disabled>Update Profile</button>
                    <a href="logout.php" class="btn btn-danger">Log Out</a>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>
</body>
</html>
