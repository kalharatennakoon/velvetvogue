<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women's Category - Velvet Vogue</title>

    <!-- add icon link -->
    <link rel="icon" href="./assets/images/logo.png" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    
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

    <!-- config.php file  -->
        <?php include_once('../../config/config.php'); ?>

    <!-- Header -->
        <?php include '../../includes/header.php'; ?>

    <!-- Main Content -->
    <section class="category-section">
        <div class="container">
            <h2 class="text-center mb-5">Women's Categories</h2>
            <div class="row justify-content-center">
                <!-- Men Casual Wear Card -->
                <div class="col-md-4 mb-4">
                    <a href="casual-wear/casual-wear.php" class="text-decoration-none">
                        <div class="category-card p-4 text-center">
                            <div class="category-title">Casual Wear</div>
                            <p>Explore our selection of casual wear for women.</p>
                        </div>
                    </a>
                </div>
                <!-- Men Formal Wear Card -->
                <div class="col-md-4 mb-4">
                    <a href="formal-wear/formal-wear.php" class="text-decoration-none">
                        <div class="category-card p-4 text-center">
                            <div class="category-title">Formal Wear</div>
                            <p>Discover our range of formal wear for women.</p>
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
