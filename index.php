<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include_once('./config/config.php'); 
        $page_title = 'Home'; 
        include_once('./includes/head-links.php'); 
    ?>
    <link rel="stylesheet" type="text/css" href="./assets/css/home-styles.css">
</head>
<body>

    <div class="text-white p-2 text-center bg-black top-banner-sale">
        <small><a href="<?php echo BASE_URL; ?>/pages/customer-register.php" class="text-decoration-none text-white">Sign up</a> and GET 10% off on your first order</small>
    </div>

    <?php include './includes/header.php'; ?>

    <div class="min-h-screen overflow-x-hidden d-flex justify-content-center align-items-center">
        <div id="carouselExampleIndicators" class="carousel carousel-dark slide mt-5" data-bs-ride="carousel">
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <img src="<?php echo BASE_URL; ?>/assets/images/image01.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="<?php echo BASE_URL; ?>/assets/images/image02.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="<?php echo BASE_URL; ?>/assets/images/image03.png" class="d-block w-100" alt="...">
                </div>
            </div>

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

    <?php include './includes/footer.php'; ?>
</body>
</html>
