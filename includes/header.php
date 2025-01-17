<!-- Purpose: Header for the website -->
<div class="sticky-top top-0 left-0 w-full z-40 shadow-md">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="navbar-brand" href="<?php echo BASE_URL; ?>/index.php"><span class="text-uppercase">velvet vogue</span></a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="<?php echo BASE_URL; ?>/pages/filter.php" method="get">
                <div class="input-group">
                    <input class="form-control border-end-0 border" type="search" placeholder="Search" name="search" id="search-input">
                    <button class="btn bg-white border-start-0 border-bottom border ms-n5" type="submit">
                        <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                    </button>
                </div>
                <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Wishlist">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-heart fa-lg text-white"></i>
                    </a>
                </button>
                <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cart">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-bag-shopping fa-lg text-white"></i>
                    </a>
                </button>
                <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Account">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>/pages/customer-login.php">
                        <i class="fa-solid fa-user fa-lg text-white"></i>
                    </a>
                </button>
            </form>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-secondary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center text-uppercase" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><small><a class="nav-link" href="<?php echo BASE_URL; ?>/pages/new-arrivals.php">new arrivals</a></small></li>
                    <li class="nav-item"><small><a class="nav-link" href="#">best sellers</a></small></li>
                    <li class="nav-item"><small><a class="nav-link" href="<?php echo BASE_URL; ?>/pages/women.php">women</a></small></li>
                    <li class="nav-item"><small><a class="nav-link" href="<?php echo BASE_URL; ?>/pages/men.php">men</a></small></li>
                    <li class="nav-item"><small><a class="nav-link" href="<?php echo BASE_URL; ?>/pages/kids.php">kids</a></small></li>
                    <li class="nav-item"><small><a class="nav-link" href="">gift cards</a></small></li>
                    <li class="nav-item"><small><a class="nav-link text-danger" href="<?php echo BASE_URL; ?>/pages/promotions.php">promotions</a></small></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
