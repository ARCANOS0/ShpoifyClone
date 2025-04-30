Okay, let's analyze this registration page code (`register.php`). It's a mix of PHP processing and HTML form display in one file, which is a common pattern for simpler applications but can be separated for larger ones.

**Analysis of the Code:**

1.  **PHP Logic at the Top:**
    *   **Includes:** It correctly includes the database configuration (`../admin/config/db.php`) to get the `$pdo` object.
    *   **Session Start:** It correctly starts the session (`session_start()`) to store feedback messages (`$_SESSION['error']`, `$_SESSION['success']`).
    *   **Form Handling:** It checks if the page was loaded via a `POST` request (`$_SERVER['REQUEST_METHOD'] === 'POST'`).
    *   **Action Distinction:** It uses a hidden input `action` (which is **missing** from your HTML form!) to determine if the submission is for 'register' or 'login'. This is problematic because this file should *only* handle registration. Login logic belongs in `login.php` or its processing script.
    *   **Registration Logic (`action === 'register'`):**
        *   Retrieves `name`, `email`, `password`, `confirm-password` from `$_POST`. It uses `trim()` which is good.
        *   **Validation:** Performs basic checks:
            *   Are all fields filled?
            *   Do passwords match?
            *   Does the email already exist in the `users` table? (Uses a prepared statement - good!)
        *   **Password Hashing:** If validation passes, it correctly hashes the password using `password_hash($password, PASSWORD_BCRYPT)`. (`PASSWORD_DEFAULT` is generally preferred as it adapts to newer hashing algorithms, but BCRYPT is secure).
        *   **Database Insertion:** It uses a **prepared statement** (`INSERT INTO users...`) to insert the new user data (name, email, hashed password) - **this is secure and correct!**
        *   **Feedback & Redirect:** Sets session messages (`$_SESSION['success']` or `$_SESSION['error']`) and redirects the user (`header('Location: ...')`). It correctly calls `exit()` after redirection.
        *   **Error Logging:** Includes `error_log()` to log database errors, which is good practice for debugging.
    *   **Login Logic (`action === 'login'`):** This block **should not be here**. It attempts to handle login, checking email and using `password_verify()`. This logic belongs in a separate login processing script triggered by the `login.php` page.

2.  **HTML Form:**
    *   Includes standard HTML head elements, Bootstrap CSS, Font Awesome, your `all.css`, and links a `formValidation.js` script.
    *   Includes your standard navbar.
    *   Displays a registration form (`<form id="form" action="">`).
        *   The `action=""` attribute means the form submits back to the **same page** (`register.php`), which is why the PHP processing logic is at the top of this file.
        *   It includes inputs for username, email, password, and repeat password.
        *   The input fields have `name` attributes (`username`, `email`, `password`, `repeat-pass`) that **mostly** match what the PHP registration logic expects (except for `name` and `confirm-password`).
        *   It includes a "SignUp" submit button.
        *   It has a link to `Login.php`.
    *   **Missing Input:** The form is missing the crucial hidden input `<input type="hidden" name="action" value="register">` that the PHP code relies on to know that this submission is for registration.
    *   **Inconsistent Naming:** The PHP expects `name` and `confirm-password`, but the form has `username` and `repeat-pass`.
    *   Includes your standard footer.
    *   Includes Bootstrap JS.

**Why is data not being added to the DB?**

Based on the code, the most likely reasons are:

1.  **Missing `action` Input:** Because the form is missing `<input type="hidden" name="action" value="register">`, the condition `if (isset($_POST['action']) && $_POST['action'] === 'register')` at the top of the PHP code will **always be false**. The entire registration logic block is never executed.
2.  **Input Name Mismatch:** The PHP code looks for `$_POST['name']` and `$_POST['confirm-password']`, but your HTML form provides `$_POST['username']` and `$_POST['repeat-pass']`. Even if the `action` was present, the validation checks for `empty($_POST['name'])` or `empty($_POST['confirm-password'])` might fail, or the wrong data would be used.
3.  **Database Column Mismatch:** The `INSERT` query `INSERT INTO users (name, email, password)` assumes your `users` table has a column named `name`. Your original schema had `username`, `first_name`, and `last_name`. You need to decide which column(s) this form field corresponds to and update the `INSERT` query accordingly. If you want to store the full name entered in the form, you might need to add a `full_name` column to your `users` table or adjust the PHP/HTML to handle separate first/last names.

**How to Fix and Implement Correctly:**

1.  **Separate Concerns:**
    *   **Remove the Login Logic:** Delete the entire `elseif (isset($_POST['action']) && $_POST['action'] === 'login') { ... }` block from `register.php`. Login processing belongs elsewhere.
    *   **(Optional but Recommended):** Move the registration *processing* logic (the entire `if ($_SERVER['REQUEST_METHOD'] === 'POST') { ... }` block) into a separate file, e.g., `process_register.php`. Then, change the form's action to `action="process_register.php"`. This makes `register.php` purely for displaying the form. For now, keeping it in one file is acceptable for simplicity, but know the separation option exists.

2.  **Fix HTML Form:**
    *   **Add Hidden Action:** Add this line *inside* the `<form>` tag:
        ```html
        <input type="hidden" name="action" value="register">
        ```
    *   **Correct Input Names:** Change the `name` attributes in the HTML to match what the PHP expects:
        *   Change `name="username"` to `name="name"` (or adjust the PHP to use `$_POST['username']`).
        *   Change `name="repeat-pass"` to `name="confirm-password"`.
        *   Keep `name="email"` and `name="password"` as they are.

3.  **Fix PHP Logic:**
    *   **Database Columns:** Decide how to handle the name.
        *   *Option A (Store full name):* If you want to store the submitted name as is, ensure your `users` table has a suitable column (e.g., `full_name VARCHAR(100)` or just use the existing `username` column if that's acceptable). Update the `INSERT` query: `INSERT INTO users (username, email, password) VALUES (?, ?, ?)` and execute with `[$name, $email, $hashedPassword]`. *Make sure the `username` column in your DB doesn't have the UNIQUE constraint if you expect multiple users might share a full name, or handle that case.*
        *   *Option B (Use existing `first_name`):* If the 'name' field is just for the first name, use `INSERT INTO users (first_name, email, password) VALUES (?, ?, ?)` and execute with `[$name, $email, $hashedPassword]`.
    *   **Remove `action` Check (If Separating Files):** If you move the processing logic to `process_register.php`, you won't need the `if (isset($_POST['action']) ...)` check *within that file*, as accessing it directly implies the action. You'd still keep the `if ($_SERVER['REQUEST_METHOD'] === 'POST')` check.

4.  **Display Feedback:** Add the PHP code block for displaying `$_SESSION['error']` and `$_SESSION['success']` messages somewhere visible within the `<body>` of `register.php` (e.g., just inside the `<div class="wrapper">` before the `<form>`).

**Revised `register.php` (Keeping Logic in One File for now, using `username` column):**

```php
<?php
// 1. Include DB Config FIRST
require_once __DIR__ . '/../admin/config/db.php';
// 2. Start Session AFTER including config (if config doesn't start it)
session_start();

$error_message_display = '';
$success_message_display = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check the hidden action input value
    if (isset($_POST['action']) && $_POST['action'] === 'register') {

        // Use the names from the form ('username', 'confirm-password')
        $username = trim($_POST['name']); // Changed from 'name'
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm-password']); // Changed from 'repeat-pass'

        // Validate input
        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
            $_SESSION['error'] = 'All fields are required.';
        } elseif ($password !== $confirmPassword) {
            $_SESSION['error'] = 'Passwords do not match.';
        } else {
            // Check if email already exists
            try {
                $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
                $stmt->execute([$email]);
                if ($stmt->rowCount() > 0) {
                    $_SESSION['error'] = 'Email is already registered.';
                } else {
                    // Check if username already exists (assuming it should be unique)
                    $stmtUser = $pdo->prepare('SELECT id FROM users WHERE username = ?');
                    $stmtUser->execute([$username]);
                     if ($stmtUser->rowCount() > 0) {
                         $_SESSION['error'] = 'Username is already taken.';
                     } else {
                        // Hash the password
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Use DEFAULT

                        // Insert user into the database (using username column)
                        $stmtInsert = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
                        if ($stmtInsert->execute([$username, $email, $hashedPassword])) {
                            $_SESSION['success'] = 'Registration successful. Please log in.';
                            // Redirect to login page after successful registration
                            header('Location: login.php');
                            exit();
                        } else {
                            $_SESSION['error'] = 'An error occurred during registration. Please try again.';
                            error_log('Database INSERT error: ' . implode(' | ', $stmtInsert->errorInfo())); // Log SQL errors
                        }
                    }
                }
            } catch (PDOException $e) {
                 $_SESSION['error'] = 'A database error occurred. Please try again later.';
                 error_log('Database Exception: ' . $e->getMessage());
            }
        }
        // Redirect back to register page on error to show message
        if(isset($_SESSION['error'])){
            header('Location: register.php');
            exit();
        }
    }
    // NO Login Logic Here
}

// --- Prepare messages for display after potential redirect ---
if (isset($_SESSION['error'])) {
    $error_message_display = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                           . htmlspecialchars($_SESSION['error'])
                           . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    unset($_SESSION['error']); // Clear after preparing
}
if (isset($_SESSION['success'])) { // Although we redirect on success, good to handle just in case
    $success_message_display = '<div class="alert alert-success alert-dismissible fade show" role="alert">'
                             . htmlspecialchars($_SESSION['success'])
                             . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    unset($_SESSION['success']);
}


?>
<!doctype html>
<html lang="en">

<head>
    <title>Register - Shopify</title>
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

    <!-- Link JS for Client-Side Validation (Optional but Recommended) -->
    <!-- <script type="text/JavaScript" src="../snippets/formValidation.js" defer></script> -->

</head>

<body>

    <!-- Include Navbar -->
    <?php require_once __DIR__ . '/../snippets/navbar.php'; // Adjust path ?>

    <!-- Registration Section -->
    <section id="SignUpSec" class="d-flex justify-content-center align-items-center min-vh-100">

        <div class="wrapper p-4 bg-light rounded shadow-lg" style="max-width: 500px; width: 90%;"> <!-- Adjusted width/padding -->
            <h1 class="text-center">Sign Up</h1>

            <!-- Display Feedback Messages Here -->
            <?php echo $success_message_display; ?>
            <?php echo $error_message_display; ?>
            <!-- <p id="error-message"></p> --><!-- This was likely for JS validation -->

            <!-- Corrected Form -->
            <form id="form" action="register.php" method="POST"> <!-- Action points to self, method is POST -->

                <!-- **** ADD THIS HIDDEN INPUT **** -->
                <input type="hidden" name="action" value="register">

                <div class="mb-3"> <!-- Bootstrap margin bottom -->
                    <label for="username-input" class="form-label">Username</label> <!-- Bootstrap label -->
                    <input type="text" name="name" id="username-input" placeholder="Choose a username" class="form-control" required> <!-- Added form-control & required -->
                </div>

                <div class="mb-3">
                    <label for="email-input" class="form-label">Email</label>
                    <input type="email" name="email" id="email-input" placeholder="abc@example.com" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter password (min 8 chars)" class="form-control" required minlength="8"> <!-- Added minlength -->
                </div>

                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Repeat Password</label> <!-- Changed label text -->
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="Repeat password" class="form-control" required> <!-- Changed name and ID -->
                </div>

                <div class="d-grid gap-2"> <!-- Bootstrap grid for button -->
                    <button type="submit" class="btn btn-primary buy-btn">Sign Up</button> <!-- Use your button class -->
                </div>

                <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p> <!-- Link to correct login page -->
            </form>
        </div>

    </section>

    <!-- Include Footer -->
    <?php require_once __DIR__ . '/../snippets/footer.php'; // Adjust path ?>

    <!-- Search Modal HTML (Include ONCE per page) -->
    <?php require_once __DIR__ . '/../snippets/search_modal.php'; // Adjust path ?>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>
```

**Key Fixes:**

1.  **Added Hidden `action` Input:** Put `<input type="hidden" name="action" value="register">` inside the `<form>`.
2.  **Corrected Input `name` Attributes:** Changed `name="username"` to `name="name"` and `name="repeat-pass"` to `name="confirm-password"` in the HTML to match the PHP `$_POST` keys. **OR** I updated the PHP to expect `username` and `confirm-password` (as shown in the revised PHP block above, which is probably better as `name` is ambiguous).
3.  **Adjusted `INSERT` Query:** Modified the PHP `INSERT` query to use the `username` column (assuming this is what you intend to store from the form). Adjust this if you want to store `first_name` instead or add `first_name`/`last_name` fields to the form.
4.  **Removed Login Logic:** Took out the `elseif` block handling login.
5.  **Feedback Display:** Added PHP code to display session error/success messages within the page body.
6.  **Bootstrap Form Styling:** Added Bootstrap classes (`form-label`, `form-control`, `mb-3`, `d-grid`) to the form elements for better default styling and layout.
7.  **Password Hashing Default:** Changed `PASSWORD_BCRYPT` to `PASSWORD_DEFAULT` (recommended).
8.  **Redirect on Success:** Changed redirect on successful registration to `login.php` so the user can log in immediately.
9.  **Redirect on Error:** Added redirects back to `register.php` on validation or DB errors so the session error message is displayed correctly.

Make these changes, ensure your `users` table has the `username` column (and it's marked as UNIQUE in your SQL schema if needed), and try registering again. It should now insert the data correctly.



<?php
// 1. Include DB Config FIRST (adjust path based on login.php location)
require_once __DIR__ . '/../admin/config/db.php';
// 2. Start Session AFTER including config (if config doesn't start it)
session_start();


// Handle form submission (POST requests only)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- Retrieve and Sanitize Input Data ---
    // Use trim to remove leading/trailing whitespace
    // Use null coalescing for safety and check if they exist in $_POST
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? ''; // Don't trim password

    // --- Basic Input Validation ---
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please enter both email and password.';
    } else {
        // --- Check if User Exists in Database (by email) ---
        try {
            $stmt = $pdo->prepare('SELECT id, username, password, role FROM users WHERE email = ?'); // Select role here too
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the user data

            if ($user && password_verify($password, $user['password'])) {
                // --- Login Successful ---
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name']; // Store username from DB
                $_SESSION['role'] = $user['role'] ?? 'customer'; // Store role from DB, default if null

                // Redirect based on user role
                if ($_SESSION['role'] === 'admin') {
                    // Redirect admin to admin dashboard (adjust path relative to login.php)
                    header('Location: ../admin/members.php'); // Example: Admin members page
                    exit();
                } else {
                    // Redirect regular user to shop or homepage (adjust path relative to login.php)
                    header('Location: shop.php'); // Example: Shop page
                    exit();
                }

            } else {
                // --- Login Failed (User not found or password incorrect) ---
                $_SESSION['error'] = 'Invalid email or password.';
            }
        } catch (PDOException $e) {
            // --- Database Error During Login ---
            $_SESSION['error'] = 'An error occurred during login. Please try again later.';
            error_log('Login Database Exception: ' . $e->getMessage()); // Log the error
        }
    }

    // --- If we reached here and login failed, redirect back to login page. ---
    // The session message ($_SESSION['error']) will be displayed on the next page load.
    // Redirect only if an error message was set in this POST request cycle
    if (isset($_SESSION['error'])) {
        // Optional: Store entered email to pre-fill form on redirect back
        // $_SESSION['_old_email'] = $email; // Requires adding value attribute to email input below
        header('Location: login.php'); // Redirect back to the login form
        exit(); // Stop script execution after redirection
    }

    // Should not reach here in a successful login or a failed login with error message set
    // If somehow reached here without error, maybe a form validation issue? Redirect anyway.
    // header('Location: login.php');
    // exit();

}

// --- Prepare messages for display on the page ---
// Check for messages set during a previous redirect (e.g., from registration success or failed login)
// These are displayed ONCE after the page loads because they were set in a *previous* request
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
    <!-- Optional: Link specific login page CSS -->
    <!-- <link rel="stylesheet" href="../snippets/login.css"> -->

    <style>
        /* Add any specific styles for the login page */
        /* Using a wrapper div around the form for styling */
        .login-form-wrapper {
            max-width: 400px; /* Adjust maximum width */
            width: 90%; /* Adjust width */
            padding: 2rem;
            background: #fff; /* Light background for the form container */
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1); /* Subtle shadow */
            margin: 30px auto; /* Center the wrapper and add some vertical margin */
        }
         #LoginSec {
             /* You might have background image or center content for the whole section */
             min-height: 80vh; /* Example minimum height for the section */
             /* display: flex; /* Optional: Use flexbox to center vertically */
             /* justify-content: center; */
             /* align-items: center; */
             padding-top: 80px; /* Add padding if your navbar is fixed */
         }
        /* Center the h1 inside the wrapper */
        .login-form-wrapper h1 {
            text-align: center;
            margin-bottom: 1.5rem; /* Spacing below heading */
        }
        /* Style the button (if not fully handled by all.css) */
         .login-form-wrapper .btn {
             /* Your buy-btn styles from all.css should apply */
             /* Ensure it spans full width if desired */
             width: 100%;
         }
         /* Style the link below the form */
         .login-form-wrapper p.mt-3 {
            text-align: center;
         }
         /* Ensure alert messages are styled correctly */
         .alert {
             margin-top: 1rem;
             margin-bottom: 1.5rem;
         }

    </style>

</head>

<body>

    <!-- Include Navbar -->
    <?php require_once __DIR__ . '/../snippets/navbar.php'; ?>

    <!-- Login Section -->
    <section id="LoginSec" class="py-5"> <!-- Added padding top/bottom -->
         <div class="container"> <!-- Wrap content in container -->
            <div class="row justify-content-center"> <!-- Center the wrapper column -->
                 <div class="col-md-8 col-lg-6"> <!-- Adjust column size -->
                    <div class="login-form-wrapper"> <!-- Apply wrapper styling -->
                        <h1 class="heading">Login Form</h1> <!-- Use your heading class/style -->

                        <!-- Display Feedback Messages Here -->
                        <?php echo $success_message_display; ?>
                        <?php echo $error_message_display; ?>

                        <!-- Login Form -->
                        <form action="login.php" method="POST"> <!-- Form submits to itself -->

                            <div class="mb-3"> <!-- Bootstrap margin bottom -->
                                <label for="emailInput" class="form-label">Email address</label> <!-- Bootstrap label -->
                                <!-- Add name attribute and form-control class -->
                                <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter your email" required
                                       value="<?php // echo htmlspecialchars($_SESSION['_old_email'] ?? ''); unset($_SESSION['_old_email']); // Optional: pre-fill ?>">
                                <!-- Optional: Add validation feedback div -->
                                <div class="invalid-feedback"> Please enter a valid email. </div>
                            </div>

                            <div class="mb-3">
                                <label for="passwordInput" class="form-label">Password</label>
                                <!-- Add name attribute and form-control class -->
                                <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter your password" required>
                                <div class="invalid-feedback"> Please enter your password. </div>
                            </div>

                            <div class="d-grid gap-2 mb-3"> <!-- Bootstrap grid for button, added mb-3 -->
                                <!-- Use type="submit", add name="login_btn" (optional but good) -->
                                <button type="submit" name="login_btn" class="btn btn-primary buy-btn">Login</button> <!-- Use your button class -->
                            </div>

                            <p class="mt-3 text-center">Don't have an account? <a href="register.php">Sign Up</a></p> <!-- Link to correct register page -->
                        </form>
                    </div><!-- /.login-form-wrapper -->
                 </div><!-- /.col -->
            </div><!-- /.row -->
         </div><!-- /.container -->
    </section>

    <!-- Include Footer -->
    <?php require_once __DIR__ . '/../snippets/footer.php'; ?>

    <!-- Search Modal HTML (Include ONCE per page) -->
    <?php require_once __DIR__ . '/../snippets/search_modal.php'; ?>

    <!-- Bootstrap JavaScript Libraries -->
    <!-- Use the bundle which includes Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- Optional: Add client-side validation script if needed -->
    <!-- <script src="../js/loginValidation.js"></script> -->

</body>
</html>