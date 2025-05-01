<?php
session_start();
require_once '../includes/db.php';

if (!isset($_GET['query']) || empty(trim($_GET['query']))) {
    echo "No search query provided.";
    exit;
}

$query = "%" . $_GET['query'] . "%";

try {
    $stmt = $pdo->prepare("SELECT id, name, image_url, price, rating FROM products WHERE name LIKE :query OR description LIKE :query");
    $stmt->execute(['query' => $query]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Search Results for "<?php echo htmlspecialchars($_GET['query']); ?>"</h2>
    
    <?php if (empty($products)): ?>
        <p>No products found.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text">Price: $<?php echo number_format($product['price'], 2); ?></p>
                            <p class="card-text">Rating: <?php echo htmlspecialchars($product['rating']); ?></p>
                            <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Product</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
