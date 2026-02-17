<?php
// Gatekeeper: Redirects if not Admin
function ensureAdmin() {
    // 1. Check if user is NOT logged in
    if (!isLoggedIn()) {
        redirect('users/login');
    }

    // 2. Check if user is logged in but NOT an admin
    if ($_SESSION['user_role'] != 'admin') {
        redirect('pages/index'); // Send them back home
    }
}

// FUNCTION: Count Pending Orders for Sidebar Badge
function getNewOrderCount() {
    // We instantiate the Database class directly to avoid loading Models in Views
    // (Assuming your Database library is at app/libraries/Database.php)
    $db = new Database();
    
    $db->query("SELECT COUNT(*) as count FROM orders WHERE order_status = 'pending'");
    $row = $db->single();
    
    return ($row) ? $row->count : 0;
}
?>