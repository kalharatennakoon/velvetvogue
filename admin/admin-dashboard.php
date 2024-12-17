<?php
// Include required files
include_once('../config/config.php');
include_once('../includes/head-links.php');

// Function to handle insertions and deletions
function handlePostRequest($conn) {
    // Add product
    if (isset($_POST['add_product'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $brand = mysqli_real_escape_string($conn, $_POST['brand']);
        $category = $_POST['category'];
        $sub_category = mysqli_real_escape_string($conn, $_POST['sub_category']);
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $is_active = isset($_POST['is_active']) ? 1 : 0;

        $query = "INSERT INTO products (name, description, price, stock, brand, category, sub_category, created_at, updated_at, is_active) 
                  VALUES ('$name', '$description', '$price', '$stock', '$brand', '$category', '$sub_category', '$created_at', '$updated_at', '$is_active')";
        mysqli_query($conn, $query);
    }

    // Add product color
    if (isset($_POST['add_color'])) {
        $product_id = $_POST['product_id'];
        $color = mysqli_real_escape_string($conn, $_POST['color']);
        $query = "INSERT INTO product_colors (product_id, color) VALUES ('$product_id', '$color')";
        mysqli_query($conn, $query);
    }

    // Add product size
    if (isset($_POST['add_size'])) {
        $product_id = $_POST['product_id'];
        $size = $_POST['size'];
        $query = "INSERT INTO product_sizes (product_id, size) VALUES ('$product_id', '$size')";
        mysqli_query($conn, $query);
    }

    // Add product material
    if (isset($_POST['add_material'])) {
        $product_id = $_POST['product_id'];
        $material = mysqli_real_escape_string($conn, $_POST['material']);
        $query = "INSERT INTO product_materials (product_id, material) VALUES ('$product_id', '$material')";
        mysqli_query($conn, $query);
    }

    // Add product image
    if (isset($_POST['add_image'])) {
        $product_id = $_POST['product_id'];
        $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
        $query = "INSERT INTO product_images (product_id, image_url) VALUES ('$product_id', '$image_url')";
        mysqli_query($conn, $query);
    }

    // Delete product (and related data)
    if (isset($_POST['delete_product'])) {
        $product_id = $_POST['product_id'];
        mysqli_query($conn, "DELETE FROM product_images WHERE product_id = '$product_id'");
        mysqli_query($conn, "DELETE FROM product_sizes WHERE product_id = '$product_id'");
        mysqli_query($conn, "DELETE FROM product_colors WHERE product_id = '$product_id'");
        mysqli_query($conn, "DELETE FROM product_materials WHERE product_id = '$product_id'");
        mysqli_query($conn, "DELETE FROM products WHERE product_id = '$product_id'");
    }
}

// Handle POST requests
handlePostRequest($conn);

// Fetch all products
$products_result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ccc;
            width: 300px;
        }

        label {
            font-weight: bold;
        }

        input, textarea, select, button {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <!-- Form to Add Product -->
    <h2>Add Product</h2>
    <form method="POST">
        <label for="name">Name:</label><br>
        <input type="text" name="name" required><br>

        <label for="description">Description:</label><br>
        <textarea name="description" required></textarea><br>

        <label for="price">Price:</label><br>
        <input type="number" name="price" required><br>

        <label for="stock">Stock:</label><br>
        <input type="number" name="stock" value="100"><br>

        <label for="brand">Brand:</label><br>
        <input type="text" name="brand" required><br>

        <label for="category">Category:</label><br>
        <select name="category">
            <option value="Men">Men</option>
            <option value="Women">Women</option>
            <option value="Kids">Kids</option>
            <option value="Promotion">Promotion</option>
            <option value="New Arrivals">New Arrivals</option>
        </select><br>

        <label for="sub_category">Sub Category:</label><br>
        <input type="text" name="sub_category"><br>

        <label for="is_active">Is Active:</label>
        <input type="checkbox" name="is_active"><br>

        <button type="submit" name="add_product">Add Product</button>
    </form>

    <!-- Display Products with options to update and delete -->
    <h2>Existing Products</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php while ($product = mysqli_fetch_assoc($products_result)): ?>
            <tr>
                <td><?php echo $product['product_id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['stock']; ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <button type="submit" name="delete_product">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
