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