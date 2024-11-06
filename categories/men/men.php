<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Men's Category - Velvet Vogue</title>

    <!-- config.php file  -->
        <?php include_once('../../config/config.php'); ?>

    <!-- head-link.php file -->
        <?php include_once('../../includes/head-links.php'); ?>

    
    <!-- Custom CSS -->
    <style>
        .category-section {
            padding: 50px 0;
        }
        .category-card {
            transition: transform 0.3s;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .category-card:hover {
            transform: scale(1.05);
        }
        .category-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <!-- Header -->
        <?php include '../../includes/header.php'; ?>

    <!-- Main Content -->
    <section class="category-section">
        <div class="container">
            <h2 class="text-center mb-5">Men's Categories</h2>
            <div class="row justify-content-center">
                <!-- Men Casual Wear Card -->
                <div class="col-md-4 mb-4">
                    <a href="casual-wear/casual-wear.php" class="text-decoration-none">
                        <div class="category-card p-4 text-center">
                            <div class="category-title">Casual Wear</div>
                            <p>Explore our selection of casual wear for men.</p>
                        </div>
                    </a>
                </div>
                <!-- Men Formal Wear Card -->
                <div class="col-md-4 mb-4">
                    <a href="formal-wear/formal-wear.php" class="text-decoration-none">
                        <div class="category-card p-4 text-center">
                            <div class="category-title">Formal Wear</div>
                            <p>Discover our range of formal wear for men.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
        <?php include '../../includes/footer.php'; ?>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
