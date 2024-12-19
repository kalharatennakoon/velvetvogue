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

    // Handle Add to Cart or Buy Now logic
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the size and quantity selected by the user
        $size = isset($_POST['size']) ? $_POST['size'] : 'M';  // Default to 'M' if not selected
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

        // Add the product to the cart (session-based cart, assuming session is started)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Ensure the cart is an array
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add product to cart (with size and quantity)
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'name' => $product['name'],
            'size' => $size,
            'quantity' => $quantity,
            'price' => $product['price'], // Assuming 'price' exists in the product data
        ];

        // Redirect based on button clicked
        if (isset($_POST['buy_now'])) {
            // Redirect to checkout if "Buy Now" is clicked
            header('Location: checkout.php');
            exit;
        } else {
            // Redirect to cart if "Add to Cart" is clicked
            header('Location: cart.php');
            exit;
        }
    }

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

    // Fetch materials for the product
    $materials_query = "SELECT material FROM product_materials WHERE product_id = $product_id";
    $materials_result = mysqli_query($conn, $materials_query);
    $materials = [];
    if ($materials_result && mysqli_num_rows($materials_result) > 0) {
        while ($material = mysqli_fetch_assoc($materials_result)) {
            $materials[] = $material['material'];
        }
    }

    
    // Fetch "You may also like" products based on the second_sub_category, category, and sub_category
    $similar_products_query = "SELECT p.*, pi.image_url FROM products p 
    LEFT JOIN product_images pi ON pi.product_id = p.product_id 
    WHERE p.second_sub_category = '" . $product['second_sub_category'] . "' 
    AND p.category = '" . $product['category'] . "' 
    AND p.sub_category = '" . $product['sub_category'] . "' 
    AND p.product_id != $product_id 
    GROUP BY p.product_id";
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
        .similar-products {
            margin-top: 30px;
            padding-bottom: 30px;  /* Add some padding at the bottom */
            overflow: hidden;
        }

        .container.product-details {
            padding-bottom: 50px; /* Add some bottom padding to ensure space */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;  /* Ensure the container takes up full height */
        }

        footer {
            clear: both;  /* Ensures the footer does not overlap content */
        }

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

        /* Updated similar-products styling */
        .similar-products .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            width: 200px; /* Adjust width as needed */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
        }

        .product-card .product-image img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ccc;
        }

        .product-info {
            padding: 15px;
        }

        .product-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 14px;
            color: #f39c12;
        }

        .product-card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* Removing redundant styling */
        .similar-products .product {
            display: inline-block;
            width: auto;
            margin: 0;
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

            <!-- Main product details -->
            <div class="col-md-6">
                <!-- Product Info Section -->
                <div class="product-info mb-4">
                    <h2 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h2>

                    <!-- Product Rating -->
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
                        <span>
                            (<?php echo intval($average_rating ?? 0); ?>)
                        </span>
                    </div>

                    <!-- Product Price -->
                    <p class="product-price">LKR <?php echo htmlspecialchars($product['price']); ?></p>

                    <!-- Product Description -->
                    <p><?php echo htmlspecialchars($product['description']); ?></p>

                    <!-- Display Product Materials -->
                    <?php if (!empty($materials)): ?>
                        <div class="product-materials">
                            <ul>
                                <?php foreach ($materials as $material): ?>
                                    <li><?php echo htmlspecialchars($material); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Size and Quantity Selection -->
                    <div class="product-options">
                        <form action="cart.php" method="post">
                            <div class="form-group">
                                <label for="size">Size:</label>
                                <select name="size" id="size" class="form-control">
                                    <option value="XXS">XXS</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="2XL">2XL</option>
                                    <option value="3XL">3XL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(-1)">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" id="quantity" class="form-control text-center" value="1" min="1">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(1)">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group d-flex">
                                <button type="submit" class="btn btn-primary mr-2">Add to Cart</button>
                                <button type="submit" name="buy_now" class="btn btn-success">Buy Now</button>
                            </div>
                        </form>
                    </div>
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
                        <div class="col-3">
                            <!-- Product Image -->
                            <div class="product-image">
                                <img src="<?php echo BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/' . htmlspecialchars($similar_product['image_url'] ?: 'placeholder.jpg'); ?>" 
                                    alt="<?php echo htmlspecialchars($similar_product['name']); ?>">
                            </div>
                            <!-- Product Name -->
                            <div class="product-info">
                                <p class="product-title"><?php echo htmlspecialchars($similar_product['name']); ?></p>
                                <!-- Product Price -->
                                <p class="product-price">LKR <?php echo number_format($similar_product['price'], 2); ?></p>
                            </div>
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

    <!-- Script to change quantity -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script> <!-- Font Awesome CDN -->
    <script>
        function changeQuantity(amount) {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);
            var newQuantity = currentQuantity + amount;
            if (newQuantity >= 1) { // Ensure the quantity is at least 1
                quantityInput.value = newQuantity;
            }
        }
    </script>

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
