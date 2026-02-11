<style>
    /* --- DELIVERY SIDEBAR STYLES --- */
    .delivery-sidebar {
        width: 250px;
        height: 100vh;
        background-color: #1F4D3C; /* Dark Green Theme */
        position: sticky;
        top: 0;
        color: white;
        padding-top: 25px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 10px rgba(0,0,0,0.1);
    }

    .delivery-sidebar .sidebar-brand {
        font-size: 1.4rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 25px;
        display: block;
        color: white;
        text-decoration: none;
        letter-spacing: 1px;
    }

    .delivery-sidebar .nav-link {
        color: rgba(255,255,255,0.7);
        padding: 16px 25px;
        font-size: 1rem;
        display: flex;
        align-items: center;
        text-decoration: none;
        border-radius: 0;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .delivery-sidebar .nav-link:hover, 
    .delivery-sidebar .nav-link.active {
        color: white;
        background-color: rgba(255,255,255,0.1);
        border-left: 4px solid #ffc107; /* Warning/Yellow accent for delivery */
    }

    .delivery-sidebar .nav-link i { 
        width: 30px; 
        text-align: center;
        margin-right: 12px;
        font-size: 1.1rem;
    }
    
    .delivery-sidebar .user-profile {
        margin-top: auto;
        padding: 20px;
        background-color: rgba(0,0,0,0.15);
        border-top: 1px solid rgba(255,255,255,0.1);
    }
</style>

<?php 
    // Auto-detect Active Page
    $url = $_SERVER['REQUEST_URI']; 
?>

<div class="delivery-sidebar">
    
    <a href="<?php echo URLROOT; ?>/delivery" class="sidebar-brand">
        <i class="fas fa-motorcycle fa-lg me-2 text-warning"></i>
        <span>FRESH <span class="text-warning">RIDER</span></span>
    </a>
    
    <hr class="text-white-50 mx-4 mb-4">
    
    <ul class="nav flex-column mb-auto">
        <li class="nav-item"> 
            <a href="<?php echo URLROOT; ?>/delivery" class="nav-link <?php echo (strpos($url, '/delivery') !== false && strpos($url, 'history') === false && strpos($url, 'details') === false) ? 'active' : ''; ?>">
                <i class="fas fa-route"></i> Dashboard
            </a>
        </li>
        
        <li class="nav-item mt-1"> 
            <a href="<?php echo URLROOT; ?>/delivery/history" class="nav-link <?php echo (strpos($url, 'history') !== false) ? 'active' : ''; ?>">
                <i class="fas fa-wallet"></i> Earnings & History
            </a>
        </li>
    </ul>
    
    <div class="user-profile mt-auto">
        <div class="d-flex align-items-center mb-3">
            <div class="rounded-circle bg-warning text-dark d-flex justify-content-center align-items-center me-3 fw-bold shadow-sm" style="width: 42px; height: 42px; font-size: 1.2rem;">
                <?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?>
            </div>
            <div>
                <strong class="d-block text-white" style="line-height: 1.2;"><?php echo $_SESSION['user_name']; ?></strong>
                <small class="text-warning fw-bold" style="font-size: 0.75rem;">DELIVERY PARTNER</small>
            </div>
        </div>
        
        <a href="<?php echo URLROOT; ?>/users/logout" class="btn btn-danger w-100 fw-bold border-0 shadow-sm" style="background-color: #dc3545;">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>
</div>