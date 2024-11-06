<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php 
        include_once('../../../../../config/config.php'); 
        $page_title = 'Tom David Men\'s Crew Neck T-Shirt';
        include_once('../../../../../includes/head-links.php');
    ?>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../../assets/css/category-men-styles.css">

</head>
<body>

    <!-- Header -->
        <?php include '../../../../../includes/header.php'; ?>

    <!-- Custom Breadcrumb -->
    <div class="breadcrumb-container">
        <a href="<?php echo BASE_URL; ?>/index.php">Home</a>
        <span class="separator"> &gt; </span>
        <a href="<?php echo BASE_URL; ?>/categories/men/men.php">Men</a>
        <span class="separator"> &gt; </span> 
        <a href="<?php echo BASE_URL; ?>/categories/men/casual-wear/casual-wear.php">Casual Wear</a>
        <span class="separator"> &gt; </span>
        <a href="<?php echo BASE_URL; ?>/categories/men/casual-wear/t-shirts/t-shirts.php">T-shirts</a>
        <span class="separator"> &gt; </span>
        <span class="active">Tom David T-shirt</span>
    </div>



    <!-- Product Section -->
    <div class="container product-details">
        <div class="row">
            <!-- Left Side: Product Image -->
            <div class="col-md-6 product-image-container">
                <img src="<?php echo BASE_URL; ?>/assets/images/business-man.png" alt="Tom David Crew Neck T-shirt">
            </div>

            <!-- Right Side: Product Information -->
            <div class="col-md-6">
                <div class="product-info mb-4">
                    <h2 class="product-title">Tom David Crew Neck T-shirt</h2>
                    <p class="product-price">LKR 1,990.00</p>
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
                                <span class="quantity-display mx-2 mt-3" id="quantity">1</span> <!-- Quantity as a span element -->
                                <button type="button" class="btn btn-outline-dark" id="increaseBtn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Product Details -->
                        <div class="product-details-more mt-4">
                            <p class="product-info"><strong>Availability:</strong> <span class="text-success">In stock</span></p>
                            <p class="product-info"><strong>Brand:</strong> TOM DAVID</p>
                            <p class="product-info"><strong>Code:</strong> 1201030025666-Navy-XS</p>
                            <p class="product-info"><strong>Binloc:</strong> DC03D05</p>
                        </div>


                        <!-- Add to cart -->
                        <button type="submit" class="btn btn-dark">Add to Cart</button>

                        <!-- Buy now -->
                        <button type="submit" class="btn btn-secondary">Buy Now</button>
                    </form>

                    <h5>Product Information</h5>
                    <p>This Tom David Crew Neck T-shirt is crafted from high-quality cotton, perfect for casual wear. The breathable material ensures comfort throughout the day.</p>

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
            <div class="col-md-3">
                <img src="<?php echo BASE_URL; ?>/assets/images/friends1.png" alt="Related T-shirt 1">
            </div>
            <div class="col-md-3">
                <img src="<?php echo BASE_URL; ?>/assets/images/friends2.png" alt="Related T-shirt 2">
            </div>
            <div class="col-md-3">
                <img src="<?php echo BASE_URL; ?>/assets/images/friends3.png" alt="Related T-shirt 3">
            </div>
            <div class="col-md-3">
                <img src="<?php echo BASE_URL; ?>/assets/images/friends4.png" alt="Related T-shirt 4">
            </div>
        </div>
    </div>

    <!-- Footer -->
        <?php include '../../../../../includes/footer.php'; ?>

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // JavaScript to handle button selection
        document.querySelectorAll('.size-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remove 'selected' class from all buttons
                document.querySelectorAll('.size-button').forEach(btn => btn.classList.remove('selected'));
                
                // Add 'selected' class to the clicked button
                this.classList.add('selected');
            });
        });


        // Initialize the quantity
        let quantity = 1;
        const quantityDisplay = document.getElementById('quantity');

        // Decrease quantity
        document.getElementById('decreaseBtn').addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                quantityDisplay.textContent = quantity;
            }
        });
        // Increase quantity
        document.getElementById('increaseBtn').addEventListener('click', function() {
            if (quantity < 10) {
                quantity++;
                quantityDisplay.textContent = quantity;
            }
        });




    </script>
</body>
</html>
