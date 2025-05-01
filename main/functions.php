<?php
session_start();


/*Get database connection*/

require_once __DIR__ . '/../admin/config/db.php';

/**
 * Get user data by ID
 */// In functions.php

function getUserData($userId, $pdo) { // Added $pdo parameter
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id"); // Use $pdo
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Modify updateUserData similarly

function getCurrentUser() {
    global $pdo; // Need to access the global $pdo from db.php
    if (isLoggedIn()) {
        // Pass $pdo to getUserData
        return getUserData($_SESSION['id'], $pdo);
    }
    return null;
}

// profile.php would not need to change how it calls getCurrentUser
/**
 * Update user data
 */
function updateUserData($userId, $data, PDO $pdo) {
    $sql = "UPDATE users SET 
            username = :username,
            email = :email,
            phone = :phone,
            address = :address,
            updated_at = NOW()
            WHERE id = :id";
    
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':username' => $data['name'],
        ':email' => $data['email'],
        ':phone' => $data['phone'],
        ':address' => $data['address'],
        ':id' => $userId
    ]);
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Get current user data
 */

/**
 * Redirect to a specific page
 */
function redirect($page) {
    header("Location: index.php?page=" . $page);
    exit();
}
?> 