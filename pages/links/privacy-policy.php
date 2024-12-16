<?php 
    include_once('../../config/config.php'); 
    $page_title = 'Privacy Policy';
    include_once('../../includes/head-links.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
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

    <!-- Header -->
    <?php include '../../includes/header.php'; ?>


    <!-- Content Section -->

    <div class="container mt-5">
        <div class="content-section">
            <h3 class="text-center mb-4">Privacy Policy</h3>
            
            <!-- Card 1: Information Collection -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>1. Information Collection</h4>
                </div>
                <div class="card-body">
                    <p>We collect information you provide directly to us, including when you create an account, make a purchase, or contact us. This may include your name, email, address, phone number, and payment information.</p>
                </div>
            </div>

            <!-- Card 2: How We Use Your Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>2. How We Use Your Information</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li><i class="bi bi-check-circle"></i> To process transactions and fulfill orders.</li>
                        <li><i class="bi bi-check-circle"></i> To communicate with you regarding your orders or inquiries.</li>
                        <li><i class="bi bi-check-circle"></i> To improve our products, services, and website experience.</li>
                    </ul>
                </div>
            </div>

            <!-- Card 3: Data Security -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>3. Data Security</h4>
                </div>
                <div class="card-body">
                    <p>We implement security measures to safeguard your data. However, no internet transmission is entirely secure, and we cannot guarantee absolute security.</p>
                </div>
            </div>

            <!-- Card 4: Sharing Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>4. Sharing Information</h4>
                </div>
                <div class="card-body">
                    <p>We do not sell your personal information. We may share it with trusted service providers only for business purposes or if required by law.</p>
                </div>
            </div>

            <!-- Card 5: Changes to the Policy -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>5. Changes to the Policy</h4>
                </div>
                <div class="card-body">
                    <p>We may update this policy as needed. Significant changes will be communicated via email or our website.</p>
                </div>
            </div>

            <!-- Card 6: Contact Us -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Contact Us</h4>
                </div>
                <div class="card-body">
                    <p>If you have questions or concerns, please contact us at <strong>VELVET VOGUE, Colombo, Sri Lanka</strong>.</p>
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


    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
