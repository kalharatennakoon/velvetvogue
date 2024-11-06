<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women's Category - Velvet Vogue</title>

    <!-- add icon link -->
    <link rel="icon" href="./assets/images/logo.png" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    
    <!-- Custom CSS -->
    <style>
        .category-section {
            padding: 50px 0;
        }
        .category-card {
            transition: transform 0.3s;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .category-card:hover {
            transform: scale(1.05);
        }
        .category-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="sticky-top top-0 left-0 w-full z-40 shadow-md">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="navbar-brand" href="../../index.php">VELVET VOGUE</a>
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
                            <small><a class="nav-link" href="../men/men.php">MEN</a></small>
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
    <!-- End Header -->

    <!-- Main Content -->
    <section class="category-section">
        <div class="container">
            <h2 class="text-center mb-5">Women's Categories</h2>
            <div class="row justify-content-center">
                <!-- Men Casual Wear Card -->
                <div class="col-md-4 mb-4">
                    <a href="casual-wear/casual-wear.php" class="text-decoration-none">
                        <div class="category-card p-4 text-center">
                            <div class="category-title">Casual Wear</div>
                            <p>Explore our selection of casual wear for women.</p>
                        </div>
                    </a>
                </div>
                <!-- Men Formal Wear Card -->
                <div class="col-md-4 mb-4">
                    <a href="formal-wear/formal-wear.php" class="text-decoration-none">
                        <div class="category-card p-4 text-center">
                            <div class="category-title">Formal Wear</div>
                            <p>Discover our range of formal wear for women.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-white p-4 bg-dark mt-3">
        <div class="container d-flex flex-column align-items-center">
            <div class="row mt-3 justify-content-center text-center">
                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">VELVET VOGUE</h6>
                    <p>Timeless fashion, modern luxury. Discover your style, crafted just for you.</p>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Quick Links</h6>
                    <p><a href="../../index.php" class="text-reset text-white">Home</a></p>
                    <p><a href="../../pages/contact.php" class="text-reset text-white">Contact Us</a></p>
                </div>
            </div>
        </div>
        <div class="text-center p-4">
            <small>© 2024 VELVET VOGUE All rights reserved.</small>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
