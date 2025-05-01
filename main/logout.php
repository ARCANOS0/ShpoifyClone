<?php
// Start the session
session_start();

// Clear all session data
session_unset();
session_destroy();

// Expire session cookies (optional but recommended)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Redirect to homepage
header("Location: ../index.php");
exit();
?>

<!-- Fallback HTML if redirect fails -->
<!DOCTYPE html>
<html>
<head>
    <title>Logging Out...</title>
    <meta http-equiv="refresh" content="3;url=index.php">
</head>
<body>
    <h2>You have been successfully logged out.</h2>
    <p>Redirecting to <a href="index.php">homepage</a>...</p>
</body>
</html>