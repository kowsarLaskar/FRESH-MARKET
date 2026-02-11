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
                            <tr><td colspan="6" class="text-center py-4">No orders received yet.</td></tr>
                        <?php else: ?>
                            <?php foreach($data['orders'] as $order): ?>
                            <tr>
                                <td class="fw-bold">#<?php echo $order->order_id; ?></td>
                                <td>
                                    <div><?php echo $order->full_name; ?></div>
                                    <small class="text-muted"><?php echo $order->phone; ?></small>
                                </td>
                                <td>₹<?php echo $order->total_amount; ?></td>
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
                                    <span class="badge <?php echo $badgeClass; ?>">
                                        <?php echo ucfirst(str_replace('_', ' ', $order->order_status)); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($order->order_date)); ?></td>
                                <td>
                                    <a href="<?php echo URLROOT; ?>/adminOrders/show/<?php echo $order->order_id; ?>" class="btn btn-sm btn-outline-dark">
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