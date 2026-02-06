<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Fresh Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FBF9F1; }
        
        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1F4D3C;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding-top: 20px;
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
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 15px 25px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            text-decoration: none;
        }
        .nav-link i { width: 25px; }

        /* Main Content Styling */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            border: none;
            height: 100%;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        .bg-icon-green { background-color: #e8f5e9; color: #2e7d32; }
        .bg-icon-blue { background-color: #e3f2fd; color: #1565c0; }
        .bg-icon-orange { background-color: #fff3e0; color: #ef6c00; }
        .bg-icon-red { background-color: #ffebee; color: #c62828; }

        .stat-value { font-size: 1.8rem; font-weight: 700; color: #333; }
        .stat-label { color: #666; font-size: 0.9rem; }

        /* Tables */
        .admin-table-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            margin-top: 30px;
        }
        .table-title { font-weight: 700; color: #333; margin-bottom: 20px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="<?php echo URLROOT; ?>/admin" class="sidebar-brand">
            <i class="fas fa-leaf me-2"></i>FRESH ADMIN
        </a>
        <nav class="nav flex-column">
            <a href="<?php echo URLROOT; ?>/admin" class="nav-link">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="<?php echo URLROOT; ?>/products" class="nav-link active">
                <i class="fas fa-box"></i> Products
            </a>
            <a href="<?php echo URLROOT; ?>/categories" class="nav-link">
                <i class="fas fa-list"></i> Categories
            </a>
            <a href="<?php echo URLROOT; ?>/adminOrders" class="nav-link">
                <i class="fas fa-shopping-cart"></i> Orders
            </a>
            <a href="<?php echo URLROOT; ?>/delivery" class="nav-link">
                <i class="fas fa-truck"></i> Delivery Mgmt
            </a>
            <a href="<?php echo URLROOT; ?>/users" class="nav-link">
                <i class="fas fa-users"></i> Users
            </a>
            <a href="<?php echo URLROOT; ?>/users/logout" class="nav-link mt-5">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </div>

    <div class="main-content">
        
        <h2 class="fw-bold mb-4" style="color:#1F4D3C;">Overview</h2>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-icon-green"><i class="fas fa-dollar-sign"></i></div>
                    <div class="stat-value">$<?php echo number_format($data['revenue'], 2); ?></div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-icon-blue"><i class="fas fa-shopping-bag"></i></div>
                    <div class="stat-value"><?php echo $data['total_orders']; ?></div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-icon-orange"><i class="fas fa-user-friends"></i></div>
                    <div class="stat-value"><?php echo $data['total_users']; ?></div>
                    <div class="stat-label">Active Customers</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-icon-red"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="stat-value"><?php echo count($data['low_stock']); ?></div>
                    <div class="stat-label">Low Stock Items</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="admin-table-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="table-title mb-0">Recent Orders</h5>
                        <a href="<?php echo URLROOT; ?>/admin/orders" class="btn btn-sm btn-outline-dark">View All</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($data['recent_orders'])): ?>
                                    <tr><td colspan="5" class="text-center py-3">No orders found</td></tr>
                                <?php else: ?>
                                    <?php foreach($data['recent_orders'] as $order): ?>
                                    <tr>
                                        <td>#<?php echo $order->order_id; ?></td>
                                        <td><?php echo $order->full_name; ?></td>
                                        <td>$<?php echo number_format($order->total_amount, 2); ?></td>
                                        <td>
                                            <?php 
                                                // Dynamic Status Badges
                                                $statusClass = 'bg-secondary';
                                                $statusText = $order->order_status;
                                                
                                                if($statusText == 'delivered') $statusClass = 'bg-success';
                                                if($statusText == 'pending') $statusClass = 'bg-warning text-dark';
                                                if($statusText == 'cancelled') $statusClass = 'bg-danger';
                                                if($statusText == 'out_for_delivery') $statusClass = 'bg-info text-dark';
                                            ?>
                                            <span class="badge <?php echo $statusClass; ?>">
                                                <?php echo ucfirst(str_replace('_', ' ', $statusText)); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-light border"><i class="fas fa-eye"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="admin-table-card">
                    <h5 class="table-title">Inventory Alerts</h5>
                    <?php if(empty($data['low_stock'])): ?>
                        <p class="text-muted text-center py-3"><i class="fas fa-check-circle text-success me-2"></i> Stock is healthy!</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($data['low_stock'] as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <div class="fw-bold text-dark"><?php echo $item->name; ?></div>
                                    <small class="text-danger">Only <?php echo $item->stock_qty; ?> left</small>
                                </div>
                                <a href="<?php echo URLROOT; ?>/products/edit/<?php echo $item->product_id; ?>" class="btn btn-sm btn-outline-danger">Restock</a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

</body>
</html>