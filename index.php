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

    <!-- Full Width Image Section -->
    <div class="full-width-image-container">
        <img src="<?php echo BASE_URL; ?>/assets/images/main-image.png" alt="Full Width Image" class="full-width-image">
    </div>

    <!-- Custom Styles for Full Width Image with Reduced Height -->
    <style>
        /* Ensure the full-width image container takes the full width */
        .full-width-image-container {
            width: 100%;
            overflow: hidden; /* Hide any overflow */
            padding: 10px;
        }

        /* Style the image to be responsive with a fixed height and full width */
        .full-width-image {
            width: 100%; /* Ensure the image spans the entire width of the container */
            height: 500px; /* Set a fixed height (you can adjust this value) */
            object-fit: cover; /* This ensures the image covers the full width without stretching */
        }

        /* Optional: For smaller devices, adjust the image height */
        @media (max-width: 768px) {
            .full-width-image {
                height: 200px; /* Reduce height on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .full-width-image {
                height: 150px; /* Further reduce height on very small screens */
            }
        }
    </style>



    <!-- New Arrivals Section -->
    <section class="container my-5">
        <h2 class="text-left">New Arrivals!</h2>
        <div class="row">
            <?php
            // Fetch "New Arrivals" products from the database
            $query = "SELECT * FROM products WHERE is_active = 1 AND category = 'New Arrivals' LIMIT 4";
            $result = mysqli_query($conn, $query);

            while ($product = mysqli_fetch_assoc($result)) {
                echo '
                <div class="col-md-3">
                    <div class="card text-center">
                        <img src="' . BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/' . ($product['image_url'] ? htmlspecialchars($product['image_url']) : 'placeholder.jpg') . '" class="card-img-top" alt="' . htmlspecialchars($product['name']) . '">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($product['name']) . '</h5>
                            <p class="card-text">Rs. ' . number_format($product['price'], 2) . '</p>
                            <a href="#" class="btn btn-primary">Buy Now</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </section>

   <!-- Promo Box -->
    <section class="container my-5 p-5 text-center" style="background: #f0f8ff; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
        <h2 class="text-dark mb-3" style="font-size: 2.5rem; font-weight: bold;">Exclusive Offer Just for You!</h2>
        <p class="text-dark mb-4" style="font-size: 1.1rem; font-weight: 300;">Don’t miss out on our limited-time sale! Explore our latest collection of stylish outfits, accessories, and more at unbeatable prices.</p>
        <h3 class="text-primary mb-3" style="font-size: 2rem; font-weight: 600;">50% OFF on Selected Items</h3>
        <p class="text-dark mb-4" style="font-size: 1.1rem;">Shop your favorite clothing and accessories from Velvet Vogue and enjoy 50% off. <br>This offer is valid for a limited time only, so hurry up!</p>
        <a href="shop.php" class="btn btn-primary px-4 py-2" style="font-size: 1.2rem; font-weight: bold; background-color: #4fa3f7; border: none; color: white; border-radius: 50px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease-in-out;">
            Shop Now
        </a>
    </section>

    <!-- Add a hover effect for the button -->
    <style>
        .btn:hover {
            background-color: #3a91d4;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            h2 {
                font-size: 2rem;
            }
            h3 {
                font-size: 1.5rem;
            }
            .btn {
                font-size: 1rem;
                padding: 12px 24px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }
            h2 {
                font-size: 1.8rem;
            }
            h3 {
                font-size: 1.3rem;
            }
            .btn {
                font-size: 0.9rem;
                padding: 10px 20px;
            }
        }
    </style>




   <!-- Category Highlights -->
    <section class="container my-5">
        <h2 class="text-left">Category Highlights</h2>
        <div class="row">
            <?php
            // Fetch category highlights from the database
            $categories = ['Men', 'Women', 'Kids', 'Promotions'];
            foreach ($categories as $category) {
                // Generate the URL with BASE_URL/pages/
                $categoryUrl = BASE_URL . '/pages/' . strtolower($category) . '.php';
                echo '
                <div class="col-md-3">
                    <div class="card text-center">
                        <img src="' . BASE_URL . '/assets/images/' . strtolower($category) . '.png" class="card-img-top" alt="' . $category . '" style="max-height: 200px; width: 100%; object-fit: contain;">
                        <div class="card-body">
                            <h5 class="card-title">' . $category . '</h5>
                            <a href="' . $categoryUrl . '" class="btn btn-primary">Explore</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </section>


    <?php include './includes/footer.php'; ?>
</body>
</html>
