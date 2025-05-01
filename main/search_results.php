<?php
// No database connection needed YET, using array
require_once __DIR__ . '/../admin/config/db.php';
session_start();


// --- Product Data Array (Your current data source) ---
// Make sure this array contains ALL products you want searchable
// Ensure image paths are correct relative to THIS search_results.php file
// --- Get and Sanitize Search Query ---
$searchQuery = '';
if (isset($_GET['query'])) {
    // Trim whitespace and prevent basic HTML injection for display
    $searchQuery = trim(htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8'));
}



?>
<!doctype html>
<html lang="en">

<head>
    <title>Search Results for "<?php echo $searchQuery; ?>" - Shopify</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">

    <!-- Your Custom CSS Files -->
    <link rel="stylesheet" href="../all.css">
    <!-- Add specific styles if needed for product cards -->
    <style>
        .product img {
            height: 220px;
            object-fit: cover;
        }

        .product .card-body {
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 0.8rem;
            /* Slightly smaller padding */
        }

        .product .price {
            font-weight: bold;
            color: #dc3545;
            /* Example price color */
        }

        .star i {
            color: #ffc107;
            /* Gold color for stars */
            font-size: 0.8em;
            /* Smaller stars */
        }

        .product .card-title {
            font-size: 0.95rem;
            /* Slightly smaller title */
            margin-bottom: 0.4rem;
        }

        .product .buy-btn {
            padding: 0.3rem 0.8rem;
            /* Smaller button */
            font-size: 0.9em;
        }
    </style>

</head>

<body>
 
    <!-- ============================ -->
    <!--   START: Combined Navbar     -->
    <!-- ============================ -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light py-3">
        <!-- Use container for better centering/margins -->
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="../index.php"> <!-- Make logo/name a link -->
                <img style="height: 50px; margin-right: 10px;" src="../pic/logo (2).png" alt="Logo">
                <!-- Removed margin from h3 for better alignment -->
                <h3 style="color: whitesmoke;" class="mb-0">Shopify</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <!-- Ensure Font Awesome is loaded correctly for this icon -->
                <span><i id="bar" class="fa-solid fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Use ms-auto for Bootstrap 5 margin, align-items-center for vertical alignment -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item">
                        <!-- Assuming index.php is in the root -->
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart <i class="fa-solid fa-cart-shopping"></i></a>
                    </li>
                    <!-- Search Icon as Modal Trigger -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </li>
                    <!-- Removed the standalone icon from here -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- ============================ -->
    <!--    END: Combined Navbar      -->
    <!-- ============================ -->


    <!-- ============================ -->
    <!--   Search Modal HTML Block    -->
    <!-- (Place this code elsewhere in your HTML body, e.g., before the closing </body> tag) -->
    <!-- ============================ -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Search Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Search Form pointing to search_results.php -->
                    <!-- Ensure the 'action' path is correct relative to the page the navbar is on -->
                    <form action="main/search_results.php" method="GET" role="search">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" placeholder="Enter product name, keyword..." aria-label="Search query" name="query" required>
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ -->
    <!-- END: Search Modal HTML Block -->
    <!-- ============================ -->
    <!-- php search snippet -->

    <!-- Search Results Section -->
    <section id="search-results" class="container my-5 pt-5">
        <h2 class="fw-bold mb-3">Search Results</h2>

        <?php if (!empty($searchQuery)): ?>
            <p class="lead mb-4">Showing results for: <strong>"<?php echo $searchQuery; ?>"</strong></p>
            <hr>
        <?php elseif (isset($_GET['query'])): // Check if query was submitted but empty 
        ?>
            <div class="alert alert-warning">Please enter a search term to find products.</div>
        <?php endif; ?>


        <?php if (!empty($results)): // Check if $results array has items 
        ?>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4"> <?php // Responsive grid 
                                                                                        ?>
                <?php foreach ($results as $product): ?>
                    <div class="col">
                        <div class="card h-100 product shadow-sm border-0">
                            <a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="Product image">
                                class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </a>
                            <div class="card-body text-center">
                                <div>
                                    <!-- Optional: Star Rating -->
                                    <div class="star mb-1">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <i class="fa<?php echo ($i < $product['rating']) ? 's' : 'r'; ?> fa-star"></i> <?php // Solid or regular star 
                                                                                                                            ?>
                                        <?php endfor; ?>
                                    </div>
                                    <h5 class="card-title">
                                        <a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="text-decoration-none text-dark">
                                            <?php echo htmlspecialchars($product['name']); ?>
                                        </a>
                                    </h5>
                                    <p class="price fs-5 mb-2">$<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></p>
                                </div>
                                <a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-outline-primary buy-btn mt-auto">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($searchQuery)): // Only show 'no results' if a query was actually entered 
        ?>
            <div class="alert alert-info text-center mt-4" role="alert">
                <i class="fas fa-info-circle me-2"></i> No products found matching your search: "<?php echo $searchQuery; ?>"
            </div>
        <?php endif; ?>

    </section>

    <!-- Include Footer -->
    <?php
    // Adjust path relative to search_results.php
    // include('footer.php'); // or '../footer.php' or 'snippets/footer.php' etc.
    ?>
    <!-- START: Copied Footer (Replace with include('path/to/footer.php'); later) -->
    <footer class="footer mt-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
                    <h4>Team</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
                    <h4>Get Help</h4>
                    <ul>
                        <li><a href="FAQ.html">FAQ</a></li>
                        <li><a href="#">Returning</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Payment Methods</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
                    <h4>Categories</h4>
                    <ul>
                        <li><a href="#">Best Seller</a></li>
                        <li><a href="Kitchen.html">Kitchen</a></li>
                        <li><a href="#">Clothing</a></li>
                        <li><a href="#">Shoes</a></li>
                        <li><a href="#">Electrical Appliance</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
                    <h4>Follow Us</h4>
                    <div class="socialLinks"> <a href="#"> <i class="fab fa-facebook-f"></i></a> <a href="#"> <i class="fab fa-instagram"></i></a> <a href="#"> <i class="fab fa-linkedin-in"></i></a> </div>
                </div>
            </div>
            <hr class="mt-4" style="border-color: rgba(255,255,255,0.2);">
            <div class="text-center text-muted mt-3">
                <p>© <?php echo date("Y"); ?> Shopify. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <!-- END: Copied Footer -->


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

</body>

</html>