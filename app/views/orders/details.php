<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Order #<?php echo $data['order']->order_id; ?></h2>
            <span class="text-muted">Placed on <?php echo date('F d, Y h:i A', strtotime($data['order']->order_date)); ?></span>
        </div>
        <div>
            <?php if($data['order']->order_status == 'delivered'): ?>
                <a href="<?php echo URLROOT; ?>/orders/invoice/<?php echo $data['order']->order_id; ?>" target="_blank" class="btn btn-dark me-2">
                    <i class="fas fa-print me-2"></i> Invoice
                </a>
            <?php endif; ?>
            
            <a href="<?php echo URLROOT; ?>/orders" class="btn btn-outline-secondary">Back to Orders</a>
        </div>
    </div>

    <?php if($data['order']->order_status == 'cancelled'): ?>
        <div class="alert alert-danger shadow-sm border-danger border-2 d-flex align-items-center mb-4">
            <i class="fas fa-exclamation-circle fa-2x me-3"></i>
            <div>
                <h5 class="fw-bold mb-1 text-danger">Delivery Cancelled</h5>
                <p class="mb-0 text-dark">
                    <strong>Reason:</strong> 
                    <?php echo !empty($data['order']->cancellation_reason) ? $data['order']->cancellation_reason : 'We apologize, but your order could not be completed.'; ?>
                </p>
                <small class="text-muted mt-1 d-block">If you have already paid online, your refund will be processed shortly.</small>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Items Ordered</h5>
                </div>
                <div class="card-body p-0">
                    <?php foreach($data['items'] as $item): ?>
                        <div class="d-flex align-items-center border-bottom p-3">
                            
                            <?php if(!empty($item->image)): ?>
                                <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $item->image; ?>" 
                                     alt="<?php echo $item->name; ?>" 
                                     class="rounded me-3" 
                                     width="70" height="70" style="object-fit:cover;">
                            <?php else: ?>
                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width:70px; height:70px;">
                                    <small class="text-muted">No Img</small>
                                </div>
                            <?php endif; ?>
                            
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1"><?php echo $item->name; ?></h6>
                                <div class="text-muted small">
                                    Unit: <?php echo $item->unit_value . ' ' . $item->unit_type; ?>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <div class="fw-bold">₹<?php echo number_format($item->price, 2); ?></div>
                                <div class="text-muted small">Qty: <?php echo $item->quantity; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Delivery & Payment</h5>
                </div>
                <div class="card-body">
                    <p class="mb-1 fw-bold text-success">Delivery Address</p>
                    <p class="text-muted small mb-3">
                        <?php echo nl2br($data['order']->delivery_address); ?>
                    </p>

                    <p class="mb-1 fw-bold text-success">Payment Method</p>
                    <p class="text-muted small mb-3">
                        <?php echo strtoupper($data['order']->payment_mode); ?> 
                        (<?php echo ucfirst($data['order']->payment_status); ?>)
                    </p>

                    <p class="mb-1 fw-bold text-success">Order Status</p>
                    <p class="mb-3">
                        <?php 
                            $statusClass = 'secondary';
                            if ($data['order']->order_status == 'delivered') $statusClass = 'success';
                            if ($data['order']->order_status == 'cancelled') $statusClass = 'danger';
                            if ($data['order']->order_status == 'processing' || $data['order']->order_status == 'out_for_delivery') $statusClass = 'primary';
                        ?>
                        <span class="badge bg-<?php echo $statusClass; ?>">
                            <?php echo ucfirst(str_replace('_', ' ', $data['order']->order_status)); ?>
                        </span>
                    </p>

                    <hr>
                    
                    <div class="d-flex justify-content-between fs-5 fw-bold">
                        <span>Grand Total</span>
                        <span class="text-success">₹<?php echo number_format($data['order']->total_amount, 2); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>