<?php
session_start();
require_once __DIR__ . '/../admin/config/db.php';

// --- Get Product ID from URL ---
$product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$product = null; // Initialize product variable
$categoryName = 'Uncategorized'; // Default category name
$errorMessage = null; // Initialize error message

if ($product_id === false || $product_id <= 0) {
  $errorMessage = "Invalid Product ID specified.";
  // Optional: Redirect to shop page
  // header('Location: shop.php');
  // exit;
} else {
  // --- Fetch Product Data from Database ---
  try {
    $stmt = $pdo->prepare("SELECT p.*, c.name as category_name
                              FROM products p
                              LEFT JOIN categories c ON p.category_id = c.id
                              WHERE p.id = ? AND p.is_available = 1");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the product details

    if (!$product) {
      $errorMessage = "Product not found or is unavailable.";
    } else {
      if (!empty($product['description'])) {
        $categoryName = $product['description'];
      }
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
  <title>Shopify</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">


  <!-- css file -->
  <link rel="stylesheet" href="../all.css">
  <link rel="stylesheet" href="../snippets/kitchen.css">

</head>

<body>

  <!-- navbar section -->
  <!-- navbar section -->
  <!-- ============================ -->
  <!--   START: Combined Navbar     -->
  <!-- ============================ -->


  <!-- navbar section -->
  <!-- navbar section -->
  <!-- ============================ -->
  <!--   START: Combined Navbar     -->
  <!-- ============================ -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light py-3">
    <!-- Use container for better centering/margins -->
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="index.php"> <!-- Make logo/name a link -->
        <img style="height: 50px; margin-right: 10px;" src="../pic/logo (2).png" alt="Logo">
        <!-- Removed margin from h3 for better alignment -->
        <h3 style="color: whitesmoke;" class="mb-0">Shopify</h3>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <!-- Ensure Font Awesome is loaded correctly for this icon -->
        <span><i id="bar" class="fa-solid fa-bars"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Use ms-auto for Bootstrap 5 margin, align-items-center for vertical alignment -->
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
          <li class="nav-item">
            <!-- Assuming index.php is in the root -->
            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
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
          <!-- Search Icon as Modal Trigger -->
          <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Search">
              <i class="fa-solid fa-magnifying-glass"></i>
            </a>
          </li>
          <!-- Removed the standalone icon from here -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- ============================ -->
  <!--    END: Combined Navbar      -->
  <!-- ============================ -->


  <!-- ============================ -->
  <!--   Search Modal HTML Block    -->
  <!-- (Place this code elsewhere in your HTML body, e.g., before the closing </body> tag) -->
  <!-- ============================ -->
  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="searchModalLabel">Search Products</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Search Form pointing to search_results.php -->
          <!-- Ensure the 'action' path is correct relative to the page the navbar is on -->
          <form action="search_results.php" method="GET" role="search">
            <div class="input-group mb-3">
              <input type="search" class="form-control" placeholder="Enter product name, keyword..." aria-label="Search query" name="query" required>
              <button class="btn btn-outline-primary" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i> Search
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================ -->
  <!-- END: Search Modal HTML Block -->
  <!-- ============================ -->
  <!-- php search snippet -->

  <!-- Inside main/product_details.php, after displaying product info -->
  <!-- ... existing product name, description, price ... -->

  <hr> <!-- Optional separator -->

  <!-- Add to Cart Form -->
  <!-- Points to the PHP script that will handle adding to the cart -->
  
  <section class="container details my-5 pt-5">
  <div class="row mt-5">
    <div class="col-lg-5 col-md-12 col-12">
      <?php if ($product): ?>
        <img class="img-fluid w-100" src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">

      <?php else: ?>
        <img class="img-fluid w-100" src="../pic/default.png" alt="No product found">
      <?php endif; ?>
    </div>

    <div class="col-lg-6 col-md-12 col-12">
      <?php if ($product): ?>
        <h6><?php echo htmlspecialchars($categoryName); ?></h6>
        <h3 class="py-2"><?php echo htmlspecialchars($product['name']); ?></h3>
        <h2><?php echo number_format($product['price'], 2); ?>$</h2>

        <!-- Add to Cart Form -->
        <form action="cart_add.php" method="POST" class="mt-4">
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">

          <div class="row g-3 align-items-center">
            <div class="col-auto">
              <label for="quantityInput" class="col-form-label">Quantity:</label>
            </div>
            <div class="col-auto" style="max-width: 100px;">
              <input type="number" class="form-control form-control-sm" id="quantityInput" name="quantity" value="1" min="1" required>
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary buy-btn">
                <i class="fa-solid fa-cart-plus me-2"></i>Add to Cart
              </button>
            </div>
          </div>
        </form>

        <h4 class="mt-5">Product Details</h4>
        <span><?php echo htmlspecialchars($product['description'] ?? 'No description available.'); ?></span>
      <?php else: ?>
        <h3 class="text-danger"><?php echo $errorMessage; ?></h3>
      <?php endif; ?>
    </div>
  </div>
</section>
        
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