<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - VELVET VOGUE</title>

    <!-- head-link.php file -->
        <?php include_once('./includes/head-links.php'); ?>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./assets/css/home-styles.css">

</head>
<body>

    <!-- config.php file  -->
        <?php include_once('./config/config.php'); ?>

    <!-- Banner -->
    <div class="text-white p-2 text-center bg-black top-banner-sale">
        <small><a href="./pages/customer-register.php" class="text-decoration-none text-white">Sign up</a> and GET 10% off on your first order</small>
    </div>

    <!-- Header -->
        <?php include './includes/header.php'; ?>

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
        <?php include './includes/footer.php'; ?>

    <!-- Bootstrap JavaScript -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

</body>
</html>
