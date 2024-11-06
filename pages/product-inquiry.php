<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inquiry - VELVET VOGUE</title>

    <!-- Favicon -->
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./assets/css/home-styles.css">

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
                            <small><a class="nav-link" href="./categories/women/women.php">women</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="./categories/men/men.php">men</a></small>
                        </li>
                        <li class="nav-item">
                            <small><a class="nav-link" href="#">kids</a></small>
                        </li>
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

    <!-- Main Content -->
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="p-4 rounded shadow-sm bg-white" style="max-width: 500px; width: 100%;">
            <h2 class="text-center mb-3 fw-bold">Product Inquiry</h2>
            <p class="text-center mb-4 text-muted">Inquire about your product delivery or tracking details below.</p>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $orderNumber = htmlspecialchars($_POST['orderNumber']);
                $email = htmlspecialchars($_POST['email']);
                $inquiry = htmlspecialchars($_POST['inquiry']);
                echo "<div class='alert alert-success text-center'>Thank you for your inquiry! We will get back to you regarding Order #$orderNumber soon.</div>";
            }
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="orderNumber" class="form-label">Order Number</label>
                    <input type="text" class="form-control" id="orderNumber" name="orderNumber" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="inquiry" class="form-label">Inquiry Details</label>
                    <textarea class="form-control" id="inquiry" name="inquiry" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-dark w-100">Submit</button>
            </form>
        </div>
    </div>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
