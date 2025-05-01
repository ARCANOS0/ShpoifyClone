<?php
session_start();
require_once __DIR__ . '/../admin/config/db.php';

// 1. Get POST data
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$quantity   = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

// 2. Validate input
if (!$product_id || $product_id <= 0) {
    $_SESSION['error_message'] = "Invalid product ID.";
    header("Location: shop.php");
    exit;
}
if (!$quantity || $quantity <= 0) {
    $quantity = 1;
}

// 3. Fetch full product details
$stmt = $pdo->prepare("SELECT id, title, price, thumbnail AS image FROM products WHERE id = ? AND is_available = 1");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    $_SESSION['error_message'] = "Product not found or unavailable.";
    header("Location: shop.php");
    exit;
}

// 4. Initialize cart
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 5. Add/update cart item
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
} else {
    $_SESSION['cart'][$product_id] = [
        'id'       => $product['id'],
        'title'    => $product['title'],
        'price'    => $product['price'],
        'image'    => $product['image'],
        'quantity' => $quantity
    ];
}

$_SESSION['success_message'] = "{$product['title']} added to cart!";
header("Location: cart.php");
exit;
