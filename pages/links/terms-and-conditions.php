<?php 
    include_once('../../config/config.php'); 
    $page_title = 'Terms and Conditions';
    include_once('../../includes/head-links.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <style>
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
        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
            transition: all 0.2s ease-in-out;
        }
        #backToTopBtn {
            position: fixed; /* Position it relative to the viewport */
            bottom: 20px; /* Distance from the bottom */
            right: 20px; /* Distance from the right */
            background-color: #007bff; /* Bootstrap primary blue */
            color: white; /* White arrow color */
            border: none; /* Remove border */
            border-radius: 50%; /* Make it a circle */
            width: 30px; /* Button width */
            height: 30px; /* Button height */
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            cursor: pointer; /* Change cursor on hover */
            z-index: 1000; /* Ensure it stays above other elements */
            transition: all 0.3s ease-in-out; /* Smooth hover transition */
        }

        #backToTopBtn:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: translateY(-3px); /* Subtle upward movement */
        }

        #backToTopBtn:focus {
            outline: none; /* Remove focus outline */
        }

        .back-to-top-container i {
            font-size: 1.5rem; /* Adjust icon size */
        }
    </style>
</head>
<body>

    <!-- Header -->
    <?php include '../../includes/header.php'; ?>

    <div class="container mt-5">
        <div class="content-section">
            <h3 class="text-center mb-4">Terms and Conditions</h3>
            <p class="lead text-center">Welcome to <strong>VELVET VOGUE</strong>! Please read our terms and conditions carefully before using our website or purchasing our products. These terms outline your rights and responsibilities while interacting with our website and services.</p>
            
            <!-- Card 1: Introduction -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>1. Introduction</h4>
                </div>
                <div class="card-body">
                    <p>These terms govern your use of our website and services. By using our site, you agree to comply with these terms and conditions. If you disagree with any part, please refrain from using our services.</p>
                </div>
            </div>

            <!-- Card 2: Account Registration -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>2. Account Registration</h4>
                </div>
                <div class="card-body">
                    <p>To shop with us, you must create an account. Please ensure all provided information is accurate, complete, and updated as necessary. You are responsible for maintaining the confidentiality of your account information.</p>
                </div>
            </div>

            <!-- Card 3: Order and Payment -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>3. Order and Payment</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle"></i> All orders are subject to acceptance and availability.</li>
                        <li><i class="bi bi-check-circle"></i> Payment must be completed at the time of order. We accept major credit/debit cards and other authorized payment methods.</li>
                        <li><i class="bi bi-check-circle"></i> Once an order is confirmed, it cannot be modified. Please double-check your cart before proceeding.</li>
                    </ul>
                </div>
            </div>

            <!-- Card 4: Shipping and Delivery -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>4. Shipping and Delivery</h4>
                </div>
                <div class="card-body">
                    <p>We offer shipping within Colombo and selected areas. Delivery timeframes depend on the shipping method chosen at checkout. We strive to ensure timely deliveries, but cannot guarantee specific delivery dates.</p>
                </div>
            </div>

            <!-- Card 5: Returns and Refunds -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>5. Returns and Refunds</h4>
                </div>
                <div class="card-body">
                    <p>If you're not satisfied with your purchase, we offer a return policy. Please review the detailed return procedure on our website. Items must be returned in their original condition within 14 days for a refund or exchange.</p>
                </div>
            </div>

            <!-- Card 6: Limitation of Liability -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>6. Limitation of Liability</h4>
                </div>
                <div class="card-body">
                    <p>VELVET VOGUE is not responsible for any indirect, special, or consequential damages resulting from your use of our website or products. Our liability is limited to the purchase amount of the product in question.</p>
                </div>
            </div>

            <!-- Card 7: Changes to Terms -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>7. Changes to Terms</h4>
                </div>
                <div class="card-body">
                    <p>We reserve the right to modify these terms at any time. Continued use of the website constitutes acceptance of any changes. Please check this page regularly for updates.</p>
                </div>
            </div>

            <!-- Card 8: Contact Us -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Contact Us</h4>
                </div>
                <div class="card-body">
                    <p>If you have any questions regarding our terms and conditions, please contact us at <strong>VELVET VOGUE, Colombo, Sri Lanka</strong>, or email us directly through our contact page.</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Back to Top Button just above the footer -->
    <div class="back-to-top-container container text-center mt-5">
        <button onclick="scrollToTop()" id="backToTopBtn" title="Go to top">
            <i class="fa-solid fa-circle-arrow-up"></i>
        </button>
    </div>



    <!-- Footer -->
    <?php include '../../includes/footer.php'; ?>
    

    <!-- JavaScript for Back to Top Button -->
    <script>
        // Smooth scroll to top when the button is clicked
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
