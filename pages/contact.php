<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - VELVET VOGUE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .contact-section {
            padding: 50px 0;
            background-color: #f8f9fa;
        }

        .contact-title {
            font-size: 2.5rem;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .contact-info {
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .contact-info p {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.8;
        }

        .contact-form .form-control {
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .contact-form button {
            background-color: #343a40;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .contact-form .invalid-feedback {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">VELVET VOGUE</a>
                
            </div>
        </nav>
    </header>

    <!-- Contact Us Section -->
    <section class="contact-section">
        <div class="container">
            <h2 class="contact-title">Contact Us</h2>
            
            <div class="row">
                <!-- Contact Info -->
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h4>Get in Touch</h4>
                        <p class="text-dark"><i class="fa-solid fa-location-dot me-2"></i> Colombo, Western 10012, SL</p>
                        <p><a href="mailto:info@velvetvogue.com" class="text-dark"><i class="fa-solid fa-envelope me-2"></i> info@velvetvogue.com</a></p>
                        <p><a href="tel:+940111234567" class="text-dark"><i class="fa-solid fa-phone me-2"></i> +94 (011) 123 4567</a></p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h4>Send Us a Message</h4>
                        <form id="contactForm" class="contact-form" novalidate>
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" required>
                                <div class="invalid-feedback">Please enter your name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" required>
                                <div class="invalid-feedback">Please enter a subject.</div>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="4" required></textarea>
                                <div class="invalid-feedback">Please enter your message.</div>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            <div id="successMessage" class="alert alert-success mt-4 d-none" role="alert">
                Thank you! Your message has been sent successfully.
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-white p-4 bg-dark mt-3">
        <div class="container d-flex flex-column align-items-center">
            <div class="row mt-3 justify-content-center text-center">
                <!-- Brand and Description -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">VELVET VOGUE</h6>
                    <p>Timeless fashion, modern luxury. Discover your style, crafted just for you.</p>
                </div>
                <!-- Quick Links -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Quick Links</h6>
                    <p><a href="../index.php" class="text-reset text-white">Home</a></p>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="text-center p-4">
            <small>© 2024 VELVET VOGUE All rights reserved.</small>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- JavaScript for Form Validation and Submission -->
    <script>
        (function() {
            'use strict';

            const form = document.getElementById('contactForm');
            const successMessage = document.getElementById('successMessage');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                if (form.checkValidity()) {
                    successMessage.classList.remove('d-none');
                    form.reset();

                    setTimeout(() => {
                        successMessage.classList.add('d-none');
                    }, 4000);
                }

                form.classList.add('was-validated');
            });
        })();
    </script>
</body>
</html>
