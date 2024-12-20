<?php 
    include_once('../../config/config.php'); 
    $page_title = 'FAQ';
    include_once('../../includes/head-links.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <style>
        .faq-section {
            padding: 50px;
            background-color: #f9f9f9;
        }
        .faq-title {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .accordion-button {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

    <!-- Header -->
        <?php include '../../includes/header.php'; ?>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="faq-title">Frequently Asked Questions</h2>

            <div class="accordion" id="faqAccordion">

                <!-- FAQ Item 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                            1. What is VELVET VOGUE?
                        </button>
                    </h2>
                    <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne">
                        <div class="accordion-body">
                            <b>VELVET VOGUE</b> is an online clothing store offering a variety of stylish and timeless fashion items for men, women, and children.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                            2. How do I track my order?
                        </button>
                    </h2>
                    <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo">
                        <div class="accordion-body">
                            After placing an order, you'll receive a confirmation email with a tracking number. Use this number to track your package on our "Order Tracking" page.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                            3. What is the return policy?
                        </button>
                    </h2>
                    <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree">
                        <div class="accordion-body">
                            We accept returns within 30 days of purchase on most items. The item must be in its original condition and packaging. Please visit our "Returns & Exchanges" page for more details.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                            4. How do I subscribe to your newsletter?
                        </button>
                    </h2>
                    <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour">
                        <div class="accordion-body">
                            To subscribe, visit our "Subscribe to Newsletter" page and enter your email address. Subscribers receive exclusive discounts, style tips, and updates on new arrivals.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFive" aria-expanded="false" aria-controls="faqCollapseFive">
                            5. Can I change or cancel my order?
                        </button>
                    </h2>
                    <div id="faqCollapseFive" class="accordion-collapse collapse" aria-labelledby="faqHeadingFive">
                        <div class="accordion-body">
                            Yes, you can change or cancel your order within 24 hours of placing it. Please contact our customer support team for assistance.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Footer -->
        <?php include '../../includes/footer.php'; ?>



    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
