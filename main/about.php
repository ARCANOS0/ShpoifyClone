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
    <link rel="stylesheet" href="../snippets/about.css">
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

<!-- About Us Section -->
<style>
    .team-member i {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .team-member:hover i {
        transform: translateY(-8px) scale(1.2);
        color: #ff9933;
    }
</style>

<section style="padding: 60px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="color: #FF9149; font-weight: bold;">About Us</h2>
            <p style="font-size: 1.2rem; max-width: 800px; margin: 10px auto; color: #444;">
                At Shopify, we offer you a unique shopping experience for everyone who loves stylish clothes, comfortable sneakers, and bags with a special touch.  
                We started this project out of our passion for fashion and quality materials. Our goal is for every customer to find something that expresses their personality and completes their style.
            </p>
        </div>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <i class="fa-solid fa-tags fa-3x" style="color: #FF9149;"></i>
                <h5 class="mt-3" style="color: #333;">Ongoing Discounts</h5>
                <p style="color: #555;">We always have offers and deals that suit all budgets so you can shop with joy.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fa-solid fa-star fa-3x" style="color: #FF9149;"></i>
                <h5 class="mt-3" style="color: #333;">Premium Products</h5>
                <p style="color: #555;">We carefully select every item to guarantee both quality and elegance.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fa-solid fa-truck-fast fa-3x" style="color: #FF9149;"></i>
                <h5 class="mt-3" style="color: #333;">Fast & Secure Delivery</h5>
                <p style="color: #555;">No matter where you are, we’ll get your order to you quickly and safely.</p>
            </div>
        </div>

        <hr class="my-5" />

        <div class="text-center mb-4">
            <h3 style="color: #FF9149; font-weight: bold;">Meet Our Team</h3>
            <p style="color: #555;">Behind every great product is a stronger team. We work as one hand to deliver the best to you.</p>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Tarek Ayman</p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Gasser Mohammed</p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Mohammad Rabie</p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Osama Al-Sayed </p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Mohamed Shaaban</p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Mahmoud Arafa </p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Mohamed AbdelHamid</p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Hajar Taha</p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Shahd Mohamed</p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Basant Magdy</p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Thoraya Atef </p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Nada Mohammed </p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Aya Mokhtar </p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Mariam Madhat</p></div></div>
            <div class="col text-center"><div class="p-3 bg-white shadow rounded team-member"><i class="fa-solid fa-user fa-2x" style="color: #FF9149;"></i><p class="mt-2 fw-bold">Toqa Essam </p></div></div>
            
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

