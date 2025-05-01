<?php
session_start();
require_once __DIR__ . '/../admin/config/db.php';

if (isset($_GET['id'])) {
    $product_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['info_message'] = 'Item removed from cart';
                break;
            }
        }
        // Re-index array after removal
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    } else {
        $_SESSION['error_message'] = 'Cart is already empty';
    }
}

header('Location: cart.php');
exit();
?>