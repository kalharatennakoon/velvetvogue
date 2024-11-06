<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - VELVET VOGUE</title>

    <!-- config.php file  -->
        <?php include_once('../config/config.php'); ?>

    <!-- head-link.php file -->
        <?php include_once('../includes/head-links.php'); ?>

</head>
<body>

    <!-- Header -->
        <?php include '../includes/header.php'; ?>

    <!-- Content Section -->
    <div class="container mt-5">
        <div class="content-section">
            <h3>Terms and Conditions</h3>
            <p>Welcome to VELVET VOGUE! Please read our terms and conditions carefully before using our website or purchasing our products. These terms outline your rights and responsibilities while interacting with our website and services.</p>

            <h4>1. Introduction</h4>
            <p>These terms govern your use of our website and services. By using our site, you agree to comply with these terms and conditions. If you disagree with any part, please refrain from using our services.</p>

            <h4>2. Account Registration</h4>
            <p>To shop with us, you must create an account. Please ensure all provided information is accurate, complete, and updated as necessary. You are responsible for maintaining the confidentiality of your account information.</p>

            <h4>3. Order and Payment</h4>
            <ul>
                <li>All orders are subject to acceptance and availability.</li>
                <li>Payment must be completed at the time of order. We accept major credit/debit cards and other authorized payment methods.</li>
                <li>Once an order is confirmed, it cannot be modified. Please double-check your cart before proceeding.</li>
            </ul>

            <h4>4. Shipping and Delivery</h4>
            <p>We offer shipping within Colombo and selected areas. Delivery timeframes depend on the shipping method chosen at checkout. We strive to ensure timely deliveries, but cannot guarantee specific delivery dates.</p>

            <h4>5. Returns and Refunds</h4>
            <p>If you're not satisfied with your purchase, we offer a return policy. Please review the detailed return procedure on our website. Items must be returned in their original condition within 14 days for a refund or exchange.</p>

            <h4>6. Limitation of Liability</h4>
            <p>VELVET VOGUE is not responsible for any indirect, special, or consequential damages resulting from your use of our website or products. Our liability is limited to the purchase amount of the product in question.</p>

            <h4>7. Changes to Terms</h4>
            <p>We reserve the right to modify these terms at any time. Continued use of the website constitutes acceptance of any changes. Please check this page regularly for updates.</p>

            <h4>Contact Us</h4>
            <p>If you have any questions regarding our terms and conditions, please contact us at <strong>VELVET VOGUE, Colombo, Sri Lanka</strong>, or email us directly through our contact page.</p>
        </div>
    </div>

    <!-- Back to Top Button just above the footer -->
    <div class="back-to-top-container container">
        <button onclick="scrollToTop()" id="backToTopBtn" title="Go to top">
            <i class="fa-solid fa-arrow-up"></i>
        </button>
    </div>

    <!-- Footer -->
        <?php include '../includes/footer.php'; ?>

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
