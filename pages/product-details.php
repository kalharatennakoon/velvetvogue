<?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Include required files
    include_once('../config/config.php');
    
    // Get product ID from URL and sanitize
    $product_id = isset($_GET['product-id']) ? intval($_GET['product-id']) : die("Invalid Product ID");

    // Fetch product details using the correct column name 'product_id'
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        die("Product not found.");
    }

    // Fetch images for the product
    $images_query = "SELECT image_url FROM product_images WHERE product_id = $product_id";
    $images_result = mysqli_query($conn, $images_query);
    $images = [];
    if ($images_result && mysqli_num_rows($images_result) > 0) {
        while ($image = mysqli_fetch_assoc($images_result)) {
            $images[] = $image['image_url'];
        }
    }

    // Fetch the average rating for the product
    $rating_query = "SELECT AVG(rating) AS average_rating FROM product_ratings WHERE product_id = $product_id";
    $rating_result = mysqli_query($conn, $rating_query);
    $average_rating = 0;
    if ($rating_result && mysqli_num_rows($rating_result) > 0) {
        $rating_data = mysqli_fetch_assoc($rating_result);
        $average_rating = $rating_data['average_rating'];
    }

    // Calculate the star representation (rounded to nearest half-star)
    $star_rating = round($average_rating * 2) / 2; // Round to nearest half
    $full_stars = floor($star_rating);
    $half_star = ($star_rating - $full_stars) >= 0.5 ? true : false;
    $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);

    // Set page title
    $page_title = htmlspecialchars($product['name']);
    include_once('../includes/head-links.php');

    // Fetch customer reviews for the product
    $reviews_query = "SELECT r.review, r.rating, r.rating_date, c.first_name, c.last_name 
                      FROM product_ratings r 
                      JOIN customers c ON r.customer_id = c.customer_id 
                      WHERE r.product_id = $product_id 
                      ORDER BY r.rating_date DESC";
    $reviews_result = mysqli_query($conn, $reviews_query);
    $reviews = [];
    if ($reviews_result && mysqli_num_rows($reviews_result) > 0) {
        while ($review = mysqli_fetch_assoc($reviews_result)) {
            $reviews[] = $review;
        }
    }

    // Fetch "You may also like" products based on the second_sub_category
    $similar_products_query = "SELECT * FROM products WHERE second_sub_category = '" . $product['second_sub_category'] . "' AND product_id != $product_id";
    $similar_products_result = mysqli_query($conn, $similar_products_query);
    $similar_products = [];
    if ($similar_products_result && mysqli_num_rows($similar_products_result) > 0) {
        while ($similar_product = mysqli_fetch_assoc($similar_products_result)) {
            $similar_products[] = $similar_product;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <style>
        /* Style for the collage images */
        .collage-images {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
            margin: 0;
            padding: 0;
        }

        .collage-images .image-container {
            width: 100%;
            height: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            background-color: #f8f8f8;
        }

        .collage-images img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-rating {
            margin-top: 10px;
            font-size: 1.2rem;
        }

        .star {
            color: #FFD700;
        }

        .review-section {
            margin-top: 30px;
        }

        .review-section h3 {
            font-size: 1.5rem;
        }

        .review-section .review {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .review-section .review p {
            margin: 0;
        }

        .similar-products {
            margin-top: 30px;
        }

        .similar-products .product {
            display: inline-block;
            width: 22%;
            margin: 0 2%;
            text-align: center;
        }

        .similar-products img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .similar-products .product-title {
            font-size: 1rem;
            margin-top: 10px;
        }

        .similar-products .product-price {
            color: #000;
            font-size: 1.1rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <!-- Product Section -->
    <div class="container product-details">
        <div class="row">
            <div class="col-md-6 product-image-container">
                <?php if (!empty($images)): ?>
                    <div class="collage-images">
                        <?php 
                        $max_images = min(count($images), 4);
                        for ($i = 0; $i < $max_images; $i++): ?>
                            <div class="image-container">
                                <img src="<?php echo BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/' . htmlspecialchars($images[$i]); ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php else: ?>
                    <p>Image(s) not available.</p>
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <div class="product-info mb-4">
                    <h2 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h2>

                    <div class="product-rating">
                        <?php 
                            for ($i = 0; $i < $full_stars; $i++) {
                                echo '<span class="star">&#9733;</span>';
                            }
                            if ($half_star) {
                                echo '<span class="star">&#9733;</span>';
                            }
                            for ($i = 0; $i < $empty_stars; $i++) {
                                echo '<span>&#9734;</span>';
                            }
                        ?>
                        <span>(<?php echo number_format($average_rating, 1); ?>)</span>
                    </div>

                    <p class="product-price">LKR <?php echo htmlspecialchars($product['price']); ?></p>

                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                </div>
            </div>
        </div>

        <!-- Customer Reviews Section -->
        <div class="review-section">
            <h3>Customer Reviews</h3>
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <p><strong><?php echo htmlspecialchars($review['first_name']) . ' ' . htmlspecialchars($review['last_name']); ?></strong> - <?php echo date('F j, Y', strtotime($review['rating_date'])); ?></p>
                        <p>Rating: <?php for ($i = 0; $i < $review['rating']; $i++) { echo '★'; } ?></p>
                        <p><?php echo nl2br(htmlspecialchars($review['review'])); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No reviews yet.</p>
            <?php endif; ?>
        </div>

        <!-- You May Also Like Section -->
        <div class="similar-products">
            <h3>You May Also Like</h3>
            <div class="row">
                <?php if (!empty($similar_products)): ?>
                    <?php foreach ($similar_products as $similar_product): ?>
                        <div class="product">
                            <img src="<?php echo BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/' . htmlspecialchars($similar_product['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($similar_product['name']); ?>">
                            <p class="product-title"><?php echo htmlspecialchars($similar_product['name']); ?></p>
                            <p class="product-price">LKR <?php echo htmlspecialchars($similar_product['price']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No similar products found.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
