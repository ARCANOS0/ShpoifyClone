<?php
require_once __DIR__ . '/../admin/config/db.php'; // Get $pdo
require_once __DIR__ . '/functions.php'; // For isLoggedIn()

// Check if user is logged in
if (!isLoggedIn()) { // Use your isLoggedIn() function
    $_SESSION['error_message'] = 'Please log in to view your profile.';
    header("Location: login.php"); // Redirect to your login page
    exit();
}

// Get user data (using PDO)
$user_id = $_SESSION['user_id'];
$user = null;
try {
    $stmt = $pdo->prepare("SELECT id, name, email, created_at, updated_at FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // This shouldn't happen if user_id is valid, but handle defensively
        $_SESSION['error_message'] = 'User data not found.';
        header("Location: logout.php"); // Log them out if data missing
        exit();
    }
} catch (PDOException $e) {
    error_log("Profile Page: User data fetch error: " . $e->getMessage());
    // Set error message to display on the page
    $errorMessage = 'Could not load user data.';
    $user = null; // Ensure user is null on error   
}


// Get user orders (using PDO)
$orders = [];
$ordersErrorMessage = null;
try {
    $orders_query = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC LIMIT 5";
    $stmt = $pdo->prepare($orders_query);
    $stmt->execute([$user_id]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Profile Page: Orders fetch error: " . $e->getMessage());
    $ordersErrorMessage = 'Could not load order history.';
    $orders = []; // Ensure orders is empty on error
}

// Prepare feedback messages
$success_message_display = ''; // Add logic to fetch these if needed

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard - Shopify</title>
    <!-- Include Head Content: Bootstrap CSS, Font Awesome, Favicon, Custom CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">
    <link rel="stylesheet" href="../all.css">
    <link rel="stylesheet" href="../snippets/header.css">

</head>

    <!-- navbar section -->
<!-- ============================ -->
<!--   START: Combined Navbar     -->
<!-- ============================ -->
<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light py-3">
    <!-- Use container for better centering/margins -->
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="../index.php"> <!-- Make logo/name a link -->
            <img style="height: 50px; margin-right: 10px;" src="../pic/logo (2).png" alt="Logo">
             <!-- Removed margin from h3 for better alignment -->
            <h3 style="color: white;" class="mb-0">Shopify</h3>
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
    <!-- Keep navbar PHP include if exists -->

    <section class="profile-section">
        <div class="containerF">
            <?php if (isset($errorMessage)): ?>
                <div class="alert alert-danger"><?= $errorMessage ?></div>
            <?php elseif ($user): ?>
            <div class="profile-grid">
                <!-- Main Content -->
                <main class="profile-main">
                    <!-- Account Section -->
                    <section class="profile-card account-info">
                        <div class="profile-header">
                            <h2 class="profile-title mt-5">Account Overview</h2>
                            <p class="account-meta">Member since <?= date('M Y', strtotime($user['created_at'])) ?></p>
                        </div>
                        
                        <div class="profile-content">
                            <div class="avatar-section">
                                <img src="images/person.jpg" alt="Profile" class="profile-avatar">
                            </div>
                            
                            <div class="profile-details">
                                <div class="detail-group">
                                    <h3 class="mt-3"><label>Email</label></h3>
                                    <p class="detail-value"><?= htmlspecialchars($user['email']) ?></p>
                                </div>
                                <div class="detail-group">
                                    <h3><label>Username</label></h3>
                                    <p class="detail-value"><?= htmlspecialchars($user['name'] ?? 'N/A') ?></p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Orders Section -->
                    <section class="profile-card">
                        <h3 class="section-title">Recent Orders</h3>
                        
                        <?php if (!empty($orders)): ?>
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Items</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>#<?= $order['id'] ?></td>
                                    <td><?= $order['total_products'] ?? 'View Details' ?></td>
                                    <td>
                                        <span class="status-badge <?= strtolower($order['status']) ?>">
                                            <?= $order['status'] ?>
                                        </span>
                                    </td>
                                    <td>$<?= number_format($order['total_amount'], 2) ?></td>
                                    <td><?= date('M d, Y', strtotime($order['order_date'])) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <p class="no-orders">No recent orders found</p>
                        <?php endif; ?>
                    </section>

                    <!-- FAQ Section -->
             
                            </div>
                    </section>
                </main>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Keep footer PHP include -->
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

<script src="../snippets/header.js"></script>


</body>

</html>