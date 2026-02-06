<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="container my-5">
    <h2 class="fw-bold mb-4">My Orders</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 ps-4">Order ID</th>
                            <th class="py-3">Date</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Total Amount</th>
                            <th class="py-3 text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['orders'])): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted mb-3">You haven't placed any orders yet.</div>
                                    <a href="<?php echo URLROOT; ?>" class="btn btn-success">Start Shopping</a>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['orders'] as $order): ?>
                                <tr>
                                    <td class="ps-4 fw-bold">#<?php echo $order->order_id; ?></td>
                                    <td><?php echo date('M d, Y', strtotime($order->order_date)); ?></td>
                                    <td>
                                        <?php 
                                            // Badge Logic for different statuses
                                            $badges = [
                                                'pending' => 'bg-warning text-dark',
                                                'processing' => 'bg-info text-dark',
                                                'out_for_delivery' => 'bg-primary',
                                                'delivered' => 'bg-success',
                                                'cancelled' => 'bg-danger'
                                            ];
                                            $badgeClass = $badges[$order->order_status] ?? 'bg-secondary';
                                        ?>
                                        <span class="badge <?php echo $badgeClass; ?> rounded-pill px-3">
                                            <?php echo ucfirst(str_replace('_', ' ', $order->order_status)); ?>
                                        </span>
                                    </td>
                                    <td class="fw-bold">₹<?php echo number_format($order->total_amount, 2); ?></td>
                                    <td class="text-end pe-4">
                                        <a href="<?php echo URLROOT; ?>/orders/show/<?php echo $order->order_id; ?>" class="btn btn-sm btn-outline-success">
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
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>