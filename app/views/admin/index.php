<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Fresh Market Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════
           BASE
        ═══════════════════════════════════════ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f4f5f7;
            color: #111827;
            margin: 0;
        }

        .main-content {
            margin-left: 260px;
            padding: 36px 40px;
            min-height: 100vh;
        }

        /* ═══════════════════════════════════════
           PAGE HEADER
        ═══════════════════════════════════════ */
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .page-header .page-title {
            font-size: 1.55rem;
            font-weight: 800;
            color: #0d1117;
            letter-spacing: -0.02em;
            line-height: 1;
        }

        .page-header .page-sub {
            font-size: 0.82rem;
            color: #6b7280;
            font-weight: 400;
            margin-top: 5px;
        }

        .page-header .header-date {
            font-size: 0.78rem;
            font-weight: 600;
            color: #9ca3af;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        /* ═══════════════════════════════════════
           STAT CARDS
        ═══════════════════════════════════════ */
        .stat-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 22px 24px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 4px 16px rgba(0, 0, 0, 0.04);
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.06), 0 12px 32px rgba(0, 0, 0, 0.08);
        }

        /* Decorative right-side accent stripe */
        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 3px;
            height: 100%;
            border-radius: 0 14px 14px 0;
        }

        .stat-card.accent-green::after {
            background: #4ade80;
        }

        .stat-card.accent-blue::after {
            background: #60a5fa;
        }

        .stat-card.accent-amber::after {
            background: #fbbf24;
        }

        .stat-card.accent-purple::after {
            background: #a78bfa;
        }

        .stat-card.accent-red::after {
            background: #f87171;
        }

        .stat-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .icon-green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .icon-blue {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .icon-amber {
            background: #fffbeb;
            color: #d97706;
        }

        .icon-purple {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .icon-red {
            background: #fef2f2;
            color: #dc2626;
        }

        .stat-trend {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 20px;
            background: #f0fdf4;
            color: #16a34a;
        }

        .stat-value {
            font-size: 1.9rem;
            font-weight: 800;
            color: #0d1117;
            letter-spacing: -0.03em;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.775rem;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.07em;
        }

        /* ═══════════════════════════════════════
           CONTENT CARDS (Tables etc.)
        ═══════════════════════════════════════ */
        .content-card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 4px 16px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .content-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
        }

        .content-card-title {
            font-size: 0.92rem;
            font-weight: 700;
            color: #111827;
            letter-spacing: -0.01em;
        }

        .btn-view-all {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            color: #6b7280;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 5px 12px;
            background: transparent;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .btn-view-all:hover {
            background: #f9fafb;
            color: #111827;
            border-color: #d1d5db;
        }

        /* ═══════════════════════════════════════
           TABLE
        ═══════════════════════════════════════ */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table thead th {
            font-size: 0.7rem;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 10px 24px;
            background: #f9fafb;
            border-bottom: 1px solid #f3f4f6;
            white-space: nowrap;
        }

        .orders-table tbody tr {
            border-bottom: 1px solid #f9fafb;
            transition: background 0.12s ease;
        }

        .orders-table tbody tr:last-child {
            border-bottom: none;
        }

        .orders-table tbody tr:hover {
            background: #fafafa;
        }

        .orders-table td {
            padding: 14px 24px;
            font-size: 0.84rem;
            color: #374151;
            vertical-align: middle;
        }

        .order-id {
            font-weight: 700;
            color: #111827;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.82rem;
        }

        .customer-name {
            font-weight: 500;
            color: #374151;
        }

        .order-amount {
            font-weight: 700;
            color: #111827;
            font-variant-numeric: tabular-nums;
        }

        /* Status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.02em;
        }

        .status-badge::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
            flex-shrink: 0;
        }

        .status-delivered {
            background: #f0fdf4;
            color: #15803d;
        }

        .status-pending {
            background: #fffbeb;
            color: #b45309;
        }

        .status-cancelled {
            background: #fef2f2;
            color: #b91c1c;
        }

        .status-out_for_delivery {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .status-processing {
            background: #f5f3ff;
            color: #6d28d9;
        }

        .status-default {
            background: #f3f4f6;
            color: #6b7280;
        }

        .btn-action {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: white;
            color: #6b7280;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .btn-action:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #111827;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        /* ═══════════════════════════════════════
           INVENTORY ALERT LIST
        ═══════════════════════════════════════ */
        .stock-list {
            padding: 0 24px;
        }

        .stock-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .stock-item:last-child {
            border-bottom: none;
        }

        .stock-name {
            font-size: 0.84rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
        }

        .stock-qty {
            font-size: 0.72rem;
            font-weight: 500;
            color: #ef4444;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stock-qty::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #ef4444;
            display: inline-block;
        }

        .btn-restock {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.72rem;
            font-weight: 600;
            color: #dc2626;
            border: 1px solid #fecaca;
            border-radius: 7px;
            padding: 4px 11px;
            background: #fef2f2;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.15s ease;
            flex-shrink: 0;
        }

        .btn-restock:hover {
            background: #fee2e2;
            border-color: #fca5a5;
            color: #b91c1c;
        }

        /* Stock-healthy empty state */
        .stock-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 36px 24px;
            text-align: center;
        }

        .stock-empty .check-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #f0fdf4;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #16a34a;
            margin-bottom: 12px;
        }

        .stock-empty p {
            font-size: 0.82rem;
            color: #9ca3af;
            font-weight: 500;
            margin: 0;
        }

        /* No orders state */
        .empty-row td {
            text-align: center;
            padding: 40px;
            font-size: 0.84rem;
            color: #9ca3af;
            font-weight: 500;
        }

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <?php require APPROOT . '/views/includes/admin_sidebar.php'; ?>

    <div class="main-content">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <div class="page-title">Overview</div>
                <div class="page-sub">Welcome back — here's what's happening today.</div>
            </div>
            <div class="header-date">
                <?php echo date('D, d M Y'); ?>
            </div>
        </div>

        <!-- ── STAT CARDS ── -->
        <div class="row g-3 mb-4">

            <div class="col-sm-6 col-xl">
                <div class="stat-card accent-green">
                    <div class="stat-card-top">
                        <div class="stat-icon icon-green"><i class="fas fa-rupee-sign"></i></div>
                        <span class="stat-trend"><i class="fas fa-arrow-up me-1"></i>Live</span>
                    </div>
                    <div class="stat-value">₹<?php echo number_format($data['revenue'], 2); ?></div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>

            <div class="col-sm-6 col-xl">
                <div class="stat-card accent-blue">
                    <div class="stat-card-top">
                        <div class="stat-icon icon-blue"><i class="fas fa-shopping-bag"></i></div>
                    </div>
                    <div class="stat-value"><?php echo $data['total_orders']; ?></div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>

            <div class="col-sm-6 col-xl">
                <div class="stat-card accent-amber">
                    <div class="stat-card-top">
                        <div class="stat-icon icon-amber"><i class="fas fa-user-friends"></i></div>
                    </div>
                    <div class="stat-value"><?php echo $data['total_users']; ?></div>
                    <div class="stat-label">Active Customers</div>
                </div>
            </div>

            <div class="col-sm-6 col-xl">
                <div class="stat-card accent-purple">
                    <div class="stat-card-top">
                        <div class="stat-icon icon-purple"><i class="fas fa-motorcycle"></i></div>
                    </div>
                    <div class="stat-value"><?php echo isset($data['delivery_boys_count']) ? $data['delivery_boys_count'] : 0; ?>
                    </div>
                    <div class="stat-label">Delivery Staff</div>
                </div>
            </div>

            <div class="col-sm-6 col-xl">
                <div class="stat-card accent-red">
                    <div class="stat-card-top">
                        <div class="stat-icon icon-red"><i class="fas fa-exclamation-triangle"></i></div>
                    </div>
                    <div class="stat-value"><?php echo count($data['low_stock']); ?></div>
                    <div class="stat-label">Low Stock Items</div>
                </div>
            </div>

        </div>

        <!-- ── BOTTOM ROW ── -->
        <div class="row g-3">

            <!-- Recent Orders Table -->
            <div class="col-lg-8">
                <div class="content-card">
                    <div class="content-card-header">
                        <span class="content-card-title">Recent Orders</span>
                        <a href="<?php echo URLROOT; ?>/adminOrders" class="btn-view-all">View all &rarr;</a>
                    </div>

                    <div class="table-responsive">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($data['recent_orders'])): ?>
                                    <tr class="empty-row">
                                        <td colspan="5">No orders found</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($data['recent_orders'] as $order): ?>
                                        <tr>
                                            <td><span class="order-id">#<?php echo $order->order_id; ?></span></td>
                                            <td><span class="customer-name"><?php echo $order->full_name; ?></span></td>
                                            <td><span class="order-amount">₹<?php echo number_format($order->total_amount, 2); ?></span></td>
                                            <td>
                                                <?php
                                                $statusText = $order->order_status;
                                                $statusCssMap = [
                                                    'delivered'        => 'status-delivered',
                                                    'pending'          => 'status-pending',
                                                    'cancelled'        => 'status-cancelled',
                                                    'out_for_delivery' => 'status-out_for_delivery',
                                                    'processing'       => 'status-processing',
                                                ];
                                                $statusClass = $statusCssMap[$statusText] ?? 'status-default';
                                                ?>
                                                <span class="status-badge <?php echo $statusClass; ?>">
                                                    <?php echo ucfirst(str_replace('_', ' ', $statusText)); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?php echo URLROOT; ?>/adminOrders/show/<?php echo $order->order_id; ?>" class="btn-action"
                                                    title="View Order">
                                                    <i class="fas fa-eye"></i>
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

            <!-- Inventory Alerts -->
            <div class="col-lg-4">
                <div class="content-card h-100">
                    <div class="content-card-header">
                        <span class="content-card-title">Inventory Alerts</span>
                        <?php if (!empty($data['low_stock'])): ?>
                            <span class="status-badge status-cancelled"><?php echo count($data['low_stock']); ?> items</span>
                        <?php endif; ?>
                    </div>

                    <?php if (empty($data['low_stock'])): ?>
                        <div class="stock-empty">
                            <div class="check-circle"><i class="fas fa-check"></i></div>
                            <p>All stock levels are healthy!</p>
                        </div>
                    <?php else: ?>
                        <div class="stock-list">
                            <?php foreach ($data['low_stock'] as $item): ?>
                                <div class="stock-item">
                                    <div>
                                        <div class="stock-name"><?php echo $item->name; ?></div>
                                        <div class="stock-qty">Only <?php echo $item->stock_qty; ?> left</div>
                                    </div>
                                    <a href="<?php echo URLROOT; ?>/products/edit/<?php echo $item->product_id; ?>"
                                        class="btn-restock ms-3">Restock</a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div><!-- /main-content -->

</body>

</html>