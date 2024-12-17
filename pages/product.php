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

    $page_title = htmlspecialchars($product['name']);
    include_once('../includes/head-links.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <!-- Product Section -->
    <div class="container product-details">
        <div class="row">
            <!-- Left Side: Product Image -->
            <div class="col-md-6 product-image-container">
                <?php if (!empty($product['image_url'])): ?>
                    <img src="<?php echo BASE_URL . '/assets/images/products/' . htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 300px;">
                <?php else: ?>
                    <p>Image not available.</p>
                <?php endif; ?>
            </div>

            <!-- Right Side: Product Information -->
            <div class="col-md-6">
                <div class="product-info mb-4">
                    <h2 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p class="product-price">LKR <?php echo htmlspecialchars($product['price']); ?></p>
                    <form action="cart.php" method="POST" class="mb-4">
                        <div class="mb-3 size-options">
                            <label for="size" class="form-label mt-3">Size:</label>
                            <div class="size-buttons-container">
                                <button type="button" class="btn btn-outline-dark size-button" data-size="S">S</button>
                                <button type="button" class="btn btn-outline-dark size-button" data-size="M">M</button>
                                <button type="button" class="btn btn-outline-dark size-button" data-size="L">L</button>
                                <button type="button" class="btn btn-outline-dark size-button" data-size="XL">XL</button>
                            </div>
                        </div>
                        
                        <!-- Quantity -->
                        <div class="mb-3 quantity-control">
                            <label for="quantity" class="form-label mt-3 mb-0">Quantity:</label>
                            <div class="d-flex align-items-center quantity-buttons">
                                <button type="button" class="btn btn-outline-dark" id="decreaseBtn">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="quantity-display mx-2 mt-3" id="quantity">1</span>
                                <button type="button" class="btn btn-outline-dark" id="increaseBtn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark">Add to Cart</button>
                        <button type="submit" class="btn btn-secondary">Buy Now</button>
                    </form>

                    <h5>Product Information</h5>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>

                    <h5>Size Guide</h5>
                    <ul>
                        <li>S: Chest 36-38 inches</li>
                        <li>M: Chest 38-40 inches</li>
                        <li>L: Chest 40-42 inches</li>
                        <li>XL: Chest 42-44 inches</li>
                    </ul>

                    <h5>Delivery Information</h5>
                    <p>Free delivery on orders over $50. Expect delivery within 3-5 business days.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    <div class="container mt-3">
        <h5>We think you might be interested in these as well</h5>
        <div class="row related-products">
            <!-- Add related products images here -->
        </div>
    </div>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // JavaScript to handle button selection for size
        document.querySelectorAll('.size-button').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.size-button').forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');
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
