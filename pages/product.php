<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include required files
include_once('../config/config.php');
include_once('../includes/head-links.php');

// Get product ID from URL and sanitize
$product_id = isset($_GET['id']) ? intval($_GET['id']) : die("Invalid Product ID");

// Fetch product details
$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
    // Debugging output: check the structure of $product
   // var_dump($product);  // Temporary for debugging, remove after confirming the output
} else {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($product['name']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($product['name']); ?></h1>

    <?php if (!empty($product['image_url'])): ?>
        <img src="<?php echo PRODUCT_IMAGE_PATH . htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width:300px;">
    <?php else: ?>
        <p>Image not available.</p>
    <?php endif; ?>

    <p><?php echo htmlspecialchars($product['description']); ?></p>
    <p>Price: <?php echo htmlspecialchars($product['price']); ?> LKR</p>
    <p>Available Sizes: <?php echo htmlspecialchars($product['size']); ?></p>
    <p>Colours: <?php echo htmlspecialchars($product['color']); ?></p>

    <form action="cart.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <button type="submit">Add to Cart</button>
    </form>
</body>
</html>
