<style>
    /* --- SHARED ADMIN SIDEBAR STYLES --- */
    .sidebar {
        width: 250px;
        height: 100vh;
        background-color: #1F4D3C; /* Dark Green */
        position: fixed;
        left: 0;
        top: 0;
        color: white;
        padding-top: 20px;
        z-index: 1000;
        overflow-y: auto; /* Scrollable if menu is too long */
    }

    .sidebar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 40px;
        display: block;
        color: white;
        text-decoration: none;
    }

    .sidebar .nav-link {
        color: rgba(255,255,255,0.8);
        padding: 15px 25px;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }

    .sidebar .nav-link:hover, 
    .sidebar .nav-link.active {
        color: white;
        background-color: rgba(255,255,255,0.15);
        border-left: 4px solid #5ba534; /* Highlight accent */
    }

    .sidebar .nav-link i { 
        width: 30px; 
        text-align: center;
        margin-right: 10px;
    }
    
    /* Global Layout Helper: Pushes content to the right */
    .content-wrapper, .main-content {
        margin-left: 250px;
        padding: 30px;
        transition: margin-left 0.3s;
    }

    /* Mobile Responsive: Hide sidebar on small screens */
    @media (max-width: 768px) {
        .sidebar { margin-left: -250px; }
        .content-wrapper, .main-content { margin-left: 0; }
    }
</style>

<div class="sidebar">
    <a href="<?php echo URLROOT; ?>/admin" class="sidebar-brand text-decoration-none">
        <i class="fas fa-leaf me-2"></i>FRESH ADMIN
    </a>
    
    <?php 
        // Auto-detect Active Page
        $url = $_SERVER['REQUEST_URI']; 
    ?>

    <nav class="nav flex-column">
        <a href="<?php echo URLROOT; ?>/admin" class="nav-link <?php echo (strpos($url, '/admin') !== false && strpos($url, 'Orders') === false && strpos($url, 'payouts') === false) ? 'active' : ''; ?>">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <a href="<?php echo URLROOT; ?>/products" class="nav-link <?php echo (strpos($url, 'products') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-box"></i> Products
        </a>

        <a href="<?php echo URLROOT; ?>/categories" class="nav-link <?php echo (strpos($url, 'categories') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-list"></i> Categories
        </a>

        <a href="<?php echo URLROOT; ?>/adminOrders" class="nav-link <?php echo (strpos($url, 'adminOrders') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-shopping-cart"></i> Orders
        </a>

        <a href="<?php echo URLROOT; ?>/payouts" class="nav-link <?php echo (strpos($url, 'payouts') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-hand-holding-usd"></i> Staff Payouts
        </a>

        <a href="<?php echo URLROOT; ?>/users" class="nav-link <?php echo (strpos($url, 'users') !== false && strpos($url, 'logout') === false) ? 'active' : ''; ?>">
            <i class="fas fa-users"></i> Users
        </a>

        <a href="<?php echo URLROOT; ?>/users/logout" class="nav-link mt-5 text-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </nav>
</div>