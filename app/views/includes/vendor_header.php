<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo SITENAME; ?> - Vendor Dashboard</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

  <style>
    :root {
      --fm-bg: #f6f8f9;
      --fm-surface: #ffffff;
      --fm-muted: #6b7280;
      --fm-accent: #10b981;
      /* Fresh Market green */
      --fm-warm: #f59e0b;
      /* warning/orange */
      --fm-info: #0ea5e9;
      /* info/blue */
      --fm-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
      --sidebar-width: 260px;
      --radius-lg: 1rem;
    }

    html,
    body {
      height: 100%;
      background: var(--fm-bg);
      color: #0f172a;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    /* Top header / navbar */
    .fm-topbar {
      margin-left: var(--sidebar-width);
      padding: 18px 28px;
      background: transparent;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
    }

    .fm-brand {
      display: flex;
      align-items: center;
      gap: .9rem;
    }

    .fm-brand .logo {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.12), rgba(16, 185, 129, 0.06));
      display: inline-flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 6px 18px rgba(16, 185, 129, 0.06);
      color: var(--fm-accent);
      font-size: 1.25rem;
    }

    .fm-brand .title {
      font-weight: 800;
      font-size: 1.05rem;
      letter-spacing: -0.01em;
    }

    .fm-top-actions {
      display: flex;
      align-items: center;
      gap: .75rem;
    }

    .fm-search {
      min-width: 320px;
      max-width: 520px;
      background: var(--fm-surface);
      border-radius: .75rem;
      padding: .35rem .6rem;
      box-shadow: var(--fm-shadow);
      display: flex;
      align-items: center;
      gap: .6rem;
    }

    .fm-search input {
      border: 0;
      outline: 0;
      background: transparent;
      width: 100%;
      padding: .45rem .25rem;
    }

    .fm-icon-btn {
      background: var(--fm-surface);
      border-radius: .7rem;
      padding: .55rem .7rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
      border: 1px solid rgba(15, 23, 42, 0.03);
      color: #0f172a;
    }

    .fm-profile {
      display: flex;
      align-items: center;
      gap: .6rem;
      background: var(--fm-surface);
      padding: .35rem .6rem;
      border-radius: .75rem;
      box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
      border: 1px solid rgba(15, 23, 42, 0.03);
    }

    .fm-profile .avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: linear-gradient(180deg, rgba(99, 102, 241, 0.06), rgba(99, 102, 241, 0.02));
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: #374151;
    }

    .store-status {
      display: inline-flex;
      align-items: center;
      gap: .5rem;
      padding: .45rem .6rem;
      border-radius: .6rem;
      font-weight: 700;
      color: #065f46;
      background: linear-gradient(90deg, rgba(16, 185, 129, 0.08), rgba(16, 185, 129, 0.03));
      box-shadow: 0 8px 20px rgba(16, 185, 129, 0.06);
      border: 1px solid rgba(16, 185, 129, 0.06);
    }

    /* Sidebar */
    .vendor-sidebar {
      height: 100vh;
      width: var(--sidebar-width);
      position: fixed;
      top: 0;
      left: 0;
      background: linear-gradient(180deg, #ffffff 0%, #f8fafb 100%);
      padding: 22px;
      box-shadow: 2px 8px 30px rgba(15, 23, 42, 0.06);
      border-right: 1px solid rgba(15, 23, 42, 0.04);
      display: flex;
      flex-direction: column;
      gap: .75rem;
      z-index: 1020;
    }

    .vendor-sidebar .brand {
      display: flex;
      align-items: center;
      gap: .75rem;
      padding-bottom: .5rem;
      margin-bottom: .5rem;
      border-bottom: 1px solid rgba(15, 23, 42, 0.03);
    }

    .vendor-sidebar .brand .name {
      font-weight: 800;
      color: #0f172a;
      font-size: 1.05rem;
    }

    .vendor-nav {
      margin-top: .5rem;
      display: flex;
      flex-direction: column;
      gap: .25rem;
      overflow: auto;
      padding-right: 6px;
    }

    .vendor-nav a {
      padding: 12px 14px;
      text-decoration: none;
      color: #475569;
      border-radius: .6rem;
      display: flex;
      align-items: center;
      gap: .75rem;
      font-weight: 600;
      transition: all .14s ease;
    }

    .vendor-nav a i {
      width: 22px;
      text-align: center;
      color: #94a3b8;
      font-size: 1.05rem;
    }

    /* Active / hover styles with matching background color */
    .vendor-nav a:hover {
      background: linear-gradient(90deg, rgba(16, 185, 129, 0.04), rgba(16, 185, 129, 0.02));
      color: #064e3b;
      transform: translateX(4px);
      box-shadow: 0 8px 20px rgba(16, 185, 129, 0.02);
    }

    .vendor-nav a.active {
      background: linear-gradient(90deg, rgba(16, 185, 129, 0.12), rgba(16, 185, 129, 0.06));
      color: #064e3b;
      transform: none;
      box-shadow: 0 12px 30px rgba(16, 185, 129, 0.06);
      border-left: 4px solid rgba(16, 185, 129, 0.18);
      padding-left: 10px;
    }

    .vendor-logout {
      margin-top: auto;
      padding-top: 12px;
      border-top: 1px solid rgba(15, 23, 42, 0.03);
    }

    .vendor-logout a {
      display: flex;
      align-items: center;
      gap: .6rem;
      color: #ef4444;
      font-weight: 700;
      padding: 10px 12px;
      border-radius: .6rem;
    }

    /* Small screens */
    @media (max-width: 991.98px) {
      .vendor-sidebar {
        transform: translateX(-100%);
        position: fixed;
        z-index: 1100;
        transition: transform .25s ease;
      }

      .vendor-sidebar.open {
        transform: translateX(0);
      }

      .fm-topbar {
        margin-left: 0;
        padding: 12px;
      }

      .fm-search {
        min-width: 160px;
      }
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <aside class="vendor-sidebar" aria-label="Vendor navigation">
    <div class="brand">
      <div class="logo"><i class="fas fa-leaf"></i></div>
      <div>
        <div class="name"><?php echo SITENAME; ?></div>
        <div class="text-muted small">Vendor Portal</div>
      </div>
    </div>

    <nav class="vendor-nav" aria-label="Main">
      <a href="<?php echo URLROOT; ?>/vendors/index" class="nav-link"><i class="fas fa-tachometer-alt"></i>
        Dashboard</a>
      <a href="<?php echo URLROOT; ?>/vendors/activeOrders" class="nav-link"><i class="fas fa-box-open"></i> Active
        Orders</a>
      <a href="<?php echo URLROOT; ?>/vendors/history" class="nav-link"><i class="fas fa-history"></i> Order History</a>
      <a href="<?php echo URLROOT; ?>/vendors/products" class="nav-link"><i class="fas fa-tags"></i> My Inventory</a>
      <a href="<?php echo URLROOT; ?>/vendors/addProduct" class="nav-link"><i class="fas fa-plus-circle"></i> Add
        Product</a>
    </nav>

    <div class="vendor-logout">
      <a href="<?php echo URLROOT; ?>/users/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </aside>

  <!-- Topbar -->
  <header class="fm-topbar">
    <div class="fm-brand">
      <div class="logo"><i class="fas fa-store"></i></div>
      <div>
        <div class="title"><?php echo SITENAME; ?></div>
        <div class="text-muted small">Vendor Dashboard</div>
      </div>
    </div>

    <div class="fm-top-actions">
      <div class="fm-search">
        <i class="fas fa-search text-muted"></i>
        <input type="search" placeholder="Search orders, products, customers..." aria-label="Search" />
      </div>

      <div class="d-flex align-items-center gap-2">
        <div class="fm-icon-btn" title="Notifications" role="button" aria-label="Notifications">
          <i class="fas fa-bell"></i>
        </div>

        <div class="fm-icon-btn" title="Messages" role="button" aria-label="Messages">
          <i class="fas fa-envelope"></i>
        </div>

        <div class="store-status" title="Store Status">
          <i class="fas fa-circle" style="font-size:.6rem;color:#bbf7d0;"></i>
          <span class="small">Store Status: <strong class="ms-1">Active</strong></span>
        </div>

        <div class="fm-profile">
          <div class="avatar"><?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?></div>
          <div class="d-none d-md-block">
            <div style="font-weight:700;"><?php echo $_SESSION['user_name']; ?></div>
            <div class="text-muted small">Vendor</div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main content wrapper -->
  <main class="vendor-main-content" style="margin-left: var(--sidebar-width); padding: 28px;">

    <!-- Highlighting script: preserves PHP logic, adds click highlight and remembers last clicked item -->
    <script>
      (function() {
        const navLinks = document.querySelectorAll('.vendor-nav a.nav-link');

        // Utility: normalize path (strip trailing slash)
        const normalize = (u) => {
          try {
            const url = new URL(u, window.location.origin);
            return url.pathname.replace(/\/+$/, '');
          } catch (e) {
            return String(u).replace(/\/+$/, '');
          }
        };

        // Apply active class based on stored href or current location
        const stored = localStorage.getItem('vendorActive');
        let applied = false;

        if (stored) {
          const sel = Array.from(navLinks).find(a => normalize(a.getAttribute('href')) === normalize(stored));
          if (sel) {
            sel.classList.add('active');
            applied = true;
          }
        }

        if (!applied) {
          // Try to match current location to one of the links
          const current = normalize(window.location.pathname);
          const match = Array.from(navLinks).find(a => {
            const href = normalize(a.getAttribute('href'));
            // match exact or if href is a prefix of current (useful for nested routes)
            return href === current || (href !== '' && current.indexOf(href) === 0);
          });
          if (match) {
            match.classList.add('active');
            applied = true;
          }
        }

        // If still none matched, default to first link (keeps previous behavior minimal)
        if (!applied && navLinks.length) {
          navLinks[0].classList.add('active');
        }

        // Click handler: set active and persist to localStorage
        navLinks.forEach(link => {
          link.addEventListener('click', function(e) {
            // Remove active from all
            navLinks.forEach(l => l.classList.remove('active'));
            // Add to clicked
            this.classList.add('active');

            // Persist the href so next page load highlights same item
            try {
              localStorage.setItem('vendorActive', this.getAttribute('href'));
            } catch (err) {
              // ignore storage errors
            }
          });
        });

        // Optional: clear stored active if user navigates away to external domain
        window.addEventListener('beforeunload', function() {
          // keep stored value — do nothing
        });
      })();
    </script>

    <!-- Bootstrap JS (optional for components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>