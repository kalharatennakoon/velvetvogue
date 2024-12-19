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
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container mt-4">
        <h2>Search Results</h2>
        <?php
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchQuery = htmlspecialchars(trim($_GET['search']));
            echo "<p>Showing results for: <strong>$searchQuery</strong></p>";

            // Adjust the search logic based on the query
            $sql = "
                SELECT p.product_id, p.name, p.category, pi.image_url
                FROM products p
                LEFT JOIN product_images pi ON p.product_id = pi.product_id
                WHERE (p.name LIKE ? OR p.category LIKE ? OR p.sub_category LIKE ?)
                GROUP BY p.product_id";

            // If searching for "men", only show men's products
            if (strtolower($searchQuery) === "men") {
                $sql = "
                    SELECT p.product_id, p.name, p.category, pi.image_url
                    FROM products p
                    LEFT JOIN product_images pi ON p.product_id = pi.product_id
                    WHERE p.category = 'Men'
                    GROUP BY p.product_id";  // Ensure we get only the first image per product
            }

            if ($stmt = $conn->prepare($sql)) {
                $searchParam = "%" . $searchQuery . "%";
                if (strtolower($searchQuery) !== "men") {
                    $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
                }
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<div class="row">';
                    while ($row = $result->fetch_assoc()) {
                        // Construct the image URL (use placeholder if image_url is empty)
                        $image_url = !empty($row['image_url']) ? BASE_URL . '/' . PRODUCT_IMAGE_PATH . '/' . htmlspecialchars($row['image_url']) : BASE_URL . '/assets/images/placeholder.jpg';

                        // Now display the product details
                        echo '
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="' . $image_url . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">
                                    <div class="card-body">
                                        <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>
                                        <p class="card-text">Category: ' . htmlspecialchars($row['category']) . '</p>
                                        <p class="card-text">Product ID: ' . (isset($row['product_id']) && !empty($row['product_id']) ? $row['product_id'] : 'No ID available') . '</p>
                                        <a href="' . BASE_URL . '/pages/product-details.php?id=' . $row['product_id'] . '" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No products found.</p>';
                }
                $stmt->close();
            } else {
                echo '<p>Error: Unable to process your request.</p>';
            }
        } else {
            echo '<p>Please enter a search term.</p>';
        }
        ?>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
