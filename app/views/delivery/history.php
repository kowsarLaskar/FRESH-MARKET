<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delivery History & Earnings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }</style>
</head>
<body>

<div class="d-flex">
    <?php if(file_exists(APPROOT . '/views/includes/delivery_sidebar.php')) require APPROOT . '/views/includes/delivery_sidebar.php'; ?>

    <div class="flex-grow-1 p-4" style="height: 100vh; overflow-y: auto;">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="fw-bold text-dark mb-0"><i class="fas fa-wallet text-success me-2"></i>History & Earnings</h2>
            <a href="<?php echo URLROOT; ?>/delivery" class="btn btn-outline-secondary shadow-sm bg-white fw-bold"><i class="fas fa-arrow-left me-2"></i>Back to Route</a>
        </div>

        <div class="row mb-4 g-3">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm border-start border-4 border-success h-100">
                    <div class="card-body">
                        <p class="text-muted text-uppercase small mb-1 fw-bold">Total Earnings (All Time)</p>
                        <h2 class="text-success fw-bold mb-0">₹<?php echo number_format($data['total_earned'], 2); ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm border-start border-4 border-warning h-100">
                    <div class="card-body">
                        <p class="text-muted text-uppercase small mb-1 fw-bold">Pending Dues (Unpaid by Admin)</p>
                        <h2 class="text-warning fw-bold mb-0">₹<?php echo number_format($data['total_dues'], 2); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Collected</th>
                            <th>Earned</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['deliveries'])): ?>
                            <tr><td colspan="7" class="text-center py-5 text-muted">You haven't completed any deliveries yet.</td></tr>
                        <?php else: ?>
                            <?php foreach($data['deliveries'] as $item): ?>
                                <tr>
                                    <td class="ps-4 text-muted small"><?php echo date('M d, Y', strtotime($item->order_date)); ?></td>
                                    <td class="fw-bold">#<?php echo $item->order_id; ?></td>
                                    <td><?php echo $item->full_name; ?></td>
                                    <td>
                                        <?php if($item->payment_mode == 'cod'): ?>
                                            <span class="text-danger fw-bold">₹<?php echo number_format($item->total_amount, 2); ?></span>
                                        <?php else: ?>
                                            <span class="text-success small"><i class="fas fa-check"></i> Paid Online</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-primary fw-bold">+₹<?php echo number_format($item->driver_fee, 2); ?></td>
                                    <td>
                                        <?php if($item->driver_paid_status == 'paid'): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success">Paid to You</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="<?php echo URLROOT; ?>/delivery/details/<?php echo $item->order_id; ?>" class="btn btn-sm btn-outline-secondary">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</body>
</html>