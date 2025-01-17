<?php
include_once('../config/config.php');
include_once('../includes/head-links.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Results</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: #fff;
        }

        .product-card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background-color: #f9f9f9;
        }

        .product-card-body {
            padding: 10px;
        }

        .product-card-body h5 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
            text-align: center;
        }

        .product-card-body p {
            margin: 4px 0;
            font-size: 14px;
            color: #555;
            text-align: center;
        }

        .product-card-body .price {
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
        }

        .product-card-body .btn-primary {
            margin-top: 8px;
            width: 100%;
            padding: 8px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container mt-4">
        <h2 class="mb-4 text-center">Search Results</h2>
        <?php
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $searchQuery = strtolower(htmlspecialchars(trim($_GET['search'])));
            
                // Debug: check the search query
                //echo "<p>Debug: Searching for '$searchQuery'</p>";
            
                // Initialize condition variable
                $condition = '';
            
                // Normalize the search term by removing hyphens for T-shirt related search
                $normalizedSearchQuery = str_replace('-', '', $searchQuery);
            
                // Handle specific cases for T-shirt related search terms
                if (in_array($normalizedSearchQuery, ['tshirt', 'tshirts', 't-shirt', 't-shirts'])) {
                    // Debug: show which condition is being applied
                    //echo "<p>Debug: Searching for T-shirt terms in second_sub_category</p>";
            
                    // Search specifically in the second_sub_category for T-shirt-related terms (handle hyphen variations)
                    $searchTerm = '%' . $normalizedSearchQuery . '%'; // Add wildcards
                    $condition = "LOWER(REPLACE(p.second_sub_category, '-', '')) LIKE LOWER(REPLACE(?, '-', ''))";
                } elseif (in_array($normalizedSearchQuery, ['shirt', 'shirts'])) {
                    // Search specifically in the second_sub_category for "Shirts" (case insensitive)
                    $searchTerm = $normalizedSearchQuery . '%'; // Add wildcards
                    $condition = "LOWER(REPLACE(p.second_sub_category, '-', '')) LIKE LOWER(REPLACE(?, '-', ''))";
                }else {
                    // Check if search term is 'men' or 'women' and ensure exact match
                    if ($searchQuery === 'men' || $searchQuery === 'women') {
                        $condition = "LOWER(p.category) = LOWER(?)";
                    } else {
                        // For general search, use LIKE for product name and categories/sub-categories
                        $searchParam = "%" . $searchQuery . "%";
                        $condition = "(LOWER(p.name) LIKE LOWER(?) OR LOWER(p.category) LIKE LOWER(?) OR LOWER(p.sub_category) LIKE LOWER(?) OR LOWER(p.second_sub_category) LIKE LOWER(?))";
                    }
                }
            
                // Debug: show the condition being used
                //echo "<p>Debug: Condition being used: $condition</p>";
            
                echo "<p class='text-center'>Showing results for: <strong>$searchQuery</strong></p>";
            
                // Prepare the SQL query with dynamic condition
                $sql = "
                    SELECT p.product_id, p.name, p.category, p.sub_category, p.second_sub_category, 
                           (SELECT image_url FROM product_images WHERE product_id = p.product_id LIMIT 1) AS image_url, 
                           p.price
                    FROM products p
                    WHERE $condition
                    GROUP BY p.product_id";
            
                if ($stmt = $conn->prepare($sql)) {
                    // Bind parameters based on the condition
                    if (in_array($normalizedSearchQuery, ['tshirt', 'tshirts', 't-shirt', 't-shirts'])) {
                        // Bind for T-shirt related search terms (handle hyphen variations)
                        $stmt->bind_param("s", $searchTerm);
                    } elseif (in_array($normalizedSearchQuery, ['shirt', 'shirts'])) {
                        // Bind for Shirts related search terms (handle hyphen variations)
                        $stmt->bind_param("s", $searchTerm);
                    } elseif ($searchQuery === 'men' || $searchQuery === 'women') {
                        // Bind for 'men' or 'women' categories (ensure case-insensitive comparison)
                        $stmt->bind_param("s", $searchQuery);  // Bind for 'men' or 'women'
                    } else {
                        // Bind for general search query (name, category, sub-category, second sub-category)
                        $stmt->bind_param("ssss", $searchParam, $searchParam, $searchParam, $searchParam);
                    }
            
                    $stmt->execute();
                    $result = $stmt->get_result();
            
                    if ($result->num_rows > 0) {
                        echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">';
                        while ($row = $result->fetch_assoc()) {
                            $image_url = BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/' . ($row['image_url'] ? htmlspecialchars($row['image_url']) : 'placeholder.jpg');
            
                            echo '
                                <div class="col">
                                    <div class="product-card">
                                        <img src="' . $image_url . '" alt="' . htmlspecialchars($row['name']) . '">
                                        <div class="product-card-body">
                                            <h5>' . htmlspecialchars($row['name']) . '</h5>
                                            <p><strong>Category:</strong> ' . htmlspecialchars($row['category']) . '</p>
                                            <p><strong>Subcategory:</strong> ' . htmlspecialchars($row['sub_category']) . '</p>
                                            <p><strong>Second Subcategory:</strong> ' . htmlspecialchars($row['second_sub_category']) . '</p>
                                            <p><strong>Product ID:</strong> ' . htmlspecialchars($row['product_id']) . '</p>
                                            <p class="price">LKR ' . number_format($row['price'], 2) . '</p>
                                            <a href="' . BASE_URL . '/pages/product-details.php?product-id=' . $row['product_id'] . '" class="btn btn-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                        echo '</div>';
                    } else {
                        echo '<p class="text-center">No products found.</p>';
                    }
                    $stmt->close();
                } else {
                    echo '<p class="text-center">Error: Unable to process your request.</p>';
                }
            } else {
                echo '<p class="text-center">Please enter a search term.</p>';
            }
                                                                                                                                           
        ?>
    </div>

    <?php include '../includes/footer.php'; ?>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
