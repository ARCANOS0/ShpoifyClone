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

  <!-- <link rel="stylesheet" href="stylesheet.css"> -->
  <link rel="stylesheet" href="../all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">
  
  
  
  
</head>
<script type="text/JavaScript" src="../snippets/formValidation.js" defer></script>

<body>

  <!-- navbar section -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light">
    <div class="container-fluid">
      <img style="height: 70px;" src="../pic/logo (2).png" alt="Logo">
      <h3>Shopify</h3>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span><i id="bar" class="fa-solid fa-bars"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="register.php">Register</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Cart <i class="fa-solid fa-cart-shopping"></i></a>
          </li>
        </ul>
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>
    </div>
  </nav>


<section id="SignUpSec">

  <div class="wrapper">
    <h1>SignUp</h1>
    <p id="error-message"></p>
    <form id="form" action="">
      
      <div class="incorrect">
        <label for="username-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
        </label>
      <input type="text" name="username" id="username-input" placeholder="Username">
    </div>
    
    <div>
      <label for="email-input">
        <span>@</span>
      </label>
      <input type="email" name="email" id="email-input" placeholder="abc@gmail.com">
    </div>

    <div>
      <label for="password">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
      </label>
      <input type="password" name="password" id="password" placeholder="password">
    </div>

    <div>
      <label for="repeat-pass">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
      </label>
      <input type="password" name="repeat-pass" id="repeat-pass" placeholder="Repeat Password">
    </div>

    <div>
      <button type="submit">SignUp</button>
    </div>
    
  
  <p>Do You Have An Account? <a href="Login.php">Login</a></p>
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

</html>