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
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv3r1z04nqugAq0fGRyTgf5eP8pgo+v3DvqzPahh3ySo3uT4YzQhG3Iip0n" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;

        }
        .header, .footer {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .message {
            text-align: center;
            color: red;
            font-size: 18px;
            margin-top: 20px;
        }
        .product-details {
            margin-top: 30px;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        img.product-image {
            width: 120px;
            height: auto;
            margin: 5px;
        }
    </style>
</head>
<body>

 <!-- Header -->
 <?php include '../includes/admin-header.php'; ?>



<!-- Search Form -->
<div class="container text-center mb-4">
    <h2>Search Product by ID</h2>
    <form method="POST" action="admin-dashboard.php" class="d-flex justify-content-center">
        <input type="text" id="product-id" name="product-id" placeholder="Enter Product ID" class="form-control w-25" value="<?php echo htmlspecialchars($product_id); ?>">
        <button type="submit" class="btn btn-primary ms-2">Search</button>
    </form>
</div>

<main class="container">
    <!-- Display Message if no product is found -->
    <?php if (isset($no_product_message)): ?>
        <div class="message"><?php echo $no_product_message; ?></div>
    <?php else: ?>
        <!-- Product Table -->
        <section class="product-details">
            <h3>Product Details and Attributes</h3>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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
                                <img src="<?php echo BASE_URL . '/' . $image_url; ?>" alt="Product Image" class="product-image">
                            <?php endforeach; ?>
                        </td>
                        <td><?php echo $product['created_at']; ?></td>
                        <td><?php echo $product['updated_at']; ?></td>
                        <td><?php echo $product['is_active'] ? 'Yes' : 'No'; ?></td>
                        <td>
                            <button class="btn-delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    <?php endif; ?>
</main>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <form method="POST" action="admin-dashboard.php">
                    <input type="hidden" name="product-id" value="<?php echo $product_id; ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="delete-product" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include '../includes/admin-footer.php'; ?>
    


<!-- Bootstrap JS and Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBf8k3fGHwB36A2dS8w4wFO9YSh76RerhbfQY5wI1k9FJ36a" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0kS0CoBv6ksoBzH13eWI5zcsZjl6K1rI5hD5O2kw6dxsrrmP" crossorigin="anonymous"></script>
</body>
</html>
