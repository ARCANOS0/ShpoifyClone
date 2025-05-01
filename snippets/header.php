<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) session_start();

// Get user data if logged in
$current_user = null;
if (!empty($_SESSION['user_id'])) {
    require_once __DIR__ . '/../admin/config/db.php'; // Get $pdo
    
    try {
        $stmt = $pdo->prepare("SELECT id, name, profile_picture FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $current_user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Header User Fetch Error: " . $e->getMessage());
    }
}
?>

<header class="header">
    <nav class="navbar">
        <!-- Your existing navbar content -->
        
        <div class="user-profile">
            <?php if ($current_user): ?>
                <div class="profile-dropdown">
                    <div class="profile-trigger">
                        <img src="../uploads/profiles/<?= htmlspecialchars($current_user['profile_picture']) ?>" 
                             alt="Profile" 
                             class="profile-pic">
                        <span class="profile-name"><?= htmlspecialchars($current_user['name']) ?></span>
                    </div>
                    <div class="dropdown-menu">
                        <a href="profile.php" class="dropdown-item">
                            <i class="fas fa-user"></i> Profile
                        </a>
                        <a href="logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="auth-links">
                    <a href="login.php" class="login-btn">Login</a>
                    <a href="register.php" class="register-btn">Register</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>