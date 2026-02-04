<?php
// 1. Get the current page name for active link styling
$current_page = basename($_SERVER['PHP_SELF']);

// 2. Calculate Cart Count (Bonus Fix)
// This counts the total quantity of all items in the session cart
$cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-green: #2A6049;
            --bg-cream: #FBF9F1;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-cream);
            color: var(--primary-green);
        }

        /* --- NAVBAR STYLING --- */
        .custom-navbar {
            background-color: var(--bg-cream);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-green) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            color: #555;
            font-weight: 400;
            margin: 0 15px;
            transition: color 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary-green) !important;
            font-weight: 600; /* Made slightly bolder for visibility */
        }

        .icon-btn {
            color: var(--primary-green);
            font-size: 1.2rem;
            text-decoration: none;
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -10%);
            color: white;
            font-size: 0.6rem;
            font-weight: bold;
        }

        .offcanvas {
            background-color: var(--bg-cream);
            width: 80% !important;
        }
        
        .mobile-nav-link {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-green); 
            text-decoration: none;
            display: block;
            margin-bottom: 20px;
            opacity: 0.7; 
        }

        .mobile-nav-link.active {
            opacity: 1;
            text-decoration: underline;
        }
        
        .mobile-login {
            font-size: 1.2rem;
            color: var(--primary-green);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
        }

        .navbar-toggler {
            border: none;
            padding: 0;
            color: var(--primary-green);
            font-size: 1.5rem;
        }
        .navbar-toggler:focus {
            box-shadow: none;
        }

        @media (min-width: 992px) {
            .centered-nav {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                margin: 0;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg custom-navbar sticky-top">
    <div class="container-fluid px-3 px-lg-5 d-block"> 
        <div class="d-flex justify-content-between align-items-center w-100 position-relative">
            <a class="navbar-brand" href="<?php echo URLROOT; ?>">
                <i class="fas fa-shopping-basket"></i> Fresh Market
            </a>

            <div class="d-flex align-items-center d-lg-none gap-3">
                <a href="<?php echo URLROOT; ?>/cart" class="icon-btn">
                    <i class="fas fa-shopping-bag fa-lg"></i>
                    <span class="cart-badge"><?php echo $cart_count; ?></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="desktopMenu">
                <ul class="navbar-nav centered-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" 
                           href="<?php echo URLROOT; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'shop.php') ? 'active' : ''; ?>" 
                           href="<?php echo URLROOT; ?>/shop">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" 
                           href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" 
                           href="#">Contact</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-4 ms-auto">
                    <a href="#" class="icon-btn"><i class="fas fa-search"></i></a>
                    
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <div class="dropdown">
                            <a href="#" class="icon-btn d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                                <i class="fas fa-user-check"></i> 
                                <span style="font-size:1rem;">Hi, <?php echo explode(' ', $_SESSION['user_name'])[0]; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                <?php if($_SESSION['user_role'] == 'admin'): ?>
                                    <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/admin">Dashboard</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/orders">My Orders</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/users/logout">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo URLROOT; ?>/users/login" class="icon-btn d-flex align-items-center gap-2">
                            <i class="fas fa-user-circle"></i> <span style="font-size:1rem;">Log In</span>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo URLROOT; ?>/cart" class="icon-btn">
                        <i class="fas fa-shopping-bag fa-lg"></i>
                        <span class="cart-badge"><?php echo $cart_count; ?></span>
                    </a>
                </div>
            </div>
        </div> 

        <div class="d-lg-none mt-2">
            <a href="#" class="icon-btn">
                <i class="fas fa-search"></i>
            </a>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header justify-content-end">
        <button type="button" class="btn-close fa-2x" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body px-4">
        
        <?php if(isset($_SESSION['user_id'])): ?>
            <div class="mb-4">
                <div class="text-muted small mb-1">Signed in as</div>
                <div class="fw-bold text-success mb-3"><?php echo $_SESSION['user_name']; ?></div>
                
                <?php if($_SESSION['user_role'] == 'admin'): ?>
                    <a href="<?php echo URLROOT; ?>/admin" class="mobile-login mb-2">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>
                <?php endif; ?>
                
                <a href="<?php echo URLROOT; ?>/users/logout" class="mobile-login text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        <?php else: ?>
            <a href="<?php echo URLROOT; ?>/users/login" class="mobile-login">
                <i class="fas fa-user-circle fa-lg"></i> Log In
            </a>
        <?php endif; ?>
        <div class="d-flex flex-column border-top pt-4">
            <a href="<?php echo URLROOT; ?>" 
               class="mobile-nav-link <?php echo ($current_page == 'index.php') ? 'active text-success' : ''; ?>">Home</a>
            
            <a href="<?php echo URLROOT; ?>/shop" 
               class="mobile-nav-link <?php echo ($current_page == 'shop.php') ? 'active text-success' : ''; ?>">Shop</a>
            
            <a href="#" class="mobile-nav-link">About</a>
            <a href="#" class="mobile-nav-link">Contact</a>
        </div>
    </div>
</div>

<div class="container-fluid px-0">