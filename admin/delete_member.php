<?php
require_once __DIR__ . 'config/db.php';
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Delete the member
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        
        // Redirect back to members page with success message
        $_SESSION['success'] = "تم حذف العضو بنجاح";
        header('Location: members.php');
        exit();
    } catch(PDOException $e) {
        // Redirect back with error message
        $_SESSION['error'] = "حدث خطأ أثناء حذف العضو";
        header('Location: members.php');
        exit();
    }
} else {
    // If no ID is provided, redirect back
    header('Location: members.php');
    exit();
}
?> 
