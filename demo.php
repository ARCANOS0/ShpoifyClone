<!doctype html>
<html lang="en">

<head>
    <title>Shopify - Cart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <!-- Make sure you have a valid Font Awesome kit/setup if using v6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Boxicons (If still needed) -->
    <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->

    <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">

    <!-- Your Custom CSS Files -->
    <!-- Load general styles first -->
    <link rel="stylesheet" href="../all.css">
     <!-- Load specific cart styles AFTER Bootstrap and general styles -->
    <link rel="stylesheet" href="../snippets/cart.css">

</head>

<body>
    <!-- navbar section -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light py-3"> <!-- Added py-3 for padding -->
        <div class="container"> <!-- Use container for better alignment -->
            <a class="navbar-brand d-flex align-items-center" href="../index.php"> <!-- Make logo/name a link -->
                <img style="height: 50px; margin-right: 10px;" src="../pic/logo (2).png" alt="Logo">
                <h3 class="mb-0">Shopify</h3> <!-- Removed margin bottom from h3 -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><i id="bar" class="fa-solid fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Use ms-auto for Bootstrap 5 margin start auto -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a> <!-- Removed active class unless it's dynamic -->
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
                        <!-- Added 'active' class for visual cue -->
                        <a class="nav-link active" href="#">Cart <i class="fa-solid fa-cart-shopping"></i></a>
                    </li>
                </ul>
                <!-- Optional Search Form/Icon -->
                <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form> -->
            </div>
        </div>
    </nav>

    <!-- Cart Section Title -->
    <section id="cart-title" class="pt-5 mt-5 container">
        <h2 class="fw-bold">Shopping Cart</h2>
        <hr>
    </section>

    <!-- Cart Table Section -->
    <section id="cart" class="cart-container container my-5">
        <!-- Responsive wrapper for the table -->
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <!-- Table Head uses your custom CSS for background -->
                <thead class="table-light"> <!-- Removed table-light if using custom background -->
                    <tr>
                        <td>Remove</td>
                        <td>Image</td>
                        <td>Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>
                </thead>

                <tbody>
                    <!-- EXAMPLE CART ROW (Generate this part with PHP) -->
                    <tr>
                        <td>
                            <!-- Styled remove link as a button -->
                            <a href="#" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                        <td>
                            <!-- img-fluid makes image responsive -->
                            <img class="img-fluid" src="../pic/kitchen/cup3.png" alt="Cup Demo">
                        </td>
                        <td>
                            <!-- Use h6 or p for product name -->
                            <h6 class="mb-0">Cup Demo</h6>
                        </td>
                        <td>
                             <!-- Product Price -->
                            <p class="mb-0">$22.99</p>
                        </td>
                        <td>
                            <!-- Quantity Input -->
                            <input class="form-control form-control-sm w-50 mx-auto" value="1" min="1" type="number">
                        </td>
                        <td>
                             <!-- Subtotal for this item -->
                            <p class="mb-0 fw-bold">$22.99</p>
                        </td>
                    </tr>
                    <!-- Add more <tr> elements here for other cart items -->

                    <!-- Example Row 2 -->
                     <tr>
                        <td><a href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                        <td><img class="img-fluid" src="../pic/path/to/another-product.jpg" alt="Another Product"></td>
                        <td><h6 class="mb-0">Another Item</h6></td>
                        <td><p class="mb-0">$50.00</p></td>
                        <td><input class="form-control form-control-sm w-50 mx-auto" value="2" min="1" type="number"></td>
                        <td><p class="mb-0 fw-bold">$100.00</p></td>
                    </tr>

                     <!-- Row shown when cart is empty -->
                     <?php /*
                     if (empty($cart_items)) { // Example PHP check
                         echo '<tr><td colspan="6" class="text-center py-4">Your cart is currently empty.</td></tr>';
                     }
                     */ ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Cart Totals Section -->
    <section id="cart-bottom" class="container mb-5">
        <div class="row justify-content-end"> <!-- Align content to the right -->

            <!-- Totals Column -->
             <!-- Adjust col size for different breakpoints as needed -->
            <div class="col-lg-6 col-md-7 col-12">
                <div class="card border-0 shadow-sm"> <!-- Use a card for styling -->
                    <div class="card-body">
                        <h5 class="card-title mb-4">Cart Totals</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <!-- Calculate Subtotal with PHP -->
                            <span class="fw-bold">$122.99</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                             <!-- Replace with dynamic shipping cost or options -->
                            <span class="fw-bold">$7.01</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold mb-4">
                            <span>Grand Total</span>
                            <!-- Calculate Grand Total with PHP -->
                            <span>$130.00</span>
                        </div>
                        <div class="d-grid"> <!-- Makes button full width of its container -->
                             <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- footer section -->
    <footer class="footer mt-5 py-5"> <!-- Added py-5 for more padding -->
        <div class="container"> <!-- Use Bootstrap container -->
             <div class="row"> <!-- Use Bootstrap row -->
                <!-- Footer Columns -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
                    <h4>Team</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
                    <h4>Get Help</h4>
                    <ul>
                        <li><a href="FAQ.html">FAQ</a></li>
                        <li><a href="#">Returning</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Payment Methods</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
                    <h4>Categories</h4>
                    <ul>
                        <li><a href="#">Best Seller</a></li>
                        <li><a href="Kitchen.html">Kitchen</a></li>
                        <li><a href="#">Clothing</a></li>
                        <li><a href="#">Shoes</a></li>
                        <li><a href="#">Electrical Appliance</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 footer-col">
                    <h4>Follow Us</h4>
                    <div class="socialLinks">
                        <a href="#"> <i class="fab fa-facebook-f"></i></a>
                        <a href="#"> <i class="fab fa-instagram"></i></a>
                        <a href="#"> <i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4" style="border-color: rgba(255,255,255,0.2);"> <!-- Optional separator -->
             <div class="text-center text-muted mt-3"> <!-- Copyright -->
                <p>© <?php echo date("Y"); ?> Shopify. All Rights Reserved.</p>
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

     <!-- Boxicons JS (If still needed) -->
     <!-- <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script> -->
</body>

</html>