<?php
session_start();
require_once __DIR__ . '/../admin/config/db.php';

// --- Get Product ID from URL ---
$product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$product = null;
$errorMessage = null;

if ($product_id === false || $product_id <= 0) {
    $errorMessage = "Invalid Product ID specified.";
} else {
    try {
        $stmt = $pdo->prepare("SELECT p.*, c.name as category_name
                              FROM products p
                              LEFT JOIN categories c ON p.category_id = c.id
                              WHERE p.id = ? AND p.is_available = 1");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            $errorMessage = "Product not found or is unavailable.";
        }
    } catch (PDOException $e) {
        error_log("Product Details Fetch Error: " . $e->getMessage());
        $errorMessage = "Could not load product details at this time.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title><?= isset($product['name']) ? htmlspecialchars($product['name']) : 'Product Details' ?> - Shopify</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">
    <link rel="stylesheet" href="../all.css">
    <link rel="stylesheet" href="../snippets/product.css">

</head>

<body>
    <!-- Navbar (keep your existing navbar code) -->

    <section class="container details my-5 pt-5">
        <div class="row mt-5">
            <?php if ($product): ?>
            <div class="col-lg-5 col-md-12 col-12">
                <img class="img-fluid w-100 product-image" 
                     src="<?= htmlspecialchars($product['thumbnail']) ?>" 
                     alt="<?= htmlspecialchars($product['title']) ?>">
            </div>

            <div class="col-lg-6 col-md-12 col-12">
                <!-- Product Category and Brand -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-primary">
                        <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?>
                    </span>
                    <?php if (!empty($product['brand'])): ?>
                    <span class="product-brand">
                        <i class="fas fa-tag"></i>
                        <?= htmlspecialchars($product['brand']) ?>
                    </span>
                    <?php endif; ?>
                </div>

                <!-- Product Name -->
                <h1 class="mb-3"><?= htmlspecialchars($product['title']) ?></h1>

                <!-- Rating -->
                <div class="product-rating">
                    <div class="rating-stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?= $i <= round($product['rating'] ?? 0) ? ' text-warning' : ' text-secondary' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <span class="text-muted">
                        (<?= number_format($product['rating'] ?? 0, 1) ?> / 5)
                    </span>
                </div>

                <!-- Price -->
                <h2 class="text-primary mb-4">
                    $<?= number_format($product['price'], 2) ?>
                </h2>

                <!-- Product Meta -->
                <div class="product-meta">
                    <?php if (!empty($product['stock_quantity'])): ?>
                    <div class="product-meta-item">
                        <i class="fas fa-box-open text-success"></i>
                        <span><?= htmlspecialchars($product['stock_quantity']) ?> in stock</span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($product['views'])): ?>
                    <div class="product-meta-item">
                        <i class="fas fa-eye text-info"></i>
                        <span><?= htmlspecialchars($product['views']) ?> views</span>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Add to Cart Form -->
                <form action="cart_add.php" method="POST" class="mt-4">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                    
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="quantityInput" class="col-form-label">Quantity:</label>
                        </div>
                        <div class="col-auto" style="max-width: 100px;">
                            <input type="number" class="form-control" 
                                   id="quantityInput" name="quantity" 
                                   value="1" min="1" max="<?= $product['stock_quantity'] ?? 100 ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-cart-plus me-2"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Product Details -->
                <div class="product-details mt-5">
                    <h4 class="mb-3">Product Details</h4>
                    <div class="card">
                        <div class="card-body">
                            <?php if (!empty($product['description'])): ?>
                                <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                            <?php else: ?>
                                <p class="text-muted">No description available for this product.</p>
                            <?php endif; ?>
                            
                            <!-- Additional Details -->
                            <?php if (!empty($product['specs'])): ?>
                            <div class="mt-4">
                                <h5>Specifications</h5>
                                <ul class="list-unstyled">
                                    <?php $specs = json_decode($product['specs'], true); ?>
                                    <?php foreach ($specs as $key => $value): ?>
                                        <li>
                                            <strong><?= htmlspecialchars($key) ?>:</strong>
                                            <?= htmlspecialchars($value) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php else: ?>
            <div class="col-12 text-center py-5">
                <div class="alert alert-danger" role="alert">
                    <?= $errorMessage ?? 'Product not found' ?>
                </div>
                <a href="shop.php" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-left me-2"></i>Back to Shop
                </a>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer (keep your existing footer code) -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>