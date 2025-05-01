<?php
session_start();
require_once __DIR__ . '/../admin/config/db.php';

$cart = $_SESSION['cart'] ?? [];
$cart_items = [];
$subtotal = 0;
$shipping = 7.01; // Fixed shipping

if (!empty($cart)) {

    $placeholders = implode(',', array_fill(0, count($cart), '?'));
    $product_ids = array_keys($cart);

    $stmt = $pdo->prepare("SELECT id, title, price, thumbnail AS image FROM products WHERE id IN ($placeholders)");
    $stmt->execute($product_ids);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        $id = $product['id'];
        $quantity = $cart[$id]['quantity'];
        $line_total = $product['price'] * $quantity;

        $cart_items[] = [
            'id' => $id,
            'title' => $product['title'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => $quantity,
            'line_total' => $line_total,
        ];

        $subtotal += $line_total;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Cart - Shopify</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">
    <link rel="stylesheet" href="../all.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <img style="height: 50px; margin-right: 10px;" src="../pic/logo (2).png" alt="Logo">
                <h3 style="color: whitesmoke;" class="mb-0">Shopify</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><i id="bar" class="fa-solid fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </li>

                    <!-- Profile Section -->
                    <li class="nav-item dropdown">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <?php
                            // Get user data
                            $stmt = $pdo->prepare("SELECT name, profile_picture FROM users WHERE id = ?");
                            $stmt->execute([$_SESSION['user_id']]);
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="uploads/profiles/person.jpg" <?= htmlspecialchars($user['profile_picture'] ?? 'person.jpg') ?>"
                                    class="profile-pic rounded-circle"
                                    style="width: 35px; height: 35px; object-fit: cover;"
                                    alt="">
                                <span class="ms-2 d-none d-lg-inline" style="color: white;">
                                    <?= htmlspecialchars($user['name']) ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="main/profile.php">
                                        <i class="fas fa-user me-2"></i>Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="main/logout.php">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        <?php else: ?>
                            <div class="d-flex gap-2">
                                <a href="main/login.php" class="btn btn-outline-light">Login</a>
                                <a href="main/register.php" class="btn btn-primary">Register</a>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cart Table Section -->
    <section id="cart" class="cart-container container my-5">
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <!-- ... [keep table headers] ... -->
                </thead>

                <tbody>
    <?php if (empty($cart_items)): ?>
        <tr>
            <td colspan="6" class="text-center py-4">Your cart is currently empty.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($cart_items as $item):
            $line_total = $item['price'] * $item['quantity'];
            $subtotal += $line_total;
        ?>
            <tr>
                <!-- Delete button -->
                <td>
                    <a href="cart_remove.php?id=<?= htmlspecialchars($item['id']) ?>" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>

                <!-- Product Image -->
                <td>
                    <img class="img-fluid"
                         src="<?= htmlspecialchars($item['image']) ?>"
                         alt="<?= htmlspecialchars($item['title']) ?>"
                         style="max-width: 80px;">
                </td>

                <!-- Product Title -->
                <td>
                    <h6 class="mb-0"><?= htmlspecialchars($item['title']) ?></h6>
                </td>

                <!-- Product Price -->
                <td>
                    <p class="mb-0">$<?= number_format($item['price'], 2) ?></p>
                </td>

                <!-- Quantity Input -->
                <td>
                    <form action="cart_update.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']) ?>">
                        <input class="form-control form-control-sm w-50 mx-auto"
                               name="quantity"
                               value="<?= htmlspecialchars($item['quantity']) ?>"
                               min="1"
                               type="number">
                    </form>
                </td>

                <!-- Line Total -->
                <td>
                    <p class="mb-0 fw-bold">$<?= number_format($line_total, 2) ?></p>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>
            </table>
        </div>
    </section>

    <!-- Cart Totals Section -->
    <section id="cart-bottom" class="container mb-5">
        <div class="row justify-content-end">
            <div class="col-lg-6 col-md-7 col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Cart Totals</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <span class="fw-bold">$<?= number_format($subtotal, 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span class="fw-bold">$<?= number_format($shipping, 2) ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold mb-4">
                            <span>Grand Total</span>
                            <span>$<?= number_format($subtotal + $shipping, 2) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ... [keep existing footer and scripts] ... -->
</body>

</html>