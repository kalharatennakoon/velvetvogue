<?php 
    include_once('../../config/config.php'); 
    $page_title = 'Product Inquiry';
    include_once('../../includes/head-links.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <style>
        body {
            background-color: #eee;
        }
        .top-banner-sale{
            height: 40px;
        }
        .navbar-secondary {
            border-bottom: 1px solid #ddd; /* Light gray border at the bottom */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }
        .carousel {
            max-width: 800px; 
            margin: auto; 
        }
    </style>
</head>
<body>

    <!-- Header -->
        <?php include '../../includes/header.php'; ?>

    <!-- Main Content -->
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="p-4 rounded shadow-sm bg-white" style="max-width: 500px; width: 100%;">
            <h2 class="text-center mb-3 fw-bold">Product Inquiry</h2>
            <p class="text-center mb-4 text-muted">Inquire about your product delivery or tracking details below.</p>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $orderNumber = htmlspecialchars($_POST['orderNumber']);
                $email = htmlspecialchars($_POST['email']);
                $inquiry = htmlspecialchars($_POST['inquiry']);
                echo "<div class='alert alert-success text-center'>Thank you for your inquiry! We will get back to you regarding Order #$orderNumber soon.</div>";
            }
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="orderNumber" class="form-label">Order Number</label>
                    <input type="text" class="form-control" id="orderNumber" name="orderNumber" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="inquiry" class="form-label">Inquiry Details</label>
                    <textarea class="form-control" id="inquiry" name="inquiry" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-dark w-100">Submit</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
        <?php include '../../includes/footer.php'; ?>
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
