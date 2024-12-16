<!-- Purpose: Footer for the website -->
<html>
<body>

<footer class="text-white bg-dark text-center text-lg-start p-4">
    <section>
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
                <!-- Company Info -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">velvet vogue</h6>
                    <p>Timeless fashion, modern luxury. Discover your style, crafted just for you.</p>
                </div>

                <!-- About Us Links -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">about Us</h6>
                    <p><a href="<?php echo BASE_URL; ?>/pages/links/privacy-policy.php" class="text-white">Privacy Policy</a></p>
                    <p><a href="<?php echo BASE_URL; ?>/pages/links/terms-and-conditions.php" class="text-white">Terms and Conditions</a></p>
                    <p><a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#subscribeModal">Subscribe to Newsletter</a></p>
                </div>

                <!-- Useful Links -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">useful links</h6>
                    <p><a href="<?php echo BASE_URL; ?>/pages/links/faq.php" class="text-white text-uppercase ">faq</a></p>
                    <p><a href="<?php echo BASE_URL; ?>/pages/links/customer-support.php" class="text-white">Customer Support</a></p>
                    <p><a href="<?php echo BASE_URL; ?>/pages/links/product-inquiry.php" class="text-white">Product Inquiry</a></p>
                </div>

                <!-- Contact Info -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold">contact</h6>
                    <p><i class="fa-solid fa-location-dot me-2"></i> Colombo, Western 10012, SL</p>
                    <p>
                        <a href="mailto:info@velvetvogue.com" class="text-white">
                            <i class="fa-solid fa-envelope me-2"></i> info@velvetvogue.com
                        </a>
                    </p>
                    <p>
                        <a href="tel:+94111234567" class="text-white" style="text-decoration: none;">
                            <i class="fa-solid fa-phone me-2"></i> +94 (011) 123 4567
                        </a>
                    </p>
                    <!-- Social Media Icons -->
                    <div class="mt-2">
                        <a href="https://www.facebook.com" class="text-white me-3" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com" class="text-white me-3" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com" class="text-white me-3" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://tiktok.com" class="text-white me-3" target="_blank"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Copyright -->
    <div class="text-center text-white mt-3 p-3 bg-dark">
        <small>© 2024 <span class="text-uppercase">velvet vogue</span> All rights reserved.</small>
    </div>

    <!-- Subscribe Modal -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title" id="subscribeModalLabel">Subscribe to our Newsletter</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Stay updated with the latest trends and offers.</p>
                    <form id="subscribeForm">
                        <div class="mb-3">
                            <label for="subscribeEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="subscribeEmail" placeholder="Enter your email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                    <div id="subscribeSuccessMessage" class="alert alert-success mt-3 d-none">
                        Thank you for subscribing!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("subscribeForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const email = document.getElementById("subscribeEmail").value;

            if (email) {
                document.getElementById("subscribeSuccessMessage").classList.remove("d-none");
                document.getElementById("subscribeForm").reset();

                setTimeout(() => {
                    document.getElementById("subscribeSuccessMessage").classList.add("d-none");
                    const subscribeModal = bootstrap.Modal.getInstance(document.getElementById("subscribeModal"));
                    subscribeModal.hide();
                }, 3000);
            }
        });
    </script>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>