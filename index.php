<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - VELVET VOGUE</title>

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
        <small>Sign up and GET 10% off on your first order</small>
    </div>

    <!-- Header -->
    <div class="sticky-top top-0 left-0 w-full z-40 shadow-md">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <span class="navbar-brand mb-0 h1">VELVET VOGUE</span>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <div class="input-group">
                        <input class="form-control border-end-0 border" type="search" placeholder="Search" id="search-input">
                        <button class="btn bg-white border-start-0 border-bottom border ms-n5" type="submit">
                            <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                        </button>
                    </div>
                    <button class="btn" type="button">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-heart fa-lg text-white"></i>
                        </a>
                    </button>
                    <button class="btn" type="button">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bag-shopping fa-lg text-white"></i>
                        </a>
                    </button>
                    <button class="btn" type="button">
                        <a class="nav-link" href="./pages/customer-login.php">
                            <i class="fa-solid fa-user fa-lg text-white"></i>
                        </a>
                    </button>
                </form>
            </div>
        </nav>

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
    <footer class="text-center text-lg-start bg-body-tertiary text-muted p-4">
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <figure>
                            <blockquote class="blockquote">
                                <p class="text-uppercase">Velvet Vogue</p>
                            </blockquote>
                            <figcaption class="blockquote-footer">
                                <cite>Timeless fashion, modern luxury. <br />Discover your style, crafted just for you.</cite>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <small>
                            <h6 class="text-uppercase fw-bold mb-4">About Us</h6>
                            <p><a href="./pages/privacy-policy.php" class="text-reset">Privacy Policy</a></p>
                            <p><a href="./pages/terms-and-conditions.php" class="text-reset">Terms and Conditions</a></p>
                            <p><a href="./pages/subscribe.php" class="text-reset">Subscribe to Newsletter</a></p>
                        </small>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <small>
                            <h6 class="text-uppercase fw-bold mb-4">Useful links</h6>
                            <p><a href="#!" class="text-reset">FAQ</a></p>
                            <p><a href="#!" class="text-reset">Blog</a></p>
                            <p><a href="#!" class="text-reset">Help</a></p>
                        </small>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <small>
                            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                            <!-- Social media: start -->
                            <p>
                                <a href="#" class="text-reset me-4"><i class="fa-brands fa-facebook fa-lg"></i></a>
                                <a href="#" class="text-reset me-4"><i class="fa-brands fa-twitter fa-lg"></i></a>
                                <a href="#" class="text-reset me-4"><i class="fa-brands fa-instagram fa-lg"></i></a>
                                <a href="#" class="text-reset me-4"><i class="fa-brands fa-tiktok fa-lg"></i></a>
                            </p>
                            <!-- Social media: end -->
                            <p><i class="fa-solid fa-location-dot fa-lg me-3"></i>Colombo, Western 10012, SL</p>
                            <p><i class="fa-solid fa-envelope fa-lg me-3"></i>info@velvetvogue.com</p>
                            <p><i class="fa-solid fa-phone fa-lg me-3"></i>+94 (011) 123 4567</p>
                        </small>
                    </div>
                </div>
            </div>
        </section>
    
        <!-- Copyright: start -->
        <div class="text-center text-dark p-4 bg-body-tertiary">
            <small>© 2024 VELVET VOGUE All rights reserved. Powered by KT</small>
        </div>
        <!-- Copyright: end -->

    </footer>



    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php
        // echo "Hey";
    ?>

</body>
</html>
