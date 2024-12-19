<?php
include_once('../config/config.php');
include_once('../includes/head-links.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Reuse similar styles as before */
        .subcategory-btn {
            margin: 5px;
            text-transform: capitalize;
        }
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
        <h2 class="mb-4 text-center">Promotions</h2>
        
        <!-- Fetch and Display Subcategories -->
        <?php
        // Fetch all subcategories related to the Promotions category
        $sqlSubcategories = "SELECT DISTINCT sub_category FROM products WHERE category = 'Promotions'";
        $resultSubcategories = $conn->query($sqlSubcategories);

        if ($resultSubcategories->num_rows > 0) {
            echo '<div class="d-flex justify-content-center flex-wrap mb-4">';
            while ($row = $resultSubcategories->fetch_assoc()) {
                $subCategory = htmlspecialchars($row['sub_category']);
                echo '<a href="new-arrivals.php?subcategory=' . urlencode($subCategory) . '" class="btn btn-outline-primary subcategory-btn">' . $subCategory . '</a>';
            }
            echo '</div>';
        }
        ?>

        <!-- Display Products -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            <?php
            // Determine which subcategory to display products for
            $selectedSubcategory = isset($_GET['subcategory']) ? htmlspecialchars($_GET['subcategory']) : null;

            $sqlProducts = "
                SELECT p.product_id, p.name, p.category, p.sub_category, pi.image_url, p.price
                FROM products p
                LEFT JOIN product_images pi ON p.product_id = pi.product_id
                WHERE p.category = 'Promotions'";

            // If a subcategory is selected, filter the query
            if ($selectedSubcategory) {
                $sqlProducts .= " AND p.sub_category = ?";
            }

            $stmt = $conn->prepare($sqlProducts);

            if ($selectedSubcategory) {
                $stmt->bind_param("s", $selectedSubcategory);
            }

            $stmt->execute();
            $resultProducts = $stmt->get_result();

            if ($resultProducts->num_rows > 0) {
                while ($row = $resultProducts->fetch_assoc()) {
                    $image_url = !empty($row['image_url']) ? BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/' . htmlspecialchars($row['image_url']) : BASE_URL . '/assets/images/placeholder.jpg';

                    echo '
                        <div class="col">
                            <div class="product-card">
                                <img src="' . $image_url . '" alt="' . htmlspecialchars($row['name']) . '">
                                <div class="product-card-body">
                                    <h5>' . htmlspecialchars($row['name']) . '</h5>
                                    <p><strong>Category:</strong> ' . htmlspecialchars($row['category']) . '</p>
                                    <p><strong>Subcategory:</strong> ' . htmlspecialchars($row['sub_category']) . '</p>
                                    <p><strong>Product ID:</strong> ' . htmlspecialchars($row['product_id']) . '</p>
                                    <p class="price">$' . number_format($row['price'], 2) . '</p>
                                    <a href="' . BASE_URL . '/pages/product-details.php?product-id=' . $row['product_id'] . '" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
            } else {
                echo '<p class="text-center">No products found for this subcategory.</p>';
            }

            $stmt->close();
            ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
