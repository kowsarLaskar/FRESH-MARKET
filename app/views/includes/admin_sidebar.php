<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* ═══════════════════════════════════════
       SIDEBAR CORE
    ═══════════════════════════════════════ */
    .sidebar {
        width: 260px;
        height: 100vh;
        background: #0d1117;
        position: fixed;
        left: 0;
        top: 0;
        color: white;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        overflow-y: auto;
        border-right: 1px solid rgba(255, 255, 255, 0.05);
        scrollbar-width: none;
    }

    .sidebar::-webkit-scrollbar {
        display: none;
    }

    /* ═══════════════════════════════════════
       BRAND LOGO AREA
    ═══════════════════════════════════════ */
    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 28px 24px 24px;
        text-decoration: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        margin-bottom: 8px;
        flex-shrink: 0;
    }

    .sidebar-brand .brand-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #4ade80, #16a34a);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 4px 14px rgba(74, 222, 128, 0.35);
    }

    .sidebar-brand .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1;
    }

    .sidebar-brand .brand-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.92rem;
        font-weight: 800;
        color: #f0f6fc;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .sidebar-brand .brand-sub {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.68rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.35);
        letter-spacing: 0.02em;
        margin-top: 3px;
    }

    /* ═══════════════════════════════════════
       SECTION LABELS
    ═══════════════════════════════════════ */
    .nav-section-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.62rem;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.25);
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 16px 24px 6px;
    }

    /* ═══════════════════════════════════════
       NAV LINKS
    ═══════════════════════════════════════ */
    .sidebar .nav-link {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: rgba(255, 255, 255, 0.5);
        padding: 10px 16px;
        margin: 1px 12px;
        font-size: 0.855rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.18s ease;
        position: relative;
    }

    .sidebar .nav-link i {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        font-size: 0.8rem;
        margin-right: 10px;
        background: transparent;
        transition: all 0.18s ease;
        flex-shrink: 0;
    }

    .sidebar .nav-link:hover {
        color: rgba(255, 255, 255, 0.9);
        background: rgba(255, 255, 255, 0.06);
    }

    .sidebar .nav-link:hover i {
        background: rgba(255, 255, 255, 0.08);
    }

    .sidebar .nav-link.active {
        color: #ffffff;
        background: rgba(74, 222, 128, 0.12);
    }

    .sidebar .nav-link.active i {
        background: rgba(74, 222, 128, 0.2);
        color: #4ade80;
    }

    .sidebar .nav-link.active::before {
        content: '';
        position: absolute;
        left: -12px;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 22px;
        background: #4ade80;
        border-radius: 0 3px 3px 0;
    }

    /* ═══════════════════════════════════════
       BADGE
    ═══════════════════════════════════════ */
    @keyframes pulse-badge {

        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.5);
        }

        50% {
            box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
        }
    }

    .sidebar .badge.bg-danger {
        background: #ef4444 !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 3px 7px;
        border-radius: 20px;
        animation: pulse-badge 2s infinite;
        margin-left: auto;
    }

    /* ═══════════════════════════════════════
       LOGOUT LINK
    ═══════════════════════════════════════ */
    .sidebar .nav-link.logout-link {
        color: rgba(239, 68, 68, 0.65);
        margin-top: auto;
    }

    .sidebar .nav-link.logout-link:hover {
        color: #ef4444;
        background: rgba(239, 68, 68, 0.08);
    }

    .sidebar .nav-link.logout-link i {
        color: inherit;
    }

    /* ═══════════════════════════════════════
       BOTTOM USER TAG
    ═══════════════════════════════════════ */
    .sidebar-footer {
        padding: 16px 20px;
        margin: 12px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .sidebar-footer .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4ade80, #16a34a);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.72rem;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }

    .sidebar-footer .user-info .user-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.78rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1;
    }

    .sidebar-footer .user-info .user-role {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.67rem;
        color: rgba(255, 255, 255, 0.3);
        margin-top: 3px;
    }

    /* ═══════════════════════════════════════
       LAYOUT HELPERS
    ═══════════════════════════════════════ */
    .content-wrapper,
    .main-content {
        margin-left: 260px;
        padding: 32px;
        transition: margin-left 0.3s;
        min-height: 100vh;
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-260px);
            transition: transform 0.3s;
        }

        .content-wrapper,
        .main-content {
            margin-left: 0;
        }
    }
</style>

<div class="sidebar">

    <!-- Brand -->
    <a href="<?php echo URLROOT; ?>/admin" class="sidebar-brand">
        <div class="brand-icon"><i class="fas fa-leaf"></i></div>
        <div class="brand-text">
            <span class="brand-name">Fresh Admin</span>
            <span class="brand-sub">Control Panel</span>
        </div>
    </a>

    <?php $url = $_SERVER['REQUEST_URI']; ?>

    <!-- Main Navigation -->
    <nav class="nav flex-column flex-grow-1 pb-2">

        <span class="nav-section-label">Main</span>

        <a href="<?php echo URLROOT; ?>/admin"
            class="nav-link <?php echo (strpos($url, '/admin') !== false && strpos($url, 'Orders') === false && strpos($url, 'payouts') === false) ? 'active' : ''; ?>">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <a href="<?php echo URLROOT; ?>/products"
            class="nav-link <?php echo (strpos($url, 'products') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-box"></i> Products
        </a>

        <a href="<?php echo URLROOT; ?>/categories"
            class="nav-link <?php echo (strpos($url, 'categories') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-list"></i> Categories
        </a>

        <span class="nav-section-label">Operations</span>

        <a href="<?php echo URLROOT; ?>/adminOrders"
            class="nav-link <?php echo (strpos($url, 'adminOrders') !== false) ? 'active' : ''; ?> d-flex justify-content-between align-items-center">
            <span class="d-flex align-items-center">
                <i class="fas fa-shopping-cart"></i> Orders
            </span>
            <?php $newOrders = getNewOrderCount(); ?>
            <?php if ($newOrders > 0): ?>
                <span class="badge bg-danger rounded-pill shadow-sm"><?php echo $newOrders; ?></span>
            <?php endif; ?>
        </a>

        <a href="<?php echo URLROOT; ?>/payouts"
            class="nav-link <?php echo (strpos($url, 'payouts') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-hand-holding-usd"></i> Staff Payouts
        </a>

        <a href="<?php echo URLROOT; ?>/users"
            class="nav-link <?php echo (strpos($url, 'users') !== false && strpos($url, 'logout') === false) ? 'active' : ''; ?>">
            <i class="fas fa-users"></i> Users
        </a>

        <!-- Spacer -->
        <div class="flex-grow-1"></div>

        <a href="<?php echo URLROOT; ?>/users/logout" class="nav-link logout-link">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>

    </nav>

    <!-- Footer User Badge -->
    <div class="sidebar-footer">
        <div class="avatar">A</div>
        <div class="user-info">
            <div class="user-name">Administrator</div>
            <div class="user-role">Super Admin</div>
        </div>
    </div>

</div>