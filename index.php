<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - VELVET VOGUE</title>

    <!-- add icon link -->
    <link rel="icon" href="./assets/images/logo.png" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./assets/css/home-styles.css">


</head>
<body>

    <!-- Banner -->
    <div class="text-white p-2 text-center bg-black top-banner-sale">
        <small><a href="./pages/customer-register.php" class="text-decoration-none text-white">Sign up</a> and GET 10% off on your first order</small>
    </div>

    <!-- Header -->
    <div class="sticky-top top-0 left-0 w-full z-40 shadow-md">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="navbar-brand" href="index.php">VELVET VOGUE</a>
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
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">NEW ARRIVALS</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">BEST SELLERS</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">WOMEN</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">MEN</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">KIDS</a></small>
                        </li>
                        <li class="nav-item">
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
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">GIFT CARDS</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link text-danger" href="#">SALE</a></small>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
    </div>

    <!-- Section: Carousel -->
    <div class="min-h-screen overflow-x-hidden d-flex justify-content-center align-items-center">
        <div id="carouselExampleIndicators" class="carousel carousel-dark slide mt-5" data-bs-ride="carousel">
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <!-- Image Sliders -->
            <div class="carousel-inner">
                <!-- Image one-->
                <div class="carousel-item active" data-bs-interval="3000">
                    <img src="./assets/images/image01.png" class="d-block w-100" alt="...">
                </div>
                <!-- image two -->
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="./assets/images/image02.png" class="d-block w-100" alt="...">
                </div>
                <!-- Image Three -->
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="./assets/images/image03.png" class="d-block w-100" alt="...">
                </div>
            </div>

            <!-- Carousel Controls -->
            <section>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </section>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white bg-dark text-center text-lg-start p-4">
        <section>
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <!-- Company Info -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">VELVET VOGUE</h6>
                        <p>Timeless fashion, modern luxury. Discover your style, crafted just for you.</p>
                    </div>

                    <!-- About Us Links -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">About Us</h6>
                        <p><a href="./pages/privacy-policy.php" class="text-white">Privacy Policy</a></p>
                        <p><a href="./pages/terms-and-conditions.php" class="text-white">Terms and Conditions</a></p>
                        <p><a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#subscribeModal">Subscribe to Newsletter</a></p>
                    </div>

                    <!-- Useful Links -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">Useful Links</h6>
                        <p><a href="./pages/faq.php" class="text-white">FAQ</a></p>
                        <p><a href="./pages/contact.php" class="text-white">Contact Us</a></p>
                    </div>

                   <!-- Contact Info -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold">Contact</h6>
                        <p><i class="fa-solid fa-location-dot me-2"></i> Colombo, Western 10012, SL</p>
                        <p>
                            <a href="mailto:info@velvetvogue.com" class="text-white">
                                <i class="fa-solid fa-envelope me-2"></i> info@velvetvogue.com
                            </a>
                        </p>
                        <p>
                            <a href="tel:+94111234567" class="text-white">
                                <i class="fa-solid fa-phone me-2"></i> +94 (011) 123 4567
                            </a>
                        </p>
                        <!-- Social Media Icons -->
                        <div class="mt-2">
                            <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Copyright -->
    <div class="text-center text-white mt-3 p-3 bg-dark">
        <small>© 2024 VELVET VOGUE All rights reserved. Powered by KT</small>
    </div>

    <!-- Subscribe Modal -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title" id="subscribeModalLabel">Subscribe to our Newsletter</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Stay updated with the latest trends and offers.</p>
                    <form id="subscribeForm">
                        <div class="mb-3">
                            <label for="subscribeEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="subscribeEmail" placeholder="Enter your email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                    <div id="subscribeSuccessMessage" class="alert alert-success mt-3 d-none">
                        Thank you for subscribing!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for Subscription Form -->
    <script>
        document.getElementById("subscribeForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const email = document.getElementById("subscribeEmail").value;
            
            if (email) {
                document.getElementById("subscribeSuccessMessage").classList.remove("d-none");
                document.getElementById("subscribeForm").reset();
                
                setTimeout(() => {
                    document.getElementById("subscribeSuccessMessage").classList.add("d-none");
                    const subscribeModal = bootstrap.Modal.getInstance(document.getElementById("subscribeModal"));
                    subscribeModal.hide();
                }, 3000);
            }
        });
    </script>


    <!-- Initialize Tooltips with JavaScript -->
    <script>
        // Initialize all tooltips on the page
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>


</body>
</html>
