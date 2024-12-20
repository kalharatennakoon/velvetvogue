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

    <!-- CSS links -->
    <link rel="stylesheet" type="text/css" href="../assets/css/product-details.css">
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
                            // Round the average rating based on the first decimal place
                            $average_rating = $average_rating ?? 0; // Ensure $average_rating has a value
                            $rounded_rating = (intval($average_rating) + ($average_rating - intval($average_rating) >= 0.5 ? 1 : 0));
                            
                            // Calculate full stars and empty stars based on the rounded rating
                            $full_stars = $rounded_rating; // All stars up to $rounded_rating are full
                            $empty_stars = 5 - $full_stars; // Remaining stars are empty

                            // Render the stars
                            for ($i = 0; $i < $full_stars; $i++) {
                                echo '<span class="star" style="color: gold;">&#9733;</span>'; // Colored full star
                            }
                            for ($i = 0; $i < $empty_stars; $i++) {
                                echo '<span>&#9734;</span>'; // Empty star
                            }
                        ?>
                        <!-- Display the rounded rating inside parentheses -->
                        <span>
                            (<?php echo $rounded_rating; ?>)
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
                    <div class="product-options p-3 d-flex flex-column align-items-start">
                        <form action="cart.php" method="post">
                            <!-- Size Selection -->
                            <div class="form-group mb-3">
                                <label for="size" class="font-weight-bold small mb-1">Size:</label>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sizeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Size
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="sizeDropdown">
                                        <li><a class="dropdown-item" href="#" data-size="XXS">XXS</a></li>
                                        <li><a class="dropdown-item" href="#" data-size="XS">XS</a></li>
                                        <li><a class="dropdown-item" href="#" data-size="S">S</a></li>
                                        <li><a class="dropdown-item" href="#" data-size="M">M</a></li>
                                        <li><a class="dropdown-item" href="#" data-size="L">L</a></li>
                                        <li><a class="dropdown-item" href="#" data-size="XL">XL</a></li>
                                        <li><a class="dropdown-item" href="#" data-size="2XL">2XL</a></li>
                                        <li><a class="dropdown-item" href="#" data-size="3XL">3XL</a></li>
                                    </ul>
                                </div>
                                <!-- Hidden input for the selected size -->
                                <input type="hidden" name="size" id="selectedSize" value="">

                                <!-- Text to display the selected size -->
                                <p id="selectedSizeText" style="display: none; margin-top: 10px; font-size: 14px; color: #555;"></p>
                            </div>
                            <!-- Quantity Selection -->
                            <div class="form-group mb-3">
                                <label for="quantity" class="font-weight-bold small mb-1">Quantity:</label>
                                <div class="input-group input-group-sm">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="changeQuantity(-1)">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" id="quantity" class="form-control text-center" value="1" min="1" max="100" readonly>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="changeQuantity(1)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Size Guide Button -->
                            <div class="form-group text-left mb-3">
                                <button type="button" class="btn btn-info btn-sm px-3" id="size-guide-btn">
                                    <i class="fas fa-ruler-combined"></i> Size Guide
                                </button>
                            </div>

                            <!-- Size Guide Modal -->
                            <div class="modal fade" id="size-guide-modal" tabindex="-1" aria-labelledby="size-guide-modal-label" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body position-relative">
                                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" id="close-size-guide" aria-label="Close"></button>
                                            <img src="<?php echo BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/size-guide.png'; ?>" alt="Size Guide" class="img-fluid rounded">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="form-group text-left">
                                <button type="submit" class="btn btn-primary btn-sm mr-2 px-4">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                <button type="submit" name="buy_now" class="btn btn-success btn-sm px-4">
                                    <i class="fas fa-bolt"></i> Buy Now
                                </button>
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
                        <p>Rating: 
                            <?php
                                $customer_star_rating = round($review['rating'] * 2) / 2; // Round to nearest half
                                $customer_full_stars = floor($customer_star_rating);
                                $customer_half_star = ($customer_star_rating - $customer_full_stars) >= 0.5 ? true : false;
                                $customer_empty_stars = 5 - $customer_full_stars - ($customer_half_star ? 1 : 0);

                                for ($i = 0; $i < $customer_full_stars; $i++) {
                                    echo '<span class="star">&#9733;</span>';
                                }
                                if ($customer_half_star) {
                                    echo '<span class="star">&#9733;</span>';
                                }
                                for ($i = 0; $i < $customer_empty_stars; $i++) {
                                    echo '<span>&#9734;</span>';
                                }
                            ?>
                        </p>
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


    <!-- JavaScript links -->
    <script src="../assets/js/product-details.js"></script>


</body>
</html>
