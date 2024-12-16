<?php 
    include_once('../../config/config.php'); 
    $page_title = 'Customer Support';
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


    <!-- Customer Support Section -->
    <section class="customer-support-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold">Customer Support</h2>
            <p class="text-center mb-4 text-muted">Have questions or need help? Fill out the form below, and our team will be happy to assist you.</p>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);
                $subject = htmlspecialchars($_POST['subject']);
                $message = htmlspecialchars($_POST['message']);

                // Process the data, e.g., save to database, send email, etc.
                // Display a success message after form submission
                echo "<div class='alert alert-success text-center'>Thank you, $name! Your message has been sent successfully.</div>";
            }
            ?>

            <div class="row">
                <!-- Contact Info -->
                <div class="col-lg-5 mb-4">
                    <div class="contact-info p-4 bg-white rounded shadow-sm">
                        <h4 class="fw-semibold mb-3">Get in Touch</h4>
                        <p class="text-muted mb-2"><i class="fas fa-map-marker-alt me-2"></i>Colombo, Western 10012, SL</p>
                        <p class="text-muted mb-2"><i class="fas fa-envelope me-2"></i><a href="mailto:info@velvetvogue.com" class="text-decoration-none text-dark">info@velvetvogue.com</a></p>
                        <p class="text-muted"><i class="fas fa-phone-alt me-2"></i><a href="tel:+940111234567" class="text-decoration-none text-dark">+94 (011) 123 4567</a></p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h4 class="fw-semibold mb-4">Send Us a Message</h4>
                        <form method="POST" action="customer-support.php" id="contactForm" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">Please enter your name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                                <div class="invalid-feedback">Please enter a subject.</div>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                <div class="invalid-feedback">Please enter your message.</div>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
        <?php include '../../includes/footer.php'; ?>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Add Bootstrap validation style to form -->
    <script>
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

</body>
</html>
