<?php
// Include required files
include_once('../config/config.php');
$page_title = "Product Details";
include_once('../includes/head-links.php');

// Handle product ID from the form or URL
$product_id = isset($_POST['product-id']) ? intval($_POST['product-id']) : (isset($_GET['product-id']) ? intval($_GET['product-id']) : 0);

// If no product ID is provided, set a default or show a message
if ($product_id === 0) {
    $no_product_message = "Please enter a valid Product ID to view details.";
}

// Fetch product data for the given product ID
$query_product = "
    SELECT * 
    FROM products 
    WHERE product_id = $product_id
";
$result_product = mysqli_query($conn, $query_product);
$product = mysqli_fetch_assoc($result_product);

// If no product is found, show a message
if ($product_id !== 0 && !$product) {
    $no_product_message = "No product found with ID = $product_id.";
}

// Fetch colors, sizes, materials, and images for the product
$query_attributes = "
    SELECT 
        GROUP_CONCAT(DISTINCT pc.color) AS colors, 
        GROUP_CONCAT(DISTINCT ps.size) AS sizes, 
        GROUP_CONCAT(DISTINCT pm.material) AS materials, 
        GROUP_CONCAT(DISTINCT pi.image_url) AS image_urls
    FROM products p
    LEFT JOIN product_colors pc ON p.product_id = pc.product_id
    LEFT JOIN product_sizes ps ON p.product_id = ps.product_id
    LEFT JOIN product_materials pm ON p.product_id = pm.product_id
    LEFT JOIN product_images pi ON p.product_id = pi.product_id
    WHERE p.product_id = $product_id
";
$result_attributes = mysqli_query($conn, $query_attributes);
$attributes = mysqli_fetch_assoc($result_attributes);

// Parse attributes
$colors = $attributes['colors'] ? explode(',', $attributes['colors']) : [];
$sizes = $attributes['sizes'] ? explode(',', $attributes['sizes']) : [];
$materials = $attributes['materials'] ? explode(',', $attributes['materials']) : [];
$image_urls = $attributes['image_urls'] ? explode(',', $attributes['image_urls']) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f9;
        }

        form {
            margin: 20px auto;
            text-align: center;
        }

        input[type="text"], input[type="submit"] {
            padding: 10px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        img {
            width: 100px;
            height: auto;
        }

        .message {
            text-align: center;
            color: red;
            font-size: 18px;
            margin: 20px;
        }
    </style>
</head>
<body>

<!-- Header -->
<?php include '../includes/admin-header.php'; ?>

<div style="text-align: center;">
    <h1>Search Product Details</h1>
</div>

<!-- Search Form -->
<form method="POST" action="admin-dashboard.php">
    <label for="product-id">Enter Product ID:</label>
    <input type="text" id="product-id" name="product-id" placeholder="e.g., 1" value="<?php echo htmlspecialchars($product_id); ?>">
    <input type="submit" value="Search">
</form>

<main>
    <!-- Display Message if no product is found -->
    <?php if (isset($no_product_message)): ?>
        <div class="message"><?php echo $no_product_message; ?></div>
    <?php else: ?>
        <!-- Combined Table -->
        <section>
            <h2>Product Details and Attributes</h2>
            <table>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Colors</th>
                    <th>Sizes</th>
                    <th>Materials</th>
                    <th>Images</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Active</th>
                </tr>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['stock']; ?></td>
                    <td><?php echo $product['brand']; ?></td>
                    <td><?php echo $product['category']; ?></td>
                    <td><?php echo $product['sub_category']; ?></td>
                    <td><?php echo implode('<br>', $colors); ?></td>
                    <td><?php echo implode('<br>', $sizes); ?></td>
                    <td><?php echo implode('<br>', $materials); ?></td>
                    <td>
                        <?php foreach ($image_urls as $image_url): ?>
                            <img src="<?php echo BASE_URL . '/' . $image_url; ?>" alt="Product Image"><br>
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo $product['created_at']; ?></td>
                    <td><?php echo $product['updated_at']; ?></td>
                    <td><?php echo $product['is_active'] ? 'Yes' : 'No'; ?></td>
                </tr>
            </table>
        </section>
    <?php endif; ?>
</main>

<!-- Footer -->
<?php include '../includes/admin-footer.php'; ?>

</body>
</html>
