<?php
require_once __DIR__ . '/../admin/config/db.php';
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Shop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../all.css">
    <link rel="shortcut icon" href="../img/logo (2).png" type="image/x-icon">


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
  

    <section class="py-5 mt-5">
        <div class=" mt-3 px-5">
            <h2>Fashion Store</h2>
            <p>Explore random stuff, we have always offers, maybe you will find something you want!</p>
        </div>
        <!-- Products section -->
        <div class="row d-flex flex-wrap align-items-stretch">
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="../pic/clothes/project.jpg" alt="Koftan" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <h5 class="p-name">Koftan</h5>
                <h4 class="p-price">$99.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="../pic/clothes/project (5).jpg" alt="Long Dress" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <h5 class="p-name">Long Dress</h5>
                <h4 class="p-price">$195.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="../pic/clothes/project (3).jpg" alt="Dress" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name"> short Dress</h5>
                <h4 class="p-price">$192.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
        </div>

        <!-- Row 2  -->
        <!-- second section of products -->
        <div class="row d-flex flex-wrap align-items-stretch mt-4">
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="../pic/clothes/project (4).jpg" alt="small dress" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">small dress</h5>
                <h4 class="p-price">$250.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="../pic/clothes/project (6).jpg" alt="shoes" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">children's shoes</h5>
                <h4 class="p-price">$199.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="../pic/clothes/project (10).jpg" alt="boy's T-shirt" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <h5 class="p-name">boy's T-shirt</h5>
                <h4 class="p-price">$200.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
        </div>


        <!-- third row -->
        <!-- third section of products -->
        <div class="row d-flex flex-wrap align-items-stretch mt-4">
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="../pic/clothes/project (8).jpg" alt="men's T-shirt" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <h5 class="p-name">men's T-shirt</h5>
                <h4 class="p-price">$100.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="../pic/clothes/project (9).jpg" alt="sport shoes" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name"> sport shoes</h5>
                <h4 class="p-price">$147.23</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="../pic/clothes/project (2).jpg" alt="shirt" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                </div>
                <h5 class="p-name">shirt</h5>
                <h4 class="p-price">$11.96</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
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
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Privacy Policy</a></li>

                        </ul>
                    </div>

                    <div class="footer-col">
                        <h4>Get Help</h4>
                        <ul>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Returning</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Payment Methods</a></li>

                        </ul>
                    </div>

                    <div class="footer-col">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="#">Best Seller</a></li>
                            <li><a href="Kitchen.html">Kitchen</a></li>
                            <li><a href="#">Clothing</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">Electrical Appliance </a></li>



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

            <div class="footer-one col-lg-3 col-md-6 col-12">




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