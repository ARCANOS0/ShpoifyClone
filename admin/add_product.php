<?php
// Include DB connection (adjust path based on add_product.php location)
require_once __DIR__ . '/config/db.php';
// require_once __DIR__ . '/../main/functions.php'; // Include functions for user checks

// --- Admin Access Control ---
// // Ensure user is logged in AND has the 'admin' role
// if (!isLoggedIn() || $_SESSION['role'] !== 'admin') {
//     $_SESSION['error_message'] = 'Unauthorized access. Please log in as admin.';
//     // Redirect to login page (adjust path relative to admin/add_product.php)
//     header('Location: ../main/login.php');
//     exit();
// }

// --- Fetch Categories for the dropdown ---
$categories = []; // Initialize categories array
try {
    $stmt = $pdo->query("SELECT id, name FROM categories ORDER BY name ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Admin Add Product: Category fetch error: " . $e->getMessage());
    // You might display an error message here, but let's proceed with an empty dropdown
}

// --- Prepare feedback messages (set by process_add_product.php) ---
$success_message_display = '';
$error_message_display = '';
if (isset($_SESSION['success_message'])) {
    $success_message_display = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">'
                             . htmlspecialchars($_SESSION['success_message'])
                             . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
    $error_message_display = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">'
                           . htmlspecialchars($_SESSION['error_message'])
                           . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    unset($_SESSION['error_message']);
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Admin - Add Product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Favicon - Path relative to admin/ -->
    <link rel="shortcut icon" href="../pic/logo (2).png" type="image/x-icon">

    <!-- Your Custom CSS (Load AFTER Bootstrap) - Path relative to admin/ -->
    <link rel="stylesheet" href="../all.css">
    <!-- Optional: Admin specific CSS -->
    <!-- <link rel="stylesheet" href="css/admin.css"> -->

    <style>
        /* Specific styles for the form container */
        .admin-form-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .admin-form-container h3 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
         /* Ensure form controls have some bottom margin */
        .admin-form-container .form-control,
        .admin-form-container .form-label {
             margin-bottom: 0.5rem; /* Adjust as needed */
         }
        .admin-form-container .btn {
             width: 100%; /* Full width button */
             margin-top: 1rem;
         }
    </style>

</head>

<body>



    <div class="container my-5 pt-5">
        <div class="admin-form-container">

            <h3>Add a New Product</h3>

            <!-- Display Feedback Messages -->
            <?php echo $success_message_display; ?>
            <?php echo $error_message_display; ?>

            <!-- Add Product Form -->
            <!-- Action points to the processing script -->
            <!-- enctype is crucial for file uploads -->
            <form action="process_add_product.php" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="p_name" placeholder="Enter product name" required>
                </div>

                <div class="mb-3">
                    <label for="productDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="productDescription" name="p_description" rows="4" placeholder="Enter product description" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="productPrice" class="form-label">Price (USD)</label>
                    <input type="number" class="form-control" id="productPrice" name="p_price" min="0" step="0.01" placeholder="Enter product price" required>
                </div>

                 <div class="mb-3">
                     <label for="productCategory" class="form-label">Category</label>
                     <select class="form-select" id="productCategory" name="p_category_id" required>
                         <option value="">Select a category</option>
                         <?php foreach ($categories as $category): ?>
                             <option value="<?php echo htmlspecialchars($category['id']); ?>">
                                 <?php echo htmlspecialchars($category['name']); ?>
                             </option>
                         <?php endforeach; ?>
                         <?php if (empty($categories)): ?>
                              <option value="" disabled>No categories found. Add categories first.</option>
                         <?php endif; ?>
                     </select>
                     <?php if (empty($categories)): ?>
                         <small class="form-text text-muted">You need to add categories before adding products.</small>
                     <?php endif; ?>
                 </div>

                <div class="mb-3">
                    <label for="productImage" class="form-label">Product Image</label>
                    <!-- Accept attribute suggests file types -->
                    <input type="file" class="form-control" id="productImage" name="p_image" accept="image/png, image/jpg, image/jpeg, image/webp" required>
                </div>

                 <div class="mb-3">
                    <label for="productStock" class="form-label">Stock Quantity</label>
                    <input type="number" class="form-control" id="productStock" name="p_stock_quantity" min="0" value="0" placeholder="Enter stock quantity" required>
                </div>

                 <div class="mb-3">
                    <label for="productTags" class="form-label">Tags (Optional)</label>
                    <input type="text" class="form-control" id="productTags" name="p_tags" placeholder="Comma-separated tags (e.g., kitchen, blender)">
                </div>

                 <div class="form-check mb-3">
                     <input class="form-check-input" type="checkbox" value="1" id="productAvailable" name="p_is_available" checked>
                     <label class="form-check-label" for="productAvailable">
                        Available for sale
                     </label>
                 </div>


                <!-- Submit button -->
                <button type="submit" name="add_product_submit" class="btn btn-primary buy-btn">
                    Add Product
                </button>

            </form>

        </div>
    </div>



    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- Optional: Add client-side form validation script -->
    <!-- <script src="js/form-validation.js"></script> -->

</body>

</html>