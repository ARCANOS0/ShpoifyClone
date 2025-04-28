<?php
session_start(); // Start session if needed for cart count, etc.
// Adjust the path based on shop.php being in main/
require_once __DIR__ . '/../admin/config/db.php';

// --- Fetch Products from Database ---
try {
    // Select available products, order them as desired (e.g., by name)
    // Consider adding pagination later for many products
    $stmt = $pdo->query("SELECT id, name, price, image_url, rating FROM products WHERE is_available = 1 ORDER BY name ASC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Shop Product Fetch Error: " . $e->getMessage());
    $products = []; // Ensure $products is an array even on error
    $errorMessage = "Could not load products at this time. Please try again later.";
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Shop - Shopify</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Favicon Path relative to main/shop.php -->
    <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">

    <!-- Your Custom CSS (Load AFTER Bootstrap) - Path relative to main/shop.php -->
    <link rel="stylesheet" href="../all.css">

    <!-- Optional: Add specific styles for shop page if needed -->
     <style>
        /* Use style from all.css for .product img height */
        /* .product img.product-image {
             height: 250px;
             width: 100%;
             object-fit: contain;
             margin-bottom: 1rem;
         } */

        /* Make cards clickable (optional) */
        .product.card {
            cursor: pointer; /* Use default cursor from all.css if preferred */
        }

        /* Ensure consistent card height */
        .card {
            height: 100%;
        }
        /* Ensure card body takes remaining height */
        .card-body {
             display: flex;
             flex-direction: column;
             justify-content: space-between; /* Pushes button down */
         }
         /* Adjust star styling if needed */
         .star {
             /* padding from all.css applies */
             /* margin-bottom: 0.5rem; */
             /* font-size from all.css applies */
             color: #ffc107; /* Use Bootstrap's yellow or your custom color */
         }
         /* Ensure price stands out */
         .p-price {
            font-weight: bold;
            /* color: #dc3545; /* Example color */
         }
         /* Ensure button styling is correct - relies on all.css */
         .buy-btn {
             /* background-color from all.css applies */
             /* color from all.css applies */
             /* etc. */
             width: 80%; /* Example: make button slightly narrower */
             margin: 0 auto; /* Center button */
         }
    </style>

</head>

<body>

    <!-- Include Navbar -->
    <?php
        // Assuming navbar snippet is at root level in 'snippets' folder
        // Ensure this navbar includes the Search Modal trigger
        require_once __DIR__ . '/../snippets/navbar.php'; // Adjust path if needed
    ?>

    <!-- Main Shop Content -->
    <section class="py-5 mt-3">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Shop Our Collection</h2>
                <p class="lead text-muted">Explore random stuff, we have always offers, maybe you will find something you want!</p>
            </div>

            <!-- Display Error Message if Products Failed to Load -->
             <?php if (isset($errorMessage)): ?>
                <div class="alert alert-warning text-center"><?php echo $errorMessage; ?></div>
             <?php endif; ?>

            <!-- Products Grid -->
            <!-- Adjust row-cols-* for desired layout -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

                <?php if (empty($products) && !isset($errorMessage)): ?>
                    <div class="col-12">
                        <p class="alert alert-info text-center">No products currently available.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col">
                            <!-- Apply .product class from all.css to the card -->
                            <div class="product card shadow-sm border-0">
                                <!-- Link wraps the image -->
                                <a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>"
                                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                                         class="card-img-top product-image"> <!-- Use product-image class if defined -->
                                </a>
                                <div class="card-body text-center">
                                    <!-- Star Rating - Dynamic -->
                                    <div class="star">
                                         <?php
                                            $rating = $product['rating'] ?? 0; // Default to 0 if null
                                            $fullStars = floor($rating);
                                            $halfStar = ($rating - $fullStars) >= 0.5;
                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                         ?>
                                         <?php for ($i = 0; $i < $fullStars; $i++): ?><i class="fas fa-star"></i><?php endfor; ?>
                                         <?php if ($halfStar): ?><i class="fas fa-star-half-alt"></i><?php endif; ?>
                                         <?php for ($i = 0; $i < $emptyStars; $i++): ?><i class="far fa-star"></i><?php endfor; ?>
                                    </div>
                                    <!-- Product Name - Dynamic -->
                                    <h5 class="p-name card-title fs-6 fw-bold">
                                         <a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="text-decoration-none text-dark">
                                           <?php echo htmlspecialchars($product['name']); ?>
                                         </a>
                                    </h5>
                                    <!-- Product Price - Dynamic -->
                                    <h4 class="p-price">$<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></h4>
                                    <!-- Button/Link - Dynamic -->
                                    <!-- Use a link styled as a button to go to details page -->
                                    <a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-primary buy-btn mt-auto"> <!-- mt-auto pushes button down -->
                                        View Details
                                    </a>
                                    <!-- If implementing direct Add to Cart AJAX, use a button instead -->
                                    <!-- <button class="btn btn-primary buy-btn add-to-cart-btn mt-auto" data-product-id="<?php //echo $product['id']; ?>">Add to Cart</button> -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div> <!-- End .row -->

            <!-- Optional: Add Pagination Links Here -->

        </div> <!-- End .container -->
    </section>


    <!-- Include Footer -->
    <?php
        require_once __DIR__ . '/../snippets/footer.php'; // Adjust path if needed
    ?>

    <!-- Search Modal HTML (Include ONCE per page) -->
     <?php
        require_once __DIR__ . '/../snippets/search_modal.php'; // Adjust path if needed
     ?>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <!-- Add specific JS for this page if needed -->
    <!-- <script src="../js/shop.js"></script> -->
</body>

</html>