<?php
    // Include required files
    include_once('../config/config.php');
    $page_title = "Admin Dashboard";
    include_once('../includes/head-links.php');

    // Function to handle insertions, deletions, and updates
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

        // Delete product (and related data)
        if (isset($_POST['delete_product'])) {
            $product_id = $_POST['product_id'];
            mysqli_query($conn, "DELETE FROM product_images WHERE product_id = '$product_id'");
            mysqli_query($conn, "DELETE FROM product_sizes WHERE product_id = '$product_id'");
            mysqli_query($conn, "DELETE FROM product_colors WHERE product_id = '$product_id'");
            mysqli_query($conn, "DELETE FROM product_materials WHERE product_id = '$product_id'");
            mysqli_query($conn, "DELETE FROM products WHERE product_id = '$product_id'");
        }

        // Update product (dummy logic for now)
        if (isset($_POST['update_product'])) {
            $product_id = $_POST['product_id'];
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = $_POST['price'];
            $stock = $_POST['stock'];

            $query = "UPDATE products 
                    SET name = '$name', description = '$description', price = '$price', stock = '$stock', updated_at = NOW() 
                    WHERE product_id = '$product_id'";
            mysqli_query($conn, $query);
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f9;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        main {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        section {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        section h2 {
            margin-top: 0;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input, textarea, select, button {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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

    <!-- header -->
    <?php include '../includes/admin-header.php'; ?>
    
    <div style="display: flex; justify-content: center; align-items: center;">
        <h1>Admin Dashboard</h1>
    </div>
    <div style="display: flex; justify-content: center; align-items: center;">
        <p>Manage products efficiently and effectively</p>
    </div>
    

    <main>
        <!-- Section: View Current Products -->
        <section>
            <h2>View Current Products</h2>
            <p>Below is a list of all the current products in the database:</p>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
                <?php while ($product = mysqli_fetch_assoc($products_result)): ?>
                    <tr>
                        <td><?php echo $product['product_id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['stock']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </section>

        <!-- Section: Add New Products -->
        <section>
            <h2>Add New Products</h2>
            <p>Use the form below to add a new product to the database:</p>
            <form method="POST">
                <input type="text" name="name" placeholder="Product Name" required>
                <textarea name="description" placeholder="Product Description" required></textarea>
                <input type="number" name="price" placeholder="Price" required>
                <input type="number" name="stock" placeholder="Stock" value="100" required>
                <input type="text" name="brand" placeholder="Brand" required>
                <select name="category">
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Kids">Kids</option>
                    <option value="Promotion">Promotion</option>
                    <option value="New Arrivals">New Arrivals</option>
                </select>
                <input type="text" name="sub_category" placeholder="Sub Category">
                <label>
                    <input type="checkbox" name="is_active"> Is Active
                </label>
                <button type="submit" name="add_product">Add Product</button>
            </form>
        </section>

        <!-- Section: Update Products -->
        <section>
            <h2>Update Existing Products</h2>
            <p>Select a product to update:</p>
            <form method="POST">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                    $products_result = mysqli_query($conn, "SELECT * FROM products");
                    while ($product = mysqli_fetch_assoc($products_result)): ?>
                        <tr>
                            <td><?php echo $product['product_id']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><?php echo $product['stock']; ?></td>
                            <td>
                                <button type="submit" name="update_product" value="<?php echo $product['product_id']; ?>">Update</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </form>
        </section>

        <!-- Section: Delete Products -->
        <section>
            <h2>Delete Products</h2>
            <p>Click the delete button to remove a product:</p>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
                <?php 
                $products_result = mysqli_query($conn, "SELECT * FROM products");
                while ($product = mysqli_fetch_assoc($products_result)): ?>
                    <tr>
                        <td><?php echo $product['product_id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['stock']; ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                <button type="submit" name="delete_product">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </section>
        
    </main>

    <!-- footer -->
    <?php include '../includes/admin-footer.php'; ?>

</body>
</html>
