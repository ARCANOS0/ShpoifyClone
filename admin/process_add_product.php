<?php
// MUST be the very first line
session_start();
// Include DB connection (adjust path based on process_add_product.php location)
require_once __DIR__ . '/config/db.php';
// Include functions file if isLoggedIn() is defined there
// require_once __DIR__ . '/../main/functions.php'; // Adjust path to your functions.php

// --- Admin Access Control ---
// Ensure user is logged in AND has the 'admin' role
// if (!isLoggedIn() || $_SESSION['role'] !== 'admin') {
//     $_SESSION['error_message'] = 'Unauthorized access.';
//     header('Location: ../main/login.php'); // Redirect to login
//     exit();
// }

// --- Check if form was submitted ---
// Check for the submit button's name
if (!isset($_POST['add_product_submit'])) {
    // If not submitted via the form, redirect back
    header('Location: add_product.php');
    exit();
}

// --- Retrieve & Sanitize Input Data ---
$p_name = trim($_POST['p_name'] ?? '');
$p_description = trim($_POST['p_description'] ?? '');
// Use filter_input for more robust validation and sanitization
$p_price = filter_input(INPUT_POST, 'p_price', FILTER_VALIDATE_FLOAT);
$p_category_id = filter_input(INPUT_POST, 'p_category_id', FILTER_VALIDATE_INT);
$p_stock_quantity = filter_input(INPUT_POST, 'p_stock_quantity', FILTER_VALIDATE_INT);
$p_tags = trim($_POST['p_tags'] ?? ''); // Basic trimming for tags
$p_is_available = isset($_POST['p_is_available']) ? 1 : 0; // Check if checkbox was checked

// --- File Upload Handling ---
$p_image = $_FILES['p_image'] ?? null; // Use null coalescing
$uploadOk = true;
$image_full_path = null; // Path to store in DB

// Define upload directory (relative to your web root, NOT this script)
// Create this folder: C:/xampp/htdocs/Shopify/uploads/products/
$upload_dir_relative_to_root = '../uploads/products/'; // Adjust /Shopify/ if your project is in a subfolder
$upload_dir_filesystem = __DIR__ . '/../uploads/products/'; // Path relative to this script for move_uploaded_file

// Ensure upload directory exists (create if not)
if (!is_dir($upload_dir_filesystem)) {
    mkdir($upload_dir_filesystem, 0777, true); // Create recursively with permissions
}

// Check if a file was actually uploaded
if ($p_image && $p_image['error'] === UPLOAD_ERR_OK) {
    // Basic File Validation
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
    $max_size = 5 * 1024 * 1024; // 5MB

    $file_type = mime_content_type($p_image['tmp_name']);
    $file_size = $p_image['size'];
    $file_error = $p_image['error'];

    if ($file_error !== UPLOAD_ERR_OK) {
        $_SESSION['error_message'] = 'File upload error: ' . $file_error;
        $uploadOk = false;
    } elseif (!in_array($file_type, $allowed_types)) {
        $_SESSION['error_message'] = 'Invalid file type. Only JPG, JPEG, PNG, & WebP are allowed.';
        $uploadOk = false;
    } elseif ($file_size > $max_size) {
        $_SESSION['error_message'] = 'File is too large. Max size: ' . ($max_size / 1024 / 1024) . 'MB.';
        $uploadOk = false;
    }

    // Generate a unique filename
    $file_extension = pathinfo($p_image['name'], PATHINFO_EXTENSION);
    $unique_file_name = uniqid('product_', true) . '.' . $file_extension;
    $target_file_filesystem = $upload_dir_filesystem . $unique_file_name;
    $image_full_path = $upload_dir_relative_to_root . $unique_file_name; // This is what goes into the DB

    // Move the uploaded file
    if ($uploadOk) {
        if (!move_uploaded_file($p_image['tmp_name'], $target_file_filesystem)) {
            $_SESSION['error_message'] = 'Error moving uploaded file.';
            $uploadOk = false;
        }
    }

} else {
     // Handle case where file is required but wasn't uploaded (e.g. no file selected or upload error)
     if (isset($_POST['add_product_submit'])) { // Only set error if form was actually submitted
         $_SESSION['error_message'] = 'Product image is required.';
         $uploadOk = false; // Treat as upload failure
     }
}

// --- Basic Data Validation (after file upload) ---
if (empty($p_name) || empty($p_description) || $p_price === false || $p_price < 0 || $p_category_id === false || $p_category_id <= 0 || $p_stock_quantity === false || $p_stock_quantity < 0 || !$uploadOk) {
    // Combine validation errors and upload errors
    if (!isset($_SESSION['error_message'])) { // Don't overwrite specific upload errors
         $_SESSION['error_message'] = 'Please fill out all required fields correctly and ensure a valid image is uploaded.';
    }
    // Decide where to redirect on validation failure
    header('Location: add_product.php');
    exit();
}

// Optional: Check if category_id actually exists in categories table (more robust validation)
try {
    $stmtCat = $pdo->prepare("SELECT id FROM categories WHERE id = ?");
    $stmtCat->execute([$p_category_id]);
    if ($stmtCat->rowCount() === 0) {
        $_SESSION['error_message'] = 'Invalid category selected.';
        header('Location: add_product.php');
        exit();
    }
} catch (PDOException $e) {
    error_log("Admin Add Product: Category check error: " . $e->getMessage());
    $_SESSION['error_message'] = 'Database error checking category.';
    header('Location: add_product.php');
    exit();
}


// --- Insert Data into Database using PDO ---
try {
    $sql = "INSERT INTO products (name, description, price, category_id, image_url, stock_quantity, tags, is_available, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())"; // Use NOW() for timestamps

    $stmt = $pdo->prepare($sql);

    // Execute the prepared statement with the collected data
    if ($stmt->execute([$p_name, $p_description, $p_price, $p_category_id, $image_full_path, $p_stock_quantity, $p_tags, $p_is_available])) {
        // --- Success ---
        $_SESSION['success_message'] = 'New product added successfully!';
        // Redirect to the page where products are listed (you need to build this)
        header('Location: view_products.php'); // Example redirection
        exit();
    } else {
        // --- Database Insert Failed ---
        // Get detailed error information from the statement
        $errorInfo = $stmt->errorInfo();
        error_log("Database INSERT error: " . $errorInfo[2]); // Log the SQL error message
        $_SESSION['error_message'] = 'Failed to add product to database. Please try again.';
        header('Location: add_product.php'); // Redirect back to the form
        exit();
    }

} catch (PDOException $e) {
    // --- General Database Exception ---
    error_log("Database Exception during product insert: " . $e->getMessage());
    $_SESSION['error_message'] = 'A database error occurred while adding the product.';
    header('Location: add_product.php'); // Redirect back to the form
    exit();
} catch (Exception $e) {
     // Catch other exceptions (like the one thrown if category check fails)
     error_log("General Exception during product add: " . $e->getMessage());
     $_SESSION['error_message'] = $e->getMessage(); // Display the exception message
     header('Location: add_product.php'); // Redirect back
     exit();
}

// --- End of file ---
?>