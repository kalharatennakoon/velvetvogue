<?php
    include_once('../config/config.php');
    session_start();

    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
        exit;
    }

    $user_id = $_SESSION['user_id'];

    // Fetch existing user data
    $query = "SELECT * FROM customers WHERE customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();
    $stmt->close();

    // Initialize success and error messages
    $success = $error = '';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address_line_1 = $_POST['address_line_1'];
        $address_line_2 = $_POST['address_line_2'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $zip_code = $_POST['zip_code'];
        $newsletter_subscription = isset($_POST['newsletter']) ? 1 : 0;

        // Profile picture upload handling
        $customer_image_path = $customer['customer_image']; // Keep existing image if no new image is uploaded
        if (!empty($_FILES['profile_picture']['name'])) {
            $target_dir = "../assets/images/customer-images/";
            $image_file = $target_dir . basename($_FILES['profile_picture']['name']);
            $image_file_type = strtolower(pathinfo($image_file, PATHINFO_EXTENSION));

            // Check if the file is an image
            $check = getimagesize($_FILES['profile_picture']['tmp_name']);
            if ($check === false) {
                $error = "File is not an image.";
                error_log("File is not an image: " . $_FILES['profile_picture']['name']);
            }

            // Check file size (e.g., 5MB limit)
            if ($_FILES["profile_picture"]["size"] > 5000000) {
                $error = "Sorry, your file is too large.";
                error_log("File is too large: " . $_FILES['profile_picture']['size']);
            }

            // Allow certain file formats
            if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
                $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                error_log("Invalid file format: " . $_FILES['profile_picture']['name']);
            }

            if ($error == '') {
                // Try to upload file
                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $image_file)) {
                    $customer_image_path = "assets/images/customer-images/" . basename($_FILES['profile_picture']['name']);
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                    error_log("Error uploading file: " . $_FILES['profile_picture']['error']);
                }
            }
        }

        // Update query
        if ($error == '') {
            $query = "UPDATE customers SET first_name = ?, last_name = ?, email = ?, phone_number = ?, address_line_1 = ?, address_line_2 = ?, city = ?, province = ?, zip_code = ?, newsletter_subscription = ?, customer_image = ? WHERE customer_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssssssssssi", $first_name, $last_name, $email, $phone_number, $address_line_1, $address_line_2, $city, $province, $zip_code, $newsletter_subscription, $customer_image_path, $user_id);

            if ($stmt->execute()) {
                // Return the updated data in JSON format
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Profile updated successfully.',
                    'data' => [
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'phone_number' => $phone_number,
                        'address_line_1' => $address_line_1,
                        'address_line_2' => $address_line_2,
                        'city' => $city,
                        'province' => $province,
                        'zip_code' => $zip_code,
                        'newsletter_subscription' => $newsletter_subscription,
                        'customer_image' => $customer_image_path
                    ]
                ]);
            } else {
                // Log the error and return error message
                error_log("Error executing query: " . $stmt->error);
                echo json_encode(['status' => 'error', 'message' => 'Error updating profile.']);
            }
            $stmt->close();
        } else {
            // Return the error message
            echo json_encode(['status' => 'error', 'message' => $error]);
        }

        exit;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <?php include_once('../includes/head-links.php'); ?>
    <script>
        let isEditMode = false;

        function enableEdit() {
            // Enable form fields for editing
            document.querySelectorAll('.editable').forEach(input => input.disabled = false);
            document.getElementById('submit-btn').disabled = false;
            isEditMode = true;

            // Enable "Subscribe to Newsletter" checkbox only after Edit button click
            document.getElementById('newsletter').disabled = false;
        }

        function updateProfile(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(document.getElementById('profile-form'));

            // Send form data via AJAX to update profile
            fetch('customer-profile.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Server responded:", data);

                if (data.status === 'success') {
                    // Display success message
                    document.getElementById('response-message').innerHTML = `<div class="alert alert-success">${data.message}</div>`;

                    // Update the displayed values with the new data from the response
                    document.getElementById('first_name').value = data.data.first_name;
                    document.getElementById('last_name').value = data.data.last_name;
                    document.getElementById('email').value = data.data.email;
                    document.getElementById('phone_number').value = data.data.phone_number;
                    document.getElementById('address_line_1').value = data.data.address_line_1;
                    document.getElementById('address_line_2').value = data.data.address_line_2;
                    document.getElementById('city').value = data.data.city;
                    document.getElementById('province').value = data.data.province;
                    document.getElementById('zip_code').value = data.data.zip_code;
                    document.getElementById('newsletter').checked = data.data.newsletter_subscription == 1;
                    document.getElementById('profile_image').src = data.data.customer_image;
                } else {
                    // Display error message
                    document.getElementById('response-message').innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                }
            })
            .catch(error => {
                console.error("Error:", error);
                document.getElementById('response-message').innerHTML = `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
            });
        }
    </script>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <form action="customer-profile.php" method="post" enctype="multipart/form-data" id="profile-form">
            <h2>Edit Profile</h2>

            <!-- Success/Error messages -->
            <div id="response-message"></div>

            <!-- Form Fields -->
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control editable" value="<?php echo htmlspecialchars($customer['first_name'] ?? ''); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control editable" value="<?php echo htmlspecialchars($customer['last_name'] ?? ''); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control editable" value="<?php echo htmlspecialchars($customer['email'] ?? ''); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control editable" value="<?php echo htmlspecialchars($customer['phone_number'] ?? ''); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="address_line_1" class="form-label">Address Line 1</label>
                <input type="text" name="address_line_1" id="address_line_1" class="form-control editable" value="<?php echo htmlspecialchars($customer['address_line_1'] ?? ''); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="address_line_2" class="form-label">Address Line 2</label>
                <input type="text" name="address_line_2" id="address_line_2" class="form-control editable" value="<?php echo htmlspecialchars($customer['address_line_2'] ?? ''); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" id="city" class="form-control editable" value="<?php echo htmlspecialchars($customer['city'] ?? ''); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="province" class="form-label">Province</label>
                <select name="province" id="province" class="form-control editable" disabled>
                    <option value="">Select Province</option>
                    <?php
                    $provinces = ['Central', 'Eastern', 'North Central', 'Northern', 'North Western', 'Sabaragamuwa', 'Southern', 'Uva', 'Western'];
                    foreach ($provinces as $province) {
                        $selected = ($customer['province'] == $province) ? 'selected' : '';
                        echo "<option value=\"$province\" $selected>$province</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="zip_code" class="form-label">Zip Code</label>
                <input type="text" name="zip_code" id="zip_code" class="form-control editable" value="<?php echo htmlspecialchars($customer['zip_code'] ?? ''); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="newsletter" class="form-label">Subscribe to Newsletter</label>
                <input type="checkbox" name="newsletter" id="newsletter" class="form-check-input" <?php echo ($customer['newsletter_subscription'] == 1) ? 'checked' : ''; ?> disabled>
            </div>
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                <img id="profile_image" src="<?php echo $customer['customer_image']; ?>" alt="Profile Picture" width="100" height="100">
            </div>

            <!-- Submit Button -->
            <button type="button" id="submit-btn" class="btn btn-primary" disabled onclick="updateProfile(event)">Update Profile</button>

            <!-- Edit Button -->
            <button type="button" class="btn btn-warning" onclick="enableEdit()">Edit</button>
        </form>
    </div>

    <?php include_once('../includes/footer.php'); ?>
</body>
</html>
