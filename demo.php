<?php
// Start session if needed for cart count, user status etc.
session_start();
// Include the PDO database connection ($pdo is created here)
require_once __DIR__ . '/admin/config/db.php'; // Path relative to index.php

// --- Fetch Products from Database ---
$products = []; // Initialize as empty array
$errorMessage = null; // Initialize error message

try {
    // Fetch available products - you might want to add LIMIT or ORDER BY later
    // e.g., ORDER BY created_at DESC LIMIT 8 to show newest 8 products
    $stmt = $pdo->query("SELECT id, name, price, image_url, rating, description FROM products WHERE is_available = 1 ORDER BY created_at DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Homepage Product Fetch Error: " . $e->getMessage());
    $errorMessage = "Could not load products. Please try again later.";
    // $products remains empty
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Shopify - Your E-commerce Destination</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Your E-commerce Site Description">

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Favicon Path relative to index.php -->
    <link rel="shortcut icon" href="pic/logo (2).png" type="image/x-icon">

    <!-- Your Custom CSS (Load AFTER Bootstrap) - Path relative to index.php -->
    <link rel="stylesheet" href="all.css">

     <style>
        /* Re-use or adjust styles from shop.php if needed */
        .product img.card-img-top {
             /* height: 250px; /* Example */
             object-fit: contain;
             padding-top: 10px;
         }
        .card { height: 100%; }
        .card-body { display: flex; flex-direction: column; justify-content: space-between; }
        .star { color: #ffc107; }
        .buy-btn { width: 80%; margin: 0 auto; }
        /* Add any homepage specific styles */
        .hero-section { /* Example */
            background-color: #f8f9fa;
            padding: 4rem 0;
            margin-bottom: 2rem;
        }
    </style>

</head>

<body>

    <!-- Include Navbar -->

    <!-- Optional: Hero/Banner Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1>Welcome to Shopify!</h1>
            <p class="lead text-muted">Your one-stop shop for amazing products.</p>
            <a href="main/shop.php" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </section>

    <!-- Main Product Display Section -->
    <div class="container my-5">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Featured Products</h2>
            <!-- Or just "Products" -->
        </div>

        <!-- Display Error Message if Products Failed to Load -->
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-warning text-center"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <!-- Products Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

            <?php if (empty($products) && !isset($errorMessage)): ?>
                <div class="col-12">
                    <p class="alert alert-info text-center">No products to display right now.</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="col">
                        <div class="product card shadow-sm border-0 h-100">
                            <a href="main/product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                                <img src="<?php echo htmlspecialchars($product['image_url'] ?? 'pic/placeholder.png'); // Provide a default placeholder ?>"
                                     alt="<?php echo htmlspecialchars($product['name']); ?>"
                                     class="card-img-top">
                            </a>
                            <div class="card-body text-center">
                                <div>
                                    <div class="star mb-2">
                                        <?php
                                            $rating = $product['rating'] ?? 0;
                                            $fullStars = floor($rating);
                                            $halfStar = ($rating - $fullStars) >= 0.5;
                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                        ?>
                                        <?php for ($i = 0; $i < $fullStars; $i++): ?><i class="fas fa-star"></i><?php endfor; ?>
                                        <?php if ($halfStar): ?><i class="fas fa-star-half-alt"></i><?php endif; ?>
                                        <?php for ($i = 0; $i < $emptyStars; $i++): ?><i class="far fa-star"></i><?php endfor; ?>
                                    </div>
                                    <h5 class="card-title p-name fs-6 fw-bold">
                                        <a href="main/product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="text-decoration-none text-dark">
                                           <?php echo htmlspecialchars($product['name']); ?>
                                        </a>
                                    </h5>
                                    <!-- Optionally display short description -->
                                    <!-- <p class="card-text small text-muted mb-2"> <?php // echo htmlspecialchars(substr($product['description'], 0, 50)) . '...'; ?> </p> -->
                                    <h4 class="p-price mb-3">$<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></h4>
                                </div>
                                <a href="main/product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-primary buy-btn mt-auto">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div> <!-- End .row -->
    </div> <!-- End .container -->




    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>