<?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Include required files
    include_once('../config/config.php');
    
    // Get product ID from URL and sanitize
    $product_id = isset($_GET['id']) ? intval($_GET['id']) : die("Invalid Product ID");

    // Fetch product details
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

    // Set page title
    $page_title = htmlspecialchars($product['name']);
    include_once('../includes/head-links.php');
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
            grid-gap: 10px; /* Small gap between images */
            margin: 0;
            padding: 0;
        }

        .collage-images .image-container {
            width: 100%;
            height: 100%;
            border: 1px solid #ddd; /* Light border around each image */
            border-radius: 5px; /* Slight rounding of corners */
            padding: 5px; /* Small padding inside each image container */
            background-color: #f8f8f8; /* Light background color */
        }

        .collage-images img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures images cover the space without stretching */
            border-radius: 5px; /* Match image corners with container */
        }

        /* Styling for size and quantity selectors */
        .size-options, .quantity-control {
            margin-bottom: 1rem;
        }

        .size-options select, .quantity-control .quantity-buttons {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .quantity-control .quantity-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-control .quantity-buttons button {
            width: 40px;
            height: 40px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1.2rem;
            color: #333;
            cursor: pointer;
        }

        .quantity-control .quantity-buttons button:hover {
            background-color: #e0e0e0;
        }

        .quantity-control .quantity-display {
            width: 50px;
            text-align: center;
            font-size: 1.2rem;
            margin: 0 10px;
        }

        .size-options select {
            font-size: 1rem;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <!-- Product Section -->
    <div class="container product-details">
        <div class="row">
            <!-- Left Side: Product Image(s) -->
            <div class="col-md-6 product-image-container">
                <?php if (!empty($images)): ?>
                    <div class="collage-images">
                        <?php 
                        $max_images = min(count($images), 4); // Limit to 4 images max
                        for ($i = 0; $i < $max_images; $i++): ?>
                            <div class="image-container">
                                <img src="<?php echo BASE_URL . '/assets/images/products/' . htmlspecialchars($images[$i]); ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php else: ?>
                    <p>Image(s) not available.</p>
                <?php endif; ?>
            </div>

            <!-- Right Side: Product Information -->
            <div class="col-md-6">
                <div class="product-info mb-4">
                    <!-- Product Title and Price -->
                    <h2 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p class="product-price">LKR <?php echo htmlspecialchars($product['price']); ?></p>

                    <!-- Product Description -->
                    <p><?php echo htmlspecialchars($product['description']); ?></p>

                    <!-- Product Materials -->
                    <?php if (!empty($materials)): ?>
                        <h5>Materials</h5>
                        <ul>
                            <?php foreach ($materials as $material): ?>
                                <li><?php echo htmlspecialchars($material); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <form action="cart.php" method="POST" class="mb-4">
                        <!-- Size Selection -->
                        <div class="size-options">
                            <label for="size" class="form-label mt-3">Size:</label>
                            <select name="size" id="size" class="form-control" required>
                                <option value="" selected disabled>Select Size</option>
                                <option value="xxs">XXS</option>
                                <option value="xs">XS</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                                <option value="2xl">2XL</option>
                                <option value="3xl">3XL</option>
                            </select>
                        </div>


                        <!-- Quantity Selection -->
                        <div class="quantity-control">
                            <label for="quantity" class="form-label mt-3 mb-0">Quantity:</label>
                            <div class="quantity-buttons">
                                <button type="button" class="btn btn-outline-dark" id="decreaseBtn">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="quantity-display" id="quantity">1</span>
                                <button type="button" class="btn btn-outline-dark" id="increaseBtn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark">Add to Cart</button>
                        <button type="submit" class="btn btn-secondary">Buy Now</button>
                    </form>

                    <!-- Size Guide Button -->
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#sizeGuideModal">
                        Size Guide
                    </button>

                    <h5>Delivery Information</h5>
                    <p>Free delivery on orders over $50. Expect delivery within 3-5 business days.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

    <!-- Modal for Size Guide -->
    <div class="modal fade" id="sizeGuideModal" tabindex="-1" aria-labelledby="sizeGuideModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <!-- Close button positioned at the top right -->
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    <!-- Larger size guide image -->
                    <img src="../assets/images/products/size-guide.png" alt="Size Guide" class="img-fluid w-100" style="max-height: 80vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Size Selection
        document.querySelectorAll('.size-options select').forEach(select => {
            select.addEventListener('change', function() {
                // Can be extended with any action you want when size changes
                console.log("Selected size: " + this.value);
            });
        });

        // Quantity control
        let quantity = 1;
        const quantityDisplay = document.getElementById('quantity');
        
        document.getElementById('decreaseBtn').addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                quantityDisplay.textContent = quantity;
            }
        });

        document.getElementById('increaseBtn').addEventListener('click', function() {
            if (quantity < 10) {
                quantity++;
                quantityDisplay.textContent = quantity;
            }
        });
    </script>
</body>
</html>
