<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - VELVET VOGUE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <style>
        .contact-section {
            padding: 50px;
            background-color: #f8f9fa;
        }
        .contact-title {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">VELVET VOGUE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="faq.php">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="contact.php">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contact Us Section -->
    <section class="contact-section">
        <div class="container">
            <h2 class="contact-title">Contact Us</h2>

            <!-- Contact Form -->
            <form id="contactForm" novalidate>
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" required>
                    <div class="invalid-feedback">
                        Please enter your name.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" required>
                    <div class="invalid-feedback">
                        Please enter a subject.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" rows="4" required></textarea>
                    <div class="invalid-feedback">
                        Please enter your message.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>

            <!-- Success Message -->
            <div id="successMessage" class="alert alert-success mt-4 d-none" role="alert">
                Thank you! Your message has been sent successfully.
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted p-4">
        <div class="container text-center text-md-start">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">VELVET VOGUE</h6>
                    <p>Timeless fashion, modern luxury. Discover your style, crafted just for you.</p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Quick Links</h6>
                    <p><a href="../index.php" class="text-reset">Home</a></p>
                    <p><a href="faq.php" class="text-reset">FAQ</a></p>
                    <p><a href="contact.php" class="text-reset">Contact Us</a></p>
                </div>
            </div>
        </div>
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

            // Fetch form and apply Bootstrap validation style
            const form = document.getElementById('contactForm');
            const successMessage = document.getElementById('successMessage');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                // Check form validity
                if (form.checkValidity()) {
                    successMessage.classList.remove('d-none'); // Show success message
                    form.reset(); // Reset form fields

                    // Hide success message after a few seconds
                    setTimeout(() => {
                        successMessage.classList.add('d-none');
                    }, 4000);
                }
                
                form.classList.add('was-validated'); // Add Bootstrap validation classes
            });
        })();
    </script>
</body>
</html>
