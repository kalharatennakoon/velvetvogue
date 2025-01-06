<?php

// Include required files
include_once('../config/config.php');
// Set page title
$page_title = "Shopping Cart";
include_once('../includes/head-links.php');

session_start();

// Add product to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + 1;
}

// Fetch cart products from the database
$cart_items = [];
$subtotal = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $query = "SELECT * FROM products WHERE product_id IN ($ids)";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $row['quantity'] = $_SESSION['cart'][$row['product_id']];
        $subtotal += $row['price'] * $row['quantity'];
        $cart_items[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
    <style>
        .cart-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            padding: 20px;
        }
        .shopping-cart, .order-summary {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
        }
        .cart-items {
            margin-top: 20px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .cart-item img {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }
        .item-details {
            flex: 1;
        }
        .item-quantity input {
            width: 50px;
            text-align: center;
        }
        .remove-item {
            background: none;
            border: none;
            cursor: pointer;
            color: #ff0000;
        }
        .order-summary .summary-details p {
            display: flex;
            justify-content: space-between;
        }
        .checkout-button {
            width: 100%;
            background-color: #000;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <div class="cart-container">
        <div class="shopping-cart">
            <h1>Your Shopping Cart</h1>
            <p>You have <?php echo count($cart_items); ?> item<?php echo count($cart_items) > 1 ? 's' : ''; ?> in your cart</p>
            <div class="cart-items">
                <?php foreach ($cart_items as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/' . htmlspecialchars($item['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="item-details">
                            <p><?php echo htmlspecialchars($item['name']); ?></p>
                            <p>Price: LKR <?php echo number_format($item['price'], 2); ?></p>
                            <p>Quantity: <?php echo $item['quantity']; ?></p>
                        </div>
                        <form method="POST" action="remove_from_cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                            <button class="remove-item">🗑️</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="order-summary">
            <h2>Order Summary</h2>
            <form method="POST" action="apply-coupon.php">
                <input type="text" name="coupon_code" placeholder="Enter coupon code here">
                <button type="submit">Apply</button>
            </form>
            <div class="summary-details">
                <p>Subtotal: LKR <?php echo number_format($subtotal, 2); ?></p>
                <p>Shipping: <span>Calculated at the next step</span></p>
                <p>Total: LKR <?php echo number_format($subtotal, 2); ?></p>
            </div>
            <form action="checkout.php" method="post">
                <button class="checkout-button" type="submit">Continue to checkout</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

</body>
</html>
