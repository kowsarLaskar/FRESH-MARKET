<?php require APPROOT . '/views/includes/vendor_header.php'; ?>

<style>
    /* Fresh Market theme tweaks */
    body {
        background-color: #f6f8f9;
        color: #1f2937;
    }

    .fm-card {
        background: #ffffff;
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 6px 18px rgba(31, 41, 55, 0.06);
    }

    .fm-stat {
        padding: 1.25rem 1.5rem;
    }

    .fm-icon {
        width: 64px;
        height: 64px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.35rem;
        box-shadow: 0 6px 18px rgba(31, 41, 55, 0.04);
    }

    .fm-icon-soft {
        background-color: rgba(0, 0, 0, 0.03);
    }

    .fm-title {
        font-size: 0.78rem;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #6b7280;
        margin-bottom: 0.25rem;
        font-weight: 600;
    }

    .fm-number {
        font-size: 1.9rem;
        font-weight: 800;
        line-height: 1;
        color: #111827;
    }

    .fm-card-footer {
        background: transparent;
        border-top: 1px solid rgba(15, 23, 42, 0.04);
        padding: 0.75rem 1.25rem;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
    }

    .fm-link {
        font-weight: 700;
        font-size: 0.9rem;
        color: #374151;
        text-decoration: none;
    }

    .fm-link:hover {
        color: #0f172a;
        text-decoration: none;
        transform: translateX(4px);
        transition: transform .18s ease;
    }

    .store-badge {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .45rem .7rem;
        border-radius: .6rem;
        font-weight: 700;
        box-shadow: 0 6px 18px rgba(34, 197, 94, 0.12);
    }

    /* Table styles */
    .fm-table thead th {
        border-bottom: 0;
        color: #6b7280;
        font-weight: 700;
        font-size: .85rem;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .fm-table tbody tr {
        border-bottom: 1px solid rgba(15, 23, 42, 0.04);
    }

    .fm-table td,
    .fm-table th {
        vertical-align: middle;
        padding: 1.05rem 1rem;
    }

    .status-pill {
        padding: .45rem .7rem;
        border-radius: 999px;
        font-weight: 700;
        font-size: .78rem;
    }

    .btn-process {
        transition: transform .12s ease, box-shadow .12s ease;
    }

    .btn-process:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
    }

    /* Responsive tweaks */
    @media (max-width: 767.98px) {
        .fm-icon {
            width: 56px;
            height: 56px;
            font-size: 1.1rem;
        }

        .fm-number {
            font-size: 1.6rem;
        }
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1 fw-bold">Welcome back, <?php echo $_SESSION['user_name']; ?>!</h2>
        <p class="text-muted mb-0">Here's a snapshot of your store performance this month.</p>
    </div>

    <span class="store-badge bg-success text-white">
        <i class="fas fa-circle me-1" style="font-size:.6rem;color:#bbf7d0;"></i>
        <i class="fas fa-store"></i>
        <span class="ms-2">Store Status: Active</span>
    </span>
</div>

<div class="row mb-4 g-4">

    <div class="col-md-4">
        <div class="fm-card fm-stat h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="fm-title">Pending Orders</div>
                    <div class="fm-number"><?php echo $data['stats']['pending_count']; ?></div>
                </div>

                <div class="text-end">
                    <div class="fm-icon fm-icon-soft text-warning"
                        style="background-color: rgba(250, 204, 21, 0.12); color: #b45309;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="mt-2 text-muted small">Needs attention</div>
                </div>
            </div>

            <div class="fm-card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">Orders awaiting processing</small>
                <a href="<?php echo URLROOT; ?>/vendors/activeOrders" class="fm-link">View Details <i
                        class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="fm-card fm-stat h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="fm-title">My Inventory</div>
                    <div class="fm-number"><?php echo $data['stats']['product_count']; ?></div>
                </div>

                <div class="text-end">
                    <div class="fm-icon fm-icon-soft text-info" style="background-color: rgba(59,130,246,0.08); color: #0369a1;">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="mt-2 text-muted small">Products listed</div>
                </div>
            </div>

            <div class="fm-card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">Manage your catalog</small>
                <a href="<?php echo URLROOT; ?>/vendors/products" class="fm-link">Manage Products <i
                        class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="fm-card fm-stat h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="fm-title">Monthly Earnings</div>
                    <div class="fm-number"><?php echo CURRENCY . ' ' . number_format($data['stats']['monthly_earnings'], 2); ?>
                    </div>
                </div>

                <div class="text-end">
                    <div class="fm-icon fm-icon-soft text-success"
                        style="background-color: rgba(16,185,129,0.08); color: #065f46;">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="mt-2 text-muted small">Net revenue</div>
                </div>
            </div>

            <div class="fm-card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">Earnings this month</small>
                <a href="<?php echo URLROOT; ?>/vendors/history" class="fm-link">View History <i
                        class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>

</div>

<div class="fm-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 fw-bold"><i class="fas fa-list-alt text-primary me-2"></i> Recent Orders Needing Attention</h5>
            <small class="text-muted">Most recent first</small>
        </div>

        <div class="table-responsive">
            <table class="table fm-table table-borderless align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col">Order #</th>
                        <th scope="col">Item</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['recentOrders'])) : ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">You have no pending orders right now. Good job!</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($data['recentOrders'] as $order) : ?>
                            <tr>
                                <td class="fw-bold">#<?php echo $order->order_id; ?></td>
                                <td><?php echo $order->product_name; ?> <span class="text-muted">(x<?php echo $order->quantity; ?>)</span>
                                </td>
                                <td><?php echo date('M d, g:i A', strtotime($order->order_date)); ?></td>
                                <td>
                                    <span class="status-pill 
                    <?php
                            // Preserve original status color mapping visually while keeping PHP logic intact
                            if (strtolower($order->vendor_status) === 'pending') {
                                echo 'bg-warning text-dark';
                            } elseif (strtolower($order->vendor_status) === 'processing') {
                                echo 'bg-info text-dark';
                            } elseif (strtolower($order->vendor_status) === 'completed') {
                                echo 'bg-success text-white';
                            } else {
                                echo 'bg-secondary text-white';
                            }
                    ?>
                    ">
                                        <?php echo strtoupper($order->vendor_status); ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="<?php echo URLROOT; ?>/vendors/activeOrders"
                                        class="btn btn-sm btn-outline-primary btn-process shadow-sm">
                                        <i class="fa fa-box me-1"></i> Process
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

<?php require APPROOT . '/views/includes/vendor_footer.php'; ?>