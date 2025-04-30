<?php
// MUST be the very first line
session_start();

// 1. Include Database Connection
// Adjust the path as necessary relative to cart_add.php
require_once __DIR__ . '/../admin/config/db.php';

// 2. Get Input Data from POST request
// Use filter_input for security and validation
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$quantity   = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

// Default redirection target (can be changed on error)
$redirect_page = 'cart.php'; // Redirect to cart page by default

// 3. --- Input Validation ---
if ($product_id === false || $product_id <= 0) {
    // Invalid or missing product ID
    $_SESSION['error_message'] = "Invalid product specified.";
    header('Location: shop.php'); // Redirect back to shop if product invalid
    exit;
}

if ($quantity === false || $quantity <= 0) {
    // Invalid or missing quantity, default to 1 if product ID was valid
    $quantity = 1;
    // Optionally set a message: $_SESSION['info_message'] = "Quantity defaulted to 1.";
}

// 4. --- Check if Product Exists in Database (Good Practice) ---
try {
    $stmt_check = $pdo->prepare("SELECT id, name, stock_quantity FROM products WHERE id = ? AND is_available = 1");
    $stmt_check->execute([$product_id]);
    $product_exists = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if (!$product_exists) {
        // Product doesn't exist or isn't available
        $_SESSION['error_message'] = "Sorry, this product is not available.";
        header('Location: shop.php'); // Redirect back to shop
        exit;
    }

    // Optional: Check stock (basic example)
    // if ($product_exists['stock_quantity'] < $quantity) {
    //     $_SESSION['error_message'] = "Sorry, only " . $product_exists['stock_quantity'] . " units available for " . htmlspecialchars($product_exists['name']) . ".";
    //     // Redirect back to the product page might be better here
    //     header('Location: product_details.php?id=' . $product_id);
    //     exit;
    // }

} catch (PDOException $e) {
    error_log("Error checking product existence: " . $e->getMessage());
    $_SESSION['error_message'] = "An error occurred while adding the item. Please try again.";
    header('Location: shop.php'); // Redirect to shop on DB error
    exit;
}


// 5. --- Initialize Cart in Session (if it doesn't exist) ---
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 6. --- Add/Update Item in Session Cart ---
if (isset($_SESSION['cart'][$product_id])) {
    // Product already in cart - Increase quantity
    // Optional: Check stock again if combined quantity exceeds stock
    // $new_total_quantity = $_SESSION['cart'][$product_id]['quantity'] + $quantity;
    // if ($product_exists['stock_quantity'] < $new_total_quantity) { ... handle error ... }

    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    $message = htmlspecialchars($product_exists['name']) . " quantity updated in your cart.";

} else {
    // Product not in cart - Add as new item
     $_SESSION['cart'][$product_id] = [
        'quantity' => $quantity
        // Storing only quantity is simplest.
        // Cart page should fetch current name/price/image from DB anyway.
     ];
     $message = htmlspecialchars($product_exists['name']) . " added to your cart.";
}

// 7. --- Set Success Feedback Message ---
$_SESSION['success_message'] = $message;


// 8. --- Redirect User ---
header('Location: ' . $redirect_page);
exit; // ALWAYS exit after a header redirect

?>