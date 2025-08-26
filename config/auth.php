 
<?php
session_start();

// Check if user is logged in
function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

// Check if user has specific role
function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

// Redirect if not authenticated
function requireAuth() {
    if (!isAuthenticated()) {
        header("Location: ../login/login.php");
        exit();
    }
}

// Redirect if not authorized
function requireRole($role) {
    requireAuth();
    if (!hasRole($role)) {
        header("Location: ../dashboard.php?error=unauthorized");
        exit();
    }
}
?>