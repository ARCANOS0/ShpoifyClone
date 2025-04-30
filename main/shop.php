<?php
session_start(); 
require_once __DIR__ . '/../admin/config/db.php';


// Display feedback messages
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success alert-dismissible fade show container mt-3" role="alert">';
    echo htmlspecialchars($_SESSION['success_message']);
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['success_message']); // Clear message after displaying
}
if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show container mt-3" role="alert">';
    echo htmlspecialchars($_SESSION['error_message']);
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['error_message']); // Clear message after displaying
}
if (isset($_SESSION['info_message'])) {
    echo '<div class="alert alert-info alert-dismissible fade show container mt-3" role="alert">';
    echo htmlspecialchars($_SESSION['info_message']);
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['info_message']); // Clear message after displaying
}
?>

<!-- Rest of the HTML for cart.php or shop.php -->




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

  <div class="container my-5"> <!-- Main Content Container -->

    <!-- =================== Beauty Section ==================== -->
    <div class="text-center mb-4 pt-5">
      <h1>Beauty Products</h1>
    </div>
    <!-- PHP Loop for Beauty Products Would Start Here -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
      <!-- Product 1 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=1"> <img src="images/product1.jpg.jpg" alt="Lipstick" class="card-img-top">
          </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=1"
                  class="text-decoration-none text-dark"> lipstick </a> </h5>
              <p class="card-text small text-muted mb-2"> <strong>KIKO</strong> Milano Liquid Lipstick-105 Scarlet Red
              </p>
              <h4 class="p-price mb-3">EGP 400.00</h4>
            </div>
            <a href="product_details.php?id=1" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
      <!-- Product 2 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=2"> <img src="images/product2.jpg.jpg" alt="Foundation"
              class="card-img-top"> </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=2"
                  class="text-decoration-none text-dark"> Foundation cream </a> </h5>
              <p class="card-text small text-muted mb-2"> <strong>COMPLEXION PRO LONG</strong> Wear Foundation </p>
              <h4 class="p-price mb-3">EGP 600.00</h4>
            </div>
            <a href="product_details.php?id=2" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
      <!-- Product 3 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=3"> <img src="images/product3.jpg.jpg" alt="Blush" class="card-img-top">
          </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=3"
                  class="text-decoration-none text-dark"> Blush </a> </h5>
              <p class="card-text small text-muted mb-2"> <strong>Hudabeauty</strong> Beauty Ultra Blush Palette </p>
              <h4 class="p-price mb-3">EGP 500.00</h4>
            </div>
            <a href="product_details.php?id=3" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
      <!-- Product 4 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=4"> <img src="images/product4.jpg.jpg" alt="Mascara" class="card-img-top">
          </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=4"
                  class="text-decoration-none text-dark"> Mascara </a> </h5>
              <p class="card-text small text-muted mb-2"> <strong>Beauty beast Mascara Makeup</strong>Lengthening 2 Step
                Mascara </p>
              <h4 class="p-price mb-3">EGP 350.00</h4>
            </div>
            <a href="product_details.php?id=4" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
    </div> <!-- End Row -->
    <!-- PHP Loop for Beauty Products Would End Here -->


    <!-- =================== Watches Section ==================== -->
    <div class="text-center mb-4 pt-5">
      <h1>Watches Department</h1>
    </div>
    <!-- PHP Loop for Watches Products Would Start Here -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
      <!-- Watch 1 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=5"> <img src="images/whatch1.jpg.jpg" alt="Watch 1" class="card-img-top">
          </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=5"
                  class="text-decoration-none text-dark"> Women's watch </a> </h5>
              <p class="card-text small text-muted mb-2"> Women's accessory watch </p>
              <h4 class="p-price mb-3">EGP 950.00</h4>
            </div>
            <a href="product_details.php?id=5" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
      <!-- Watch 2 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=6"> <img src="images/whatch2.jpg.jpg" alt="Watch 2" class="card-img-top">
          </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=6"
                  class="text-decoration-none text-dark"> Smart watch </a> </h5>
              <p class="card-text small text-muted mb-2"> Smart watch with heart rate sensor </p>
              <h4 class="p-price mb-3">EGP 1200.00</h4>
            </div>
            <a href="product_details.php?id=6" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
      <!-- Watch 3 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=7"> <img src="images/whatch3.jpg.jpg" alt="Watch 3" class="card-img-top">
          </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=7"
                  class="text-decoration-none text-dark"> Men's watch </a> </h5>
              <p class="card-text small text-muted mb-2"> Classic brown leather watch </p>
              <h4 class="p-price mb-3">EGP 780.00</h4>
            </div>
            <a href="product_details.php?id=7" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
      <!-- Watch 4 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=8"> <img src="images/whatch4.jpg.jpg" alt="Watch 4" class="card-img-top">
          </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=8"
                  class="text-decoration-none text-dark"> Elegant women's watch </a> </h5>
              <p class="card-text small text-muted mb-2"> One of the most luxurious types of classics </p>
              <h4 class="p-price mb-3">EGP 1600.00</h4>
            </div>
            <a href="product_details.php?id=8" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
    </div> <!-- End Row -->
    <!-- PHP Loop for Watches Products Would End Here -->


    <!-- =================== Clothing Section ==================== -->
    <div class="text-center mb-4 pt-5">
      <h1>Clothing Department</h1>
    </div>
    <!-- PHP Loop for Clothing Products Would Start Here -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
      <!-- Clothing 1 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=9"> <img src="images/clothes1.jpg.jpg" alt="Clothes 1"
              class="card-img-top"> </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=9"
                  class="text-decoration-none text-dark"> Women's Set </a> </h5>
              <p class="card-text small text-muted mb-2"> Comfortable cotton fabric </p>
              <h4 class="p-price mb-3">EGP 350.00</h4>
            </div>
            <a href="product_details.php?id=9" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
      <!-- Clothing 2 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=10"> <img src="images/clothes2.jpg.jpg" alt="Clothes 2"
              class="card-img-top"> </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=10"
                  class="text-decoration-none text-dark"> Summer dress </a> </h5>
              <p class="card-text small text-muted mb-2"> Bright colors and soft fabric </p>
              <h4 class="p-price mb-3">EGP 600.00</h4>
            </div>
            <a href="product_details.php?id=10" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
      <!-- Clothing 3 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=11"> <img src="images/clothes3.jpg.jpg" alt="Clothes 3"
              class="card-img-top"> </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=11"
                  class="text-decoration-none text-dark"> Youth kit </a> </h5>
              <p class="card-text small text-muted mb-2"> Modern and comfortable design </p>
              <h4 class="p-price mb-3">EGP 850.00</h4>
            </div>
            <a href="product_details.php?id=11" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
      <!-- Clothing 4 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=12"> <img src="images/clothes4.jpg.jpg" alt="Clothes 4"
              class="card-img-top"> </a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i> </div>
              <h5 class="card-title p-name fs-6 fw-bold"> <a href="product_details.php?id=12"
                  class="text-decoration-none text-dark"> My youth suit </a> </h5>
              <p class="card-text small text-muted mb-2"> Modern set </p>
              <h4 class="p-price mb-3">EGP 280.00</h4>
            </div>
            <a href="product_details.php?id=12" class="btn btn-primary buy-btn mt-auto"> View Details </a>
          </div>
        </div>
      </div>
    </div> <!-- End Row -->
    <!-- PHP Loop for Clothing Products Would End Here -->

    <!-- Add similar structured sections for Shoes, Bags, Furniture, Kitchen, Devices -->
    <!-- Remember to adjust product IDs, image paths, names, descriptions, prices, stars -->

    <!-- =================== Shoes Section ===================== -->
    <div class="text-center mb-4 pt-5">
      <h1>Shoes Section</h1>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
      <!-- Shoe 1 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=13"><img src="images/shoes1.jpg.jpg" alt="shoes1" class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=13"
                  class="text-decoration-none text-dark">High heel half boots</a></h5>
              <!-- No description in original, added placeholder -->
              <!-- <p class="card-text small text-muted mb-2">Stylish boots</p> -->
              <h4 class="p-price mb-3">EGP 750.00</h4>
            </div>
            <a href="product_details.php?id=13" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Shoe 2 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=14"><img src="images/shoes2.jpg.jpg" alt="shoes2" class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=14"
                  class="text-decoration-none text-dark">Girls' coach</a></h5>
              <h4 class="p-price mb-3">EGP 300.00</h4>
            </div>
            <a href="product_details.php?id=14" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Shoe 3 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=15"><img src="images/shoes3.jpg.jpg" alt="shoes3" class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=15"
                  class="text-decoration-none text-dark">Comfort Sandals</a></h5>
              <h4 class="p-price mb-3">EGP 650.00</h4>
            </div>
            <a href="product_details.php?id=15" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Shoe 4 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=16"><img src="images/shoes4.jpg.jpg" alt="shoes4" class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="far fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=16"
                  class="text-decoration-none text-dark">Casual Shoes</a></h5>
              <h4 class="p-price mb-3">EGP 700.00</h4>
            </div>
            <a href="product_details.php?id=16" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
    </div><!-- End Row -->

    <!-- =================== Bags Section ====================== -->
    <div class="text-center mb-4 pt-5">
      <h1>Bags Section</h1>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
      <!-- Bag 1 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=17"><img src="images/bag1.jpg.jpg" alt="Bag 1" class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=17"
                  class="text-decoration-none text-dark">Children's school bag</a></h5>
              <h4 class="p-price mb-3">EGP 450.00</h4>
            </div>
            <a href="product_details.php?id=17" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Bag 2 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=18"><img src="images/bag2.jpg.jpg" alt="Bag 2" class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=18"
                  class="text-decoration-none text-dark">Women's evening bag</a></h5>
              <h4 class="p-price mb-3">EGP 800.00</h4>
            </div>
            <a href="product_details.php?id=18" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Bag 3 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=19"><img src="images/bag3.jpg.jpg" alt="Bag 3" class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=19"
                  class="text-decoration-none text-dark">Women's crossbody bag</a></h5>
              <h4 class="p-price mb-3">EGP 800.00</h4>
            </div>
            <a href="product_details.php?id=19" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Bag 4 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=20"><img src="images/bag4.jpg.jpg" alt="Bag 4" class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=20"
                  class="text-decoration-none text-dark">Modern brand bag</a></h5>
              <h4 class="p-price mb-3">EGP 800.00</h4>
            </div>
            <a href="product_details.php?id=20" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
    </div> <!-- End Row -->

    <!-- ... Continue converting Furniture, Kitchen Tools, Devices sections in the same pattern ... -->

    <!-- ================= Furniture Section ================== -->
    <div class="text-center mb-4 pt-5">
      <h1>Furniture Department</h1>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
      <!-- Furniture 1 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=21"><img src="images/furniture1.jpg.jpg" alt="Furniture 1"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=21"
                  class="text-decoration-none text-dark">Wooden Chair</a></h5>
              <h4 class="p-price mb-3">EGP 1,200.00</h4>
            </div>
            <a href="product_details.php?id=21" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Furniture 2 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=22"><img src="images/furniture2.jpg.jpg" alt="Furniture 2"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=22"
                  class="text-decoration-none text-dark">Modern Table</a></h5>
              <h4 class="p-price mb-3">EGP 2,000.00</h4>
            </div>
            <a href="product_details.php?id=22" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Furniture 3 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=23"><img src="images/furniture3.jpg.jpg" alt="Furniture 3"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=23"
                  class="text-decoration-none text-dark">Display screen</a></h5>
              <h4 class="p-price mb-3">EGP 3,500.00</h4>
            </div>
            <a href="product_details.php?id=23" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Furniture 4 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=24"><img src="images/furniture4.jpg.jpg" alt="Furniture 4"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="far fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=24"
                  class="text-decoration-none text-dark">Bed Frame</a></h5>
              <h4 class="p-price mb-3">EGP 4,000.00</h4>
            </div>
            <a href="product_details.php?id=24" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
    </div> <!-- End Row -->

    <!-- ================= Kitchen Tools Section ============== -->
    <div class="text-center mb-4 pt-5">
      <h1>Kitchen Tools Department</h1>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
      <!-- Kitchen Tool 1 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=25"><img src="images/kitchen1.jpg.jpg" alt="Kitchen 1"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=25"
                  class="text-decoration-none text-dark">Cooking stove</a></h5>
              <h4 class="p-price mb-3">EGP 10,000.00</h4>
            </div>
            <a href="product_details.php?id=25" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Kitchen Tool 2 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=26"><img src="images/kitchen2.jpg.jpg" alt="Kitchen 2"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=26"
                  class="text-decoration-none text-dark">Modern granite cookware set</a></h5>
              <h4 class="p-price mb-3">EGP 7,200.00</h4>
            </div>
            <a href="product_details.php?id=26" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Kitchen Tool 3 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=27"><img src="images/kitchen3.jpg.jpg" alt="Kitchen 3"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=27"
                  class="text-decoration-none text-dark">Blender</a></h5>
              <h4 class="p-price mb-3">EGP 900.00</h4>
            </div>
            <a href="product_details.php?id=27" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Kitchen Tool 4 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=28"><img src="images/kitchen4.jpg.jpg" alt="Kitchen 4"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="far fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=28"
                  class="text-decoration-none text-dark">Washing machine</a></h5>
              <h4 class="p-price mb-3">EGP 15,000.00</h4>
            </div>
            <a href="product_details.php?id=28" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
    </div><!-- End Row -->

    <!-- ================= Devices Section ==================== -->
    <div class="text-center mb-4 pt-5">
      <h1>Devices Department</h1>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
      <!-- Device 1 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=29"><img src="images/mobred.jpg.jpg" alt="Devices 1"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=29"
                  class="text-decoration-none text-dark">Water cooler</a></h5>
              <h4 class="p-price mb-3">EGP 10,000.00</h4>
            </div>
            <a href="product_details.php?id=29" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Device 2 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=30"><img src="images/microwave.jpg.jpg" alt="Devices 2"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=30"
                  class="text-decoration-none text-dark">Microwave</a></h5>
              <h4 class="p-price mb-3">EGP 15,000.00</h4>
            </div>
            <a href="product_details.php?id=30" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Device 3 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=31"><img src="images/air-conditioner.jpg.jpg" alt="Devices 3"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=31"
                  class="text-decoration-none text-dark">Air conditioning</a></h5>
              <h4 class="p-price mb-3">EGP 18,000.00</h4>
            </div>
            <a href="product_details.php?id=31" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
      <!-- Device 4 -->
      <div class="col">
        <div class="product card shadow-sm border-0 h-100">
          <a href="product_details.php?id=32"><img src="images/fridge.jpg.jpg" alt="Devices 4"
              class="card-img-top"></a>
          <div class="card-body text-center">
            <div>
              <div class="star mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="far fa-star"></i></div>
              <h5 class="card-title p-name fs-6 fw-bold"><a href="product_details.php?id=32"
                  class="text-decoration-none text-dark">Refrigerator</a></h5>
              <h4 class="p-price mb-3">EGP 100,000.00</h4>
            </div>
            <a href="product_details.php?id=32" class="btn btn-primary buy-btn mt-auto">View Details</a>
          </div>
        </div>
      </div>
    </div><!-- End Row -->


  </div> <!-- End Container -->

  <!-- ===================== Footer ======================== -->
  <footer class="footer mt-5 py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
          <h4>Team</h4>
          <ul>
            <li><a href="about.php">About Us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
          <h4>Get Help</h4>
          <ul>
            <li><a href="FAQ.php">FAQ</a></li>
            <li><a href="#">Returning</a></li>
            <li><a href="#">Shipping</a></li>
            <li><a href="#">Payment Methods</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
          <h4>Categories</h4>
          <ul>
            <li><a href="../index.php">Best Seller</a></li>
            <li><a href="kitchen.php">Kitchen</a></li>
            <li><a href="cloth.php">Clothing</a></li>
            <li><a href="shoes.php">Shoes</a></li>
            <li><a href="electrical.php">Electrical Appliance </a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
          <h4>Follow Us</h4>
          <div class="socialLinks"> <a href="#"> <i class="fab fa-facebook-f"></i></a> <a href="#"> <i
                class="fab fa-instagram"></i></a> <a href="#"> <i class="fab fa-linkedin-in"></i></a> </div>
        </div>
      </div>
      <hr class="mt-4" style="border-color: rgba(255,255,255,0.2);">
      <div class="text-center text-muted mt-3">
        <p>©
          <?php echo date("Y"); ?> Shopify. All Rights Reserved.
        </p>
      </div>
    </div>
  </footer>
  <!-- =================== End Footer ====================== -->

  <!-- Search Modal HTML (Include ONCE per page) -->
  <?php // Replace with: require_once __DIR__ . '/../snippets/search_modal.php'; ?>
  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="searchModalLabel">Search Products</h5> <button type="button" class="btn-close"
            data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="main/search_results.php" method="GET" role="search">
            <div class="input-group mb-3"> <input type="search" class="form-control"
                placeholder="Enter product name, keyword..." aria-label="Search query" name="query" required> <button
                class="btn btn-outline-primary" type="submit"> <i class="fa-solid fa-magnifying-glass"></i> Search
              </button> </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>

</body>

</html>