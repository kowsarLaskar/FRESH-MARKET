<?php
// Ensure session is started if not already
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// 2. Check if user is an ADMIN
function isAdmin() {
    return isLoggedIn() && $_SESSION['user_role'] === 'admin';
}

// 3. Check if user is a DELIVERY BOY
function isDeliveryBoy() {
    return isLoggedIn() && $_SESSION['user_role'] === 'delivery_boy';
}

// 4. Create the Session (Login the user)
function createUserSession($user) {
    $_SESSION['user_id'] = $user->user_id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->full_name;
    $_SESSION['user_role'] = $user->role;
    
    // Redirect based on Role
    if($user->role == 'admin') {
        redirect('admin/dashboard'); 
    } elseif ($user->role == 'delivery_boy') {
        redirect('delivery/dashboard');
    } else {
        redirect('pages/index'); // Send customers to Home
    }
}

// 5. Destroy the Session (Logout)
function logout() {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_role']);
    session_destroy();
    redirect('users/login');
}

// 6. Redirect Helper (Simple shorthand)
function redirect($page) {
    header('location: ' . URLROOT . '/' . $page);
}

function flash($name = '', $message = '', $class = 'alert alert-success') {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            // SETTING DATA
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            // DISPLAYING DATA
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}