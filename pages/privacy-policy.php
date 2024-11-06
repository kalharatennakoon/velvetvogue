<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - VELVET VOGUE</title>

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
            <h3>Privacy Policy</h3>
            <p>At VELVET VOGUE, we respect your privacy and are committed to protecting your personal information. This policy outlines how we handle your personal data.</p>

            <h4>1. Information Collection</h4>
            <p>We collect information you provide directly to us, including when you create an account, make a purchase, or contact us. This may include your name, email, address, phone number, and payment information.</p>

            <h4>2. How We Use Your Information</h4>
            <ul>
                <li>To process transactions and fulfill orders.</li>
                <li>To communicate with you regarding your orders or inquiries.</li>
                <li>To improve our products, services, and website experience.</li>
            </ul>

            <h4>3. Data Security</h4>
            <p>We implement security measures to safeguard your data. However, no internet transmission is entirely secure, and we cannot guarantee absolute security.</p>

            <h4>4. Sharing Information</h4>
            <p>We do not sell your personal information. We may share it with trusted service providers only for business purposes or if required by law.</p>

            <h4>5. Changes to the Policy</h4>
            <p>We may update this policy as needed. Significant changes will be communicated via email or our website.</p>

            <h4>Contact Us</h4>
            <p>If you have questions or concerns, please contact us at <strong>VELVET VOGUE, Colombo, Sri Lanka</strong>.</p>
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


    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
