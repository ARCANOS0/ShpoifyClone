<?php
session_start();
require_once __DIR__ . '/../admin/config/db.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, 
        ['options' => ['min_range' => 1, 'default' => 1]]
    );

    if (!$product_id) {
        throw new Exception('Invalid product ID');
    }

    // Fetch product details from database
    $stmt = $pdo->prepare("
        SELECT id, title, price, thumbnail 
        FROM products 
        WHERE id = :id
    ");
    $stmt->execute([':product_id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        throw new Exception('Product not found');
    }

    // Initialize cart if not exists
    $_SESSION['cart'] = $_SESSION['cart'] ?? [];

    // Check if product already in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $product['id']) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    // Add new item if not found
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $product['id'],
            'title' => $product['title'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'image' => $product['thumbnail']
        ];
    }

    $_SESSION['success_message'] = "{$product['title']} added to cart";
    
} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
}

header('Location: ' . $_SERVER['HTTP_REFERER'] ?? 'index.php');
exit();
?>