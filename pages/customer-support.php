<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Support - VELVET VOGUE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/home-styles.css">

</head>
<body>

    <!-- Header -->
    <div class="sticky-top top-0 left-0 w-full z-40 shadow-md">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="navbar-brand" href="../index.php"><span class="text-uppercase">velvet vogue</span></a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <div class="input-group">
                        <input class="form-control border-end-0 border" type="search" placeholder="Search" id="search-input">
                        <button class="btn bg-white border-start-0 border-bottom border ms-n5" type="submit">
                            <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                        </button>
                    </div>
                    <!-- Wishlist Icon with Tooltip -->
                    <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Wishlist">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-heart fa-lg text-white"></i>
                        </a>
                    </button>
                    <!-- Cart Icon with Tooltip -->
                    <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cart">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bag-shopping fa-lg text-white"></i>
                        </a>
                    </button>
                    <!-- Account Icon with Tooltip -->
                    <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Account">
                        <a class="nav-link" href="./pages/customer-login.php">
                            <i class="fa-solid fa-user fa-lg text-white"></i>
                        </a>
                    </button>
                </form>
            </div>
        </nav>

        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-secondary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center text-uppercase" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">new arrivals</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">best sellers</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="../categories/women/women.php">women</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="../categories/men/men.php">men</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">kids</a></small>
                        </li>
                        <!-- <li class="nav-item">
                            <small><a class="nav-link" href="#">HOME & DECOR</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">PERSONAL CARE</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">TRAVEL GEAR</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">MOTHER & BABYCARE</a></small>
                        </li> -->
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">gift cards</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link text-danger" href="#">promotions</a></small>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
    </div>
    <!-- End Header -->

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
