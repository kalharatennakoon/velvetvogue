<?php
    // Include required files
    include_once('../config/config.php');
    $page_title = "Admin Dashboard";
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

    // Handle the delete request
    if (isset($_POST['delete-product'])) {
        $product_id_to_delete = intval($_POST['product-id']);
        
        // Start a transaction to ensure that all deletions are handled safely
        mysqli_begin_transaction($conn);
        try {
            // Delete product images first (if any)
            $delete_images_query = "DELETE FROM product_images WHERE product_id = $product_id_to_delete";
            mysqli_query($conn, $delete_images_query);

            // Delete product colors
            $delete_colors_query = "DELETE FROM product_colors WHERE product_id = $product_id_to_delete";
            mysqli_query($conn, $delete_colors_query);

            // Delete product sizes
            $delete_sizes_query = "DELETE FROM product_sizes WHERE product_id = $product_id_to_delete";
            mysqli_query($conn, $delete_sizes_query);

            // Delete product materials
            $delete_materials_query = "DELETE FROM product_materials WHERE product_id = $product_id_to_delete";
            mysqli_query($conn, $delete_materials_query);

            // Finally, delete the product itself
            $delete_product_query = "DELETE FROM products WHERE product_id = $product_id_to_delete";
            mysqli_query($conn, $delete_product_query);

            // Commit the transaction
            mysqli_commit($conn);

            // Redirect to the same page with a success message
            header('Location: admin-dashboard.php?delete=success');
            exit();
        } catch (Exception $e) {
            // Rollback the transaction in case of any error
            mysqli_rollback($conn);
            echo "Error: " . $e->getMessage();
        }
    }

    if (isset($_POST['submit-product'])) {
        // Get product details from the form
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = floatval($_POST['price']);
        $stock = intval($_POST['stock']);
        $brand = mysqli_real_escape_string($conn, $_POST['brand']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $sub_category = mysqli_real_escape_string($conn, $_POST['sub_category']);
        $colors = mysqli_real_escape_string($conn, $_POST['colors']);
        $sizes = mysqli_real_escape_string($conn, $_POST['sizes']);
        $materials = mysqli_real_escape_string($conn, $_POST['materials']);
        $images = mysqli_real_escape_string($conn, $_POST['images']);
        
        // Begin the transaction
        mysqli_begin_transaction($conn);
        try {
            // Insert the new product into the products table
            $query = "INSERT INTO products (name, description, price, stock, brand, category, sub_category)
                      VALUES ('$name', '$description', $price, $stock, '$brand', '$category', '$sub_category')";
            mysqli_query($conn, $query);
            $product_id = mysqli_insert_id($conn);  // Get the ID of the newly inserted product

            // Insert colors, sizes, materials, and images into their respective tables
            if (!empty($colors)) {
                foreach (explode(',', $colors) as $color) {
                    $color = trim($color);
                    $query = "INSERT INTO product_colors (product_id, color) VALUES ($product_id, '$color')";
                    mysqli_query($conn, $query);
                }
            }

            if (!empty($sizes)) {
                foreach (explode(',', $sizes) as $size) {
                    $size = trim($size);
                    $query = "INSERT INTO product_sizes (product_id, size) VALUES ($product_id, '$size')";
                    mysqli_query($conn, $query);
                }
            }

            if (!empty($materials)) {
                foreach (explode(',', $materials) as $material) {
                    $material = trim($material);
                    $query = "INSERT INTO product_materials (product_id, material) VALUES ($product_id, '$material')";
                    mysqli_query($conn, $query);
                }
            }

            if (!empty($images)) {
                foreach (explode(',', $images) as $image) {
                    $image = trim($image);
                    $query = "INSERT INTO product_images (product_id, image_url) VALUES ($product_id, '$image')";
                    mysqli_query($conn, $query);
                }
            }

            // Commit the transaction
            mysqli_commit($conn);

            // Redirect or show success message
            header("Location: admin-dashboard.php?add=success");
            exit();
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            mysqli_rollback($conn);
            echo "Error: " . $e->getMessage();
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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

    <!-- Add New Product Button -->
    <div class="text-center my-4">
        <button class="btn btn-success" id="addNewProductBtn">Add New Product</button>
    </div>

    <!-- Add Product Form (Initially Hidden) -->
    <div id="addProductForm" style="display: none;">
        <h3>Add New Product</h3>
        <form id="productForm" method="POST" action="admin-dashboard.php">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="mb-3">
                <label for="sub_category" class="form-label">Sub Category</label>
                <input type="text" class="form-control" id="sub_category" name="sub_category" required>
            </div>
            <div class="mb-3">
                <label for="colors" class="form-label">Colors (comma-separated)</label>
                <input type="text" class="form-control" id="colors" name="colors">
            </div>
            <div class="mb-3">
                <label for="sizes" class="form-label">Sizes (comma-separated)</label>
                <input type="text" class="form-control" id="sizes" name="sizes">
            </div>
            <div class="mb-3">
                <label for="materials" class="form-label">Materials (comma-separated)</label>
                <input type="text" class="form-control" id="materials" name="materials">
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Images (comma-separated URLs)</label>
                <input type="text" class="form-control" id="images" name="images">
            </div>
            <button type="submit" name="submit-product" class="btn btn-primary">Add Product</button>
        </form>
    </div>


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
                                    <img src="<?php echo BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/' . $image_url; ?>" alt="Product Image" class="product-image">
                                <?php endforeach; ?>
                            </td>
                            <td><?php echo $product['created_at']; ?></td>
                            <td><?php echo $product['updated_at']; ?></td>
                            <td><?php echo $product['is_active'] ? 'Yes' : 'No'; ?></td>
                            <td>
                                <button class="btn-delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" 
                                    onclick="setDeleteProductId(<?php echo $product['product_id']; ?>)">Delete</button>
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
                        <input type="hidden" name="product-id" id="deleteProductId" value="">
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        // Set the product id for deletion when the delete button is clicked
        function setDeleteProductId(productId) {
            document.getElementById('deleteProductId').value = productId;
        }
    </script>

    <script>
        // Show the form when "Add New Product" button is clicked
        document.getElementById('addNewProductBtn').addEventListener('click', function() {
            var form = document.getElementById('addProductForm');
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        });
    </script>


</body>
</html>
