<?php
// 1. Include DB Config FIRST
require_once __DIR__ . '/../admin/config/db.php';
// 2. Start Session AFTER including config (if config doesn't start it)
session_start();

// Handle form submission (POST requests only)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- Retrieve and Sanitize Input Data ---
    // Use trim to remove leading/trailing whitespace
    $email = trim($_POST['email'] ?? ''); // Use null coalescing for safety
    $password = $_POST['password'] ?? ''; // Don't trim password

    // --- Basic Input Validation ---
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please enter both email and password.';
    } else {
        // --- Check if User Exists in Database (by email) ---
        try {
            $stmt = $pdo->prepare('SELECT id, name, password, role FROM users WHERE email = ?'); // Select role here too
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the user data

            if ($user && password_verify($password, $user['password'])) {
                // --- Login Successful ---
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['role'] = $user['role'] ?? 'customer';
            
                // Redirect all users to index.php
                header('Location: profile.php');
                exit();
            }

        } catch (PDOException $e) {
            // --- Database Error During Login ---
            $_SESSION['error'] = 'An error occurred during login. Please try again later.';
            error_log('Login Database Exception: ' . $e->getMessage()); // Log the error
        }
    }

    // --- If we reached here, login failed. Redirect back to login page. ---
    // The session message ($_SESSION['error']) will be displayed on the next page load.
    if (isset($_SESSION['error'])) { // Only redirect if an error message was set
        header('Location: login.php'); // Redirect back to the login form
        exit(); // Stop script execution after redirection
    }
}

// --- Prepare messages for display on the page ---
// Check for messages set during a previous redirect (e.g., from registration success or failed login)
if (isset($_SESSION['error'])) {
    $error_message_display = '<div class="alert alert-danger alert-dismissible fade show container mt-3" role="alert">'
                           . htmlspecialchars($_SESSION['error'])
                           . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    unset($_SESSION['error']); // Clear the message after preparing it for display
}
if (isset($_SESSION['success'])) { // Success message might be set by registration page
    $success_message_display = '<div class="alert alert-success alert-dismissible fade show container mt-3" role="alert">'
                             . htmlspecialchars($_SESSION['success'])
                             . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    unset($_SESSION['success']); // Clear the message after preparing it for display
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login - Shopify</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../all.css">
</head>

<body>


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
    <link rel="shortcut icon" href="pic/logo (2).png" type="image/x-icon">

    <!-- css file -->
    <link rel="stylesheet" href="../all.css">
</head>
  

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


    <section id="SignUpSec">
  <div class="wrapper">
    <h1>LogIn</h1>
    <p id="error-message">
      <?php
        if (isset($_SESSION['login_error'])) {
            echo htmlspecialchars($_SESSION['login_error']);
            unset($_SESSION['login_error']);
        }
      ?>
    </p>
    <form id="form" action="login.php" method="POST">
      
      <div>
        <label for="email-input">
          <span>@</span>
        </label>
        <input type="email" name="email" id="email-input" placeholder="abc@gmail.com" required
               value="<?php echo htmlspecialchars($_SESSION['_old_email'] ?? ''); unset($_SESSION['_old_email']); ?>">
      </div>

      <div>
        <label for="password">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
            <path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/>
          </svg>
        </label>
        <input type="password" name="password" id="password" placeholder="password" required>
      </div>

      <div>
        <button type="submit">LogIn</button>
      </div>

      <p>New Here? <a href="register.php">SignUP!</a></p>
    </form>
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