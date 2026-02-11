<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Payouts - Fresh Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #FBF9F1; }
        /* Note: .content-wrapper style is now handled by sidebar.php */
        .stat-card { background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<?php require APPROOT . '/views/includes/admin_sidebar.php'; ?>

<div class="content-wrapper">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Staff Payouts & History</h3>
    </div>

    <div class="card border-0 shadow-sm p-3 mb-4">
        <form action="<?php echo URLROOT; ?>/payouts" method="get" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label small text-muted">Select Staff</label>
                <select name="driver_id" class="form-select">
                    <option value="">All Staff</option>
                    <?php foreach($data['drivers'] as $d): ?>
                        <option value="<?php echo $d->user_id; ?>" <?php echo ($data['filters']['driver_id'] == $d->user_id) ? 'selected' : ''; ?>>
                            <?php echo $d->full_name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted">From Date</label>
                <input type="date" name="date_from" class="form-control" value="<?php echo $data['filters']['from']; ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted">To Date</label>
                <input type="date" name="date_to" class="form-control" value="<?php echo $data['filters']['to']; ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-2"></i>Apply Filters</button>
            </div>
        </form>
    </div>

    <?php if(!empty($data['filters']['driver_id'])): ?>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="stat-card border-start border-4 border-success">
                    <h6 class="text-muted text-uppercase small">Total Earnings (Selected Period)</h6>
                    <h2 class="fw-bold text-success mb-0">₹<?php echo number_format($data['stats']['total_comm'], 2); ?></h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card border-start border-4 border-warning d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small">Pending Payout</h6>
                        <h2 class="fw-bold text-warning mb-0">₹<?php echo number_format($data['stats']['pending'], 2); ?></h2>
                    </div>
                    
                    <?php if($data['stats']['pending'] > 0): ?>
                        <form action="<?php echo URLROOT; ?>/payouts/mark_paid" method="post" onsubmit="return confirm('Confirm payment of ₹<?php echo $data['stats']['pending']; ?>?');">
                            <input type="hidden" name="driver_id" value="<?php echo $data['filters']['driver_id']; ?>">
                            <input type="hidden" name="date_from" value="<?php echo $data['filters']['from']; ?>">
                            <input type="hidden" name="date_to" value="<?php echo $data['filters']['to']; ?>">
                            <button type="submit" class="btn btn-success fw-bold px-4">
                                <i class="fas fa-check-circle me-2"></i>Mark as Paid
                            </button>
                        </form>
                    <?php else: ?>
                        <button class="btn btn-light text-muted" disabled><i class="fas fa-check"></i> Settled</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Order ID</th>
                        <th>Staff Name</th>
                        <th>Order Value</th>
                        <th>Commission</th>
                        <th class="text-end pe-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['deliveries'])): ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">No records found.</td></tr>
                    <?php else: ?>
                        <?php foreach($data['deliveries'] as $item): ?>
                            <tr>
                                <td class="ps-4"><?php echo date('M d, Y', strtotime($item->order_date)); ?></td>
                                <td><a href="<?php echo URLROOT; ?>/adminOrders/show/<?php echo $item->order_id; ?>" class="text-decoration-none">#<?php echo $item->order_id; ?></a></td>
                                <td><?php echo $item->driver_name; ?></td>
                                <td>₹<?php echo number_format($item->total_amount, 2); ?></td>
                                <td class="fw-bold text-primary">+₹<?php echo number_format($item->driver_fee, 2); ?></td>
                                <td class="text-end pe-4">
                                    <?php if($item->driver_paid_status == 'paid'): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">Paid</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">Pending</span>
                                    <?php endif; ?>
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