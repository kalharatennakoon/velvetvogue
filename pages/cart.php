<?php
session_start();

// Add product to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + 1;
}

// Fetch cart products from the database
include 'db_connect.php';
$cart_items = [];
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $query = "SELECT * FROM products WHERE id IN ($ids)";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $row['quantity'] = $_SESSION['cart'][$row['id']];
        $cart_items[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Shopping Cart</h1>
    <?php foreach ($cart_items as $item): ?>
        <div>
            <h2><?php echo $item['name']; ?></h2>
            <p>Price: <?php echo $item['price']; ?> LKR</p>
            <p>Quantity: <?php echo $item['quantity']; ?></p>
        </div>
    <?php endforeach; ?>

    <form action="checkout.php" method="post">
        <button type="submit">Proceed to Payment</button>
    </form>
</body>
</html>
