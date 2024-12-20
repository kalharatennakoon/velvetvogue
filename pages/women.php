<?php
include_once('../config/config.php');
include_once('../includes/head-links.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women's Category</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .subcategory-btn, .second-subcategory-btn {
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

        .rating {
            color: #ffc107;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container mt-4">
        <h2 class="mb-4 text-center">Women's Category</h2>
        
        <!-- Fetch and Display Subcategories -->
        <?php
        $sqlSubcategories = "SELECT DISTINCT sub_category FROM products WHERE category = 'Women'";
        $resultSubcategories = $conn->query($sqlSubcategories);

        if ($resultSubcategories->num_rows > 0) {
            echo '<div class="d-flex justify-content-center flex-wrap mb-4">';
            while ($row = $resultSubcategories->fetch_assoc()) {
                $subCategory = htmlspecialchars($row['sub_category']);
                echo '<a href="women.php?subcategory=' . urlencode($subCategory) . '" class="btn btn-outline-primary subcategory-btn">' . $subCategory . '</a>';
            }
            echo '</div>';
        }
        ?>

        <!-- Fetch and Display Second Subcategories -->
        <?php
        $selectedSubcategory = isset($_GET['subcategory']) ? htmlspecialchars($_GET['subcategory']) : null;

        if ($selectedSubcategory) {
            $sqlSecondSubcategories = "SELECT DISTINCT second_sub_category FROM products WHERE category = 'Women' AND sub_category = ?";
            $stmt = $conn->prepare($sqlSecondSubcategories);
            $stmt->bind_param("s", $selectedSubcategory);
            $stmt->execute();
            $resultSecondSubcategories = $stmt->get_result();

            if ($resultSecondSubcategories->num_rows > 0) {
                echo '<div class="d-flex justify-content-center flex-wrap mb-4">';
                while ($row = $resultSecondSubcategories->fetch_assoc()) {
                    $secondSubCategory = htmlspecialchars($row['second_sub_category']);
                    echo '<a href="women.php?subcategory=' . urlencode($selectedSubcategory) . '&second_subcategory=' . urlencode($secondSubCategory) . '" class="btn btn-outline-secondary second-subcategory-btn">' . $secondSubCategory . '</a>';
                }
                echo '</div>';
            }
            $stmt->close();
        }
        ?>

        <!-- Display Products -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            <?php
            $selectedSecondSubcategory = isset($_GET['second_subcategory']) ? htmlspecialchars($_GET['second_subcategory']) : null;

            $sqlProducts = "
                SELECT p.product_id, p.name, p.category, p.sub_category, p.second_sub_category, pi.image_url, p.price
                FROM products p
                LEFT JOIN product_images pi ON p.product_id = pi.product_id
                WHERE p.category = 'Women'";

            if ($selectedSubcategory) {
                $sqlProducts .= " AND p.sub_category = ?";
            }

            if ($selectedSecondSubcategory) {
                $sqlProducts .= " AND p.second_sub_category = ?";
            }

            $sqlProducts .= " GROUP BY p.product_id";

            $stmt = $conn->prepare($sqlProducts);

            if ($selectedSubcategory && $selectedSecondSubcategory) {
                $stmt->bind_param("ss", $selectedSubcategory, $selectedSecondSubcategory);
            } elseif ($selectedSubcategory) {
                $stmt->bind_param("s", $selectedSubcategory);
            }

            $stmt->execute();
            $resultProducts = $stmt->get_result();

            if ($resultProducts->num_rows > 0) {
                while ($row = $resultProducts->fetch_assoc()) {
                    $image_url = BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/' . htmlspecialchars($row['image_url']);
                    $image_url = !empty($row['image_url']) ? $image_url : BASE_URL . '/assets/images/placeholder.jpg';

                    $sqlColors = "SELECT color FROM product_colors WHERE product_id = ?";
                    $colorStmt = $conn->prepare($sqlColors);
                    $colorStmt->bind_param("i", $row['product_id']);
                    $colorStmt->execute();
                    $resultColors = $colorStmt->get_result();

                    $colors = [];
                    while ($colorRow = $resultColors->fetch_assoc()) {
                        $colors[] = htmlspecialchars($colorRow['color']);
                    }
                    $colorsString = implode(", ", $colors);

                    // Calculate average rating for the product
                    $sqlAverageRating = "SELECT AVG(rating) as average_rating FROM product_ratings WHERE product_id = ?";
                    $ratingStmt = $conn->prepare($sqlAverageRating);
                    $ratingStmt->bind_param("i", $row['product_id']);
                    $ratingStmt->execute();
                    $ratingResult = $ratingStmt->get_result();
                    $ratingRow = $ratingResult->fetch_assoc();
                    $averageRating = $ratingRow['average_rating'] ? round($ratingRow['average_rating'], 1) : 0;

                    $stars = str_repeat("★", floor($averageRating)) . str_repeat("☆", 5 - floor($averageRating));

                    echo '
                        <div class="col">
                            <div class="product-card">
                                <img src="' . $image_url . '" alt="' . htmlspecialchars($row['name']) . '">
                                <div class="product-card-body">
                                    <h5>' . htmlspecialchars($row['name']) . '</h5>
                                    <p><strong>Category:</strong> ' . htmlspecialchars($row['category']) . '</p>
                                    <p><strong>Subcategory:</strong> ' . htmlspecialchars($row['sub_category']) . '</p>
                                    <p><strong>Second Subcategory:</strong> ' . htmlspecialchars($row['second_sub_category']) . '</p>
                                    <p><strong>Colors:</strong> ' . $colorsString . '</p>
                                    <p><strong>Product ID:</strong> ' . htmlspecialchars($row['product_id']) . '</p>
                                    <p class="price">LKR ' . number_format($row['price'], 2) . '</p>
                                    <p class="rating">Rating: ' . $stars . '</p>
                                    <a href="' . BASE_URL . '/pages/product-details.php?product-id=' . $row['product_id'] . '" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo '<p class="text-center">No products found for this selection.</p>';
            }

            $stmt->close();
            ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
