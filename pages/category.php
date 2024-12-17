<?php
include 'db_connect.php';

// Fetch categories or filter parameters from the URL
$filters = [];
if (isset($_GET['gender'])) $filters[] = "gender = '" . $_GET['gender'] . "'";
if (isset($_GET['type'])) $filters[] = "type = '" . $_GET['type'] . "'";
if (isset($_GET['size'])) $filters[] = "size = '" . $_GET['size'] . "'";
if (isset($_GET['price_min'])) $filters[] = "price >= " . $_GET['price_min'];
if (isset($_GET['price_max'])) $filters[] = "price <= " . $_GET['price_max'];

$filter_query = !empty($filters) ? "WHERE " . implode(' AND ', $filters) : '';
$query = "SELECT * FROM products $filter_query";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Categories</title>
</head>
<body>
    <h1>Filter Products</h1>
    <form method="GET">
        <label>Gender: <input type="text" name="gender"></label>
        <label>Type: <input type="text" name="type"></label>
        <label>Size: <input type="text" name="size"></label>
        <label>Price Min: <input type="number" name="price_min"></label>
        <label>Price Max: <input type="number" name="price_max"></label>
        <button type="submit">Search</button>
    </form>

    <h2>Products</h2>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div>
            <h3><?php echo $row['name']; ?></h3>
            <p>Price: <?php echo $row['price']; ?> LKR</p>
        </div>
    <?php endwhile; ?>
</body>
</html>
