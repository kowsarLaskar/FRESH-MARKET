<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders - Fresh Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FBF9F1; }
        .sidebar {
            width: 250px; height: 100vh; background-color: #1F4D3C;
            position: fixed; left: 0; top: 0; color: white; padding-top: 20px;
        }
        .sidebar-brand { font-size: 1.5rem; font-weight: 700; text-align: center; display: block; color: white; text-decoration: none; margin-bottom: 30px; }
        .nav-link { color: rgba(255,255,255,0.8); padding: 15px 25px; display: flex; align-items: center; text-decoration: none; }
        .nav-link:hover, .nav-link.active { color: white; background-color: rgba(255,255,255,0.1); }
        .nav-link i { width: 25px; }
        .main-content { margin-left: 250px; padding: 30px; }
    </style>
</head>
<body>

    <?php require APPROOT . '/views/includes/admin_sidebar.php'; ?>

    <div class="main-content">
        <h2 class="fw-bold mb-4" style="color:#1F4D3C;">Order Management</h2>

        <div class="card border-0 shadow-sm p-3 mb-4">
            <form action="<?php echo URLROOT; ?>/adminOrders" method="GET">
                <div class="row g-3 align-items-end">
                    
                    <div class="col-md-3">
                        <label class="form-label small text-muted fw-bold mb-1">Order ID</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-hashtag"></i></span>
                            <input type="number" name="order_id" class="form-control" placeholder="e.g. 104" 
                                   value="<?php echo $data['filters']['order_id'] ?? ''; ?>">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small text-muted fw-bold mb-1">Order Status</label>
                        <select name="status" class="form-select">
                            <?php $current_status = $data['filters']['status'] ?? 'all'; ?>
                            <option value="all" <?php echo ($current_status == 'all') ? 'selected' : ''; ?>>All Statuses</option>
                            <option value="pending" <?php echo ($current_status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="processing" <?php echo ($current_status == 'processing') ? 'selected' : ''; ?>>Processing</option>
                            <option value="out_for_delivery" <?php echo ($current_status == 'out_for_delivery') ? 'selected' : ''; ?>>Out for Delivery</option>
                            <option value="delivered" <?php echo ($current_status == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
                            <option value="cancelled" <?php echo ($current_status == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small text-muted fw-bold mb-1">Order Date</label>
                        <input type="date" name="date" class="form-control" 
                               value="<?php echo $data['filters']['date'] ?? ''; ?>">
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-fill fw-bold shadow-sm" style="background-color: #1F4D3C; border-color: #1F4D3C;">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <a href="<?php echo URLROOT; ?>/adminOrders" class="btn btn-light flex-fill border fw-bold text-muted shadow-sm">
                            Clear
                        </a>
                    </div>

                </div>
            </form>
        </div>

        <div class="card border-0 shadow-sm p-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['orders'])): ?>
                            <tr><td colspan="6" class="text-center py-5 text-muted"><i class="fas fa-search fa-2x mb-3 opacity-50"></i><br>No orders match your criteria.</td></tr>
                        <?php else: ?>
                            <?php foreach($data['orders'] as $order): ?>
                            <tr>
                                <td class="fw-bold">#<?php echo $order->order_id; ?></td>
                                <td>
                                    <div><?php echo $order->full_name; ?></div>
                                    <small class="text-muted"><?php echo $order->phone; ?></small>
                                </td>
                                <td class="fw-bold">₹<?php echo number_format($order->total_amount, 2); ?></td>
                                <td>
                                    <?php 
                                        $badges = [
                                            'pending' => 'bg-warning text-dark',
                                            'processing' => 'bg-info text-dark',
                                            'out_for_delivery' => 'bg-primary',
                                            'delivered' => 'bg-success',
                                            'cancelled' => 'bg-danger'
                                        ];
                                        $badgeClass = $badges[$order->order_status] ?? 'bg-secondary';
                                    ?>
                                    <span class="badge <?php echo $badgeClass; ?> px-2 py-1">
                                        <?php echo ucfirst(str_replace('_', ' ', $order->order_status)); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($order->order_date)); ?></td>
                                <td>
                                    <a href="<?php echo URLROOT; ?>/adminOrders/show/<?php echo $order->order_id; ?>" class="btn btn-sm btn-outline-dark fw-bold">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</body>
</html>