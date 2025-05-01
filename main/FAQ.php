<?php
require_once __DIR__ . '/../admin/config/db.php';
session_start();
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

</head>

<body>

  

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
  <section class="FAQ">
    <div class="container">
      <div class="row align-items-center">
        <!-- Image Column -->
        <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 d-flex justify-content-center">
          <img class="img-fluid" src="../pic/faq.jpg" alt="FAQ Image" style="height: 500px;">
        </div>
  
        <!-- Accordion Column -->
        <div class="col-lg-6 col-md-12">
          <div class="accordion accordion-flush" id="example">
            <!-- Item 1 -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  How do I create an account on your website?
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#example">
                <div class="accordion-body">
                  To create an account, click on the "Register" button at the top-right corner of the page. Fill in your details, such as name, email, and password, and click "Sign Up." You'll receive a confirmation email to verify your account.
                </div>
              </div>
            </div>
  
            <!-- Item 2 -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  What payment methods do you accept?
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#example">
                <div class="accordion-body">
                  We accept various payment methods, including credit/debit cards (Visa, MasterCard, American Express), PayPal, and direct bank transfers. For certain regions, we also support local payment options.
                </div>
              </div>
            </div>
  
            <!-- Item 3 -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  How can I track my order?
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#example">
                <div class="accordion-body">
                  Once your order is shipped, you’ll receive an email with a tracking number. You can also log in to your account and navigate to the "Order History" section to view the status of your order.
                </div>
              </div>
            </div>
  
            <!-- Item 4 -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                  What is your return and refund policy?
                </button>
              </h2>
              <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#example">
                <div class="accordion-body">
                  We offer a 30-day return policy for most items. Products must be unused and in their original packaging. Once we receive and inspect the returned item, we’ll process your refund within 5-7 business days. For more details, visit our Returns & Refunds page.
                </div>
              </div>
            </div>
  
            <!-- Item 5 -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                  Do you ship internationally?
                </button>
              </h2>
              <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#example">
                <div class="accordion-body">
                  Yes, we ship to most countries worldwide. Shipping fees and delivery times vary depending on your location. During checkout, you’ll see the available shipping options for your address.
                </div>
              </div>
            </div>
  
            <!-- Item 6 -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                  Can I modify or cancel my order after placing it?
                </button>
              </h2>
              <div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#example">
                <div class="accordion-body">
                  You can modify or cancel your order within 1 hour of placing it by contacting our customer support. After this window, the order may already be processed for shipping.
                </div>
              </div>
            </div>
          </div>
        </div>
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

</html>