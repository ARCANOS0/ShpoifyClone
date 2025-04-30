<?php
session_start();
require_once __DIR__ . '/admin/config/db.php';
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
    <link rel="shortcut icon" href="pic/logo (2).png" type="image/x-icon">


    <!-- css file -->
    <link rel="stylesheet" href="all.css">

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
            <img style="height: 50px; margin-right: 10px;" src="pic/logo (2).png" alt="Logo">
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
        <form action="main/search_results.php" method="GET" role="search">
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
     

    <!-- main image section -->
    <section class="mb-5" id="home">
        <div class="mx-4">
            <h5 class="pt-5 mx-4">Best Seller Of All Time</h5>
            <h1 class="mx-4"><span>Best Prices </span>This Year</h1>
            <p class="mx-4">
                Explore our premium collections, here to bring joy to you!</p>
            <button class="banner-btn mx-4"><a style="color: black;" href="main/shop.php">Shop Now!</a></button>
        </div>
    </section>
    <!-- kitchen main bg with headings and button  -->
    <!-- new kitchen products section -->
    <!-- 3 cards section and new collections -->

    <!-- the brands section -->
    <section id="brand" class="container">
        <div class="row">
            <img src="pic/brand/brand1.png" alt="" class="img-fluid col-lg-2 col-md-4 col-6">
            <img src="pic/brand/brand2.png" alt="" class="img-fluid col-lg-2 col-md-4 col-6">
            <img src="pic/brand/brand3.png" alt="" class="img-fluid col-lg-2 col-md-4 col-6">
            <img src="pic/brand/brand4.png" alt="" class="img-fluid col-lg-2 col-md-4 col-6">
            <img src="pic/brand/brand5.png" alt="" class="img-fluid col-lg-2 col-md-4 col-6">
            <img src="pic/brand/brand6.png" alt="" class="img-fluid col-lg-2 col-md-4 col-6">
        </div>
    </section>


    <center>
        <h1 class="mt-5 pt-5">Best Seller And New Collections</h1>
    </center>

    <!-- the big 3 images section -->
    <section class="w-100 mt-5 pt-5" id="newProduct">
        <!-- first image section -->
        <div class="row p-3 m-0">
            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img class="img-fluid" src="pic/collections/collection_home_page_1.jpg" alt="">
                <div class="details">
                    <h2><a style="color: black;" href="main/cloth.php">New Collections</a></h2>
                </div>
            </div>
            <!-- second image section -->
            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img class="img-fluid" src="pic/collections/collection_home_page_2.png" alt="">
                <div class="details">
                    <h2> <a style="color: black;" href="main/kitchen.php">Durable Materials And Innovative Tools</a></h2>
                </div>
            </div>  

            <!-- third image section -->
            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <a href="main/watch.php"><img class="img-fluid" src="pic/collections/collection_home_page_3.jpg" alt="">
                <div class="details"></a>
                    <h2><a style="color: black;" href="main/watch.php">Variety Of Colors</a></h2>
                </div>
            </div>



        </div>
    </section>


    <section class="my-5 pb-5" id="feature">
        <div class="container mt-5 text-center py-5">
            <h3>Featured</h3>
            <h2>Suggestions & Best Seller</h2>
            <hr>
            <p>Always There Are New Products And Offers Every Week!</p>
        </div>



        <!-- Products section -->

        <!-- Row 1 -->
        <div class="row d-flex flex-wrap align-items-stretch">
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="pic/home_page_pictures/home1.jpg" alt="Cooking Pan 1" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <h5 class="p-name">Ripped T-Shirt</h5>
                <h4 class="p-price">$22.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="pic/home_page_pictures/home2.jpg" alt="Cooking Pan 2" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <h5 class="p-name">Navy Casual Men Shoes</h5>
                <h4 class="p-price">$45.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="pic/home_page_pictures/home3.jpg" alt="Cooking Pan 3" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">White Sneakers</h5>
                <h4 class="p-price">$62.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
        </div>

        <!-- Row 2  -->
        <!-- second section of products -->
        <div class="row d-flex flex-wrap align-items-stretch mt-4">
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="pic/home_page_pictures/home4.jpg" alt="Cooking Pan 4" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Perfume Lattafa</h5>
                <h4 class="p-price">$132.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="pic/home_page_pictures/home5.jpg" alt="Cooking Pan 5" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Redmi 13</h5>
                <h4 class="p-price">$199.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="pic/home_page_pictures/home6.jpg" alt="Cooking Pan 6" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <h5 class="p-name">Sandwich Grill</h5>
                <h4 class="p-price">$222.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
        </div>

        <!-- third row -->
        <!-- third section of products -->
        <div class="row d-flex flex-wrap align-items-stretch mt-4">
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="pic/home_page_pictures/home7.jpg" alt="Cooking Pan 4" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <h5 class="p-name">Waffle Maker</h5>
                <h4 class="p-price">$100.99</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="/Shopify/img/products/pNine.png" alt="Cooking Pan 5" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Knife set</h5>
                <h4 class="p-price">$47.23</h4>
                <button class="btn btn-primary buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-4 col-12">
                <img src="pic/hotPad.png" alt="Cooking Pan 6" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                </div>
                <h5 class="p-name">Hot pads</h5>
                <h4 class="p-price">$11.96</h4>
                <button class="banner btn btn btn-primary buy-btn"><a href="">Buy Now</a></button>
            </div>
        </div>

    </section>

    <!-- banner section -->
    <section id="banner">
        <div class="banner-img">
            <div class="banner-content">
                <img src="pic/home_page_banner2.png" alt="">
                <button class="banner-btn"><a href="main/furniture.php">Shop Now!</a></button>
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
                            <li><a href="main/about.php">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Privacy Policy</a></li>

                        </ul>
                    </div>

                    <div class="footer-col">
                        <h4>Get Help</h4>
                        <ul>
                            <li><a href="main/FAQ.php">FAQ</a></li>
                            <li><a href="#">Returning</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Payment Methods</a></li>

                        </ul>
                    </div>

                    <div class="footer-col">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="index.php">Best Seller</a></li>
                            <li><a href="main/kitchen.php">Kitchen</a></li>
                            <li><a href="main/cloth.php">Clothing</a></li>
                            <li><a href="main/shoes.php">Shoes</a></li>
                            <li><a href="main/electrical.php">Electrical Appliance </a></li>



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