<?php
session_start();
require_once __DIR__ . '/../admin/config/db.php';
require_once __DIR__ . '/product_card.php';

// Fetch categories with their products
try {
    $categories = [];
    
    // Get all categories
    $stmt = $pdo->query("
        SELECT c.id, c.name, COUNT(p.id) as product_count 
        FROM categories c
        LEFT JOIN products p ON c.id = p.category_id
        GROUP BY c.id
        ORDER BY product_count DESC
    ");
    
    while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Get products for each category
        $productStmt = $pdo->prepare("
            SELECT p.*, c.name as category_name 
            FROM products p
            JOIN categories c ON p.category_id = c.id
            WHERE c.id = ?
            LIMIT 4
        ");
        $productStmt->execute([$category['id']]);
        $category['products'] = $productStmt->fetchAll(PDO::FETCH_ASSOC);
        $categories[] = $category;
    }
} catch (PDOException $e) {
    error_log("Shop Page Error: " . $e->getMessage());
    $errorMessage = "Could not load products at this time.";
}
?>


<!doctype html>
<html lang="en">

<head>
  <title>Shopify</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.3.2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!-- Font Awesome (for stars) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Favicon Path relative to where this file will live (e.g., main/) -->
  <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">

  <!-- Your Custom CSS (Load AFTER Bootstrap) - Path relative to this file -->
  <link rel="stylesheet" href="../all.css">
  <link rel="stylesheet" href="../snippets/shop.css">

</head>

<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img style="height: 50px; margin-right: 10px;" src="pic/logo (2).png" alt="Logo">
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
                    <a class="nav-link" href="main/shop.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main/register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main/contact.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main/cart.php">Cart <i class="fa-solid fa-cart-shopping"></i></a>
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
                            <li><hr class="dropdown-divider"></li>
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

    <div class="container my-5">
        <?php if(isset($errorMessage)): ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php else: ?>
            <?php foreach ($categories as $category): ?>
                <div class="text-center mb-4 pt-5">
                    <h1><?= htmlspecialchars($category['name']) ?></h1>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
                    <?php foreach ($category['products'] as $product): ?>
                        <?php renderProductCard($product); ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>


  <!-- footer section -->
  <footer class="footer mt-5 py-3">
    <div class="row container mx-auto pt-5">

      <div class="containerF">
        <div class="row">
          <div class="footer-col">
            <h4>Team</h4>
            <ul>
              <li><a href="about.php">About Us</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Privacy Policy</a></li>

            </ul>
          </div>

          <div class="footer-col">
            <h4>Get Help</h4>
            <ul>
              <li><a href="FAQ.php">FAQ</a></li>
              <li><a href="#">Returning</a></li>
              <li><a href="#">Shipping</a></li>
              <li><a href="#">Payment Methods</a></li>

            </ul>
          </div>

          <div class="footer-col">
            <h4>Categories</h4>
            <ul>
              <li><a href="../index.php">Best Seller</a></li>
              <li><a href="kitchen.php">Kitchen</a></li>
              <li><a href="cloth.php">Clothing</a></li>
              <li><a href="shoes.php">Shoes</a></li>
              <li><a href="electrical.php">Electrical Appliance </a></li>



            </ul>
          </div>

          <div class="footer-col">
            <h4>Follow Us</h4>
            <div class="socialLinks">
              <a href="#"> <i class="fab fa-facebook-f"></i></a>
              <a href="#"> <i class="fab fa-instagram"></i></a>
              <a href="#"> <i class="fab fa-linkedin-in"></i></a>

            </div>
          </div>

        </div>
      </div>
    </div>
  </footer>
  
  
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
  </body>
</html>