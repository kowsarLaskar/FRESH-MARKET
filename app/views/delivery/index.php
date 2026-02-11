<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Dashboard - Fresh Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .nav-pills .nav-link.active { background-color: #1F4D3C; font-weight: bold; border-color: #1F4D3C; }
        .nav-pills .nav-link { color: #495057; background: #fff; border: 1px solid #dee2e6; margin-right: 10px; border-radius: 8px;}
        .card-hover:hover { transform: translateY(-3px); transition: 0.2s ease-in-out; box-shadow: 0 .5rem 1rem rgba(0,0,0,.1)!important; }
        .card { border-radius: 12px; }
    </style>
</head>
<body>

<div class="d-flex">
    
    <?php if(file_exists(APPROOT . '/views/includes/delivery_sidebar.php')) {
        require APPROOT . '/views/includes/delivery_sidebar.php';
    } ?>

    <div class="flex-grow-1 p-4" style="height: 100vh; overflow-y: auto;">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="fw-bold text-dark mb-0"><i class="fas fa-route text-success me-2"></i>My Route</h2>
            <div>
                <a href="<?php echo URLROOT; ?>/delivery/history" class="btn btn-outline-secondary fw-bold bg-white shadow-sm me-2">
                    <i class="fas fa-history me-1"></i> Earnings & History
                </a>
                <span class="bg-white p-2 rounded shadow-sm border fw-bold text-success d-none d-sm-inline-block">
                    <i class="fas fa-calendar-day me-1"></i> <?php echo date('M d, Y'); ?>
                </span>
            </div>
        </div>

        <?php flash('delivery_msg'); ?>

        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-4" id="pills-new-tab" data-bs-toggle="pill" data-bs-target="#pills-new" type="button">
                    <i class="fas fa-satellite-dish me-2"></i> Open Pool 
                    <span class="badge bg-danger ms-2 rounded-pill"><?php echo count($data['open_orders']); ?></span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4" id="pills-active-tab" data-bs-toggle="pill" data-bs-target="#pills-active" type="button">
                    <i class="fas fa-motorcycle me-2"></i> Active Tasks
                    <span class="badge bg-success ms-2 rounded-pill"><?php echo count($data['my_orders']); ?></span>
                </button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            
            <div class="tab-pane fade show active" id="pills-new" role="tabpanel">
                <?php if(empty($data['open_orders'])): ?>
                    <div class="alert bg-white border shadow-sm text-center py-5 rounded-4 text-muted">
                        <i class="fas fa-mug-hot fa-3x mb-3 text-secondary opacity-50"></i>
                        <h5 class="fw-bold">No orders right now</h5>
                        <p class="mb-0">Relax! New deliveries will appear here when ready.</p>
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach($data['open_orders'] as $order): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm card-hover border-top border-4 border-warning">
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="badge bg-warning text-dark"><i class="fas fa-box me-1"></i> Ready for Pickup</span>
                                            <span class="fw-bold text-success">₹<?php echo number_format($order->total_amount, 2); ?></span>
                                        </div>
                                        <h5 class="fw-bold mb-1 text-dark">#<?php echo $order->order_id; ?></h5>
                                        <p class="text-secondary small mb-2"><i class="fas fa-user me-1"></i> <?php echo $order->full_name; ?></p>
                                        <p class="text-dark small mb-3 flex-grow-1"><i class="fas fa-map-marker-alt me-2 text-danger"></i><?php echo nl2br($order->delivery_address); ?></p>
                                        
                                        <div class="d-flex gap-2 mt-auto">
                                            <a href="<?php echo URLROOT; ?>/delivery/details/<?php echo $order->order_id; ?>" class="btn btn-light border flex-fill fw-bold text-secondary">Details</a>
                                            <form action="<?php echo URLROOT; ?>/delivery/accept/<?php echo $order->order_id; ?>" method="post" class="flex-fill">
                                                <button type="submit" class="btn btn-warning w-100 fw-bold shadow-sm">Accept</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="tab-pane fade" id="pills-active" role="tabpanel">
                <?php if(empty($data['my_orders'])): ?>
                    <div class="alert bg-white border shadow-sm text-center py-5 rounded-4 text-muted">
                        <i class="fas fa-check-double fa-3x mb-3 text-success opacity-50"></i>
                        <h5 class="fw-bold">All caught up!</h5>
                        <p class="mb-0">Grab a new order from the Open Pool to start earning.</p>
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach($data['my_orders'] as $order): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm card-hover border-top border-4 border-primary">
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="badge bg-primary"><i class="fas fa-biking me-1"></i> On The Way</span>
                                            <span class="fw-bold text-success">₹<?php echo number_format($order->total_amount, 2); ?></span>
                                        </div>
                                        
                                        <h5 class="fw-bold text-dark mb-1">#<?php echo $order->order_id; ?></h5>
                                        <p class="mb-2 d-flex justify-content-between align-items-center">
                                            <span class="small text-secondary fw-bold"><i class="fas fa-user me-1"></i> <?php echo $order->full_name; ?></span>
                                            <a href="tel:<?php echo $order->phone; ?>" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1"><i class="fas fa-phone me-1"></i>Call</a>
                                        </p>
                                        <p class="text-dark small mb-3 flex-grow-1"><i class="fas fa-map-marker-alt me-2 text-primary"></i><?php echo nl2br($order->delivery_address); ?></p>
                                        
                                        <div class="bg-light border rounded p-2 mb-3 text-center">
                                            <span class="small text-muted text-uppercase fw-bold d-block">To Collect:</span>
                                            <?php if($order->payment_mode == 'cod'): ?>
                                                <span class="h5 mb-0 text-danger fw-bold">₹<?php echo $order->total_amount; ?> <small>(CASH)</small></span>
                                            <?php else: ?>
                                                <span class="h6 mb-0 text-success fw-bold"><i class="fas fa-check-circle me-1"></i>Paid Online</span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="d-flex gap-2 mt-auto">
                                            <button type="button" class="btn btn-outline-danger flex-fill fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#cancelModal<?php echo $order->order_id; ?>">
                                                <i class="fas fa-times me-1"></i> Cancel
                                            </button>

                                            <form action="<?php echo URLROOT; ?>/delivery/complete/<?php echo $order->order_id; ?>" method="post" class="flex-fill" onsubmit="return confirm('Confirm delivery completion?');">
                                                <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm"><i class="fas fa-check me-1"></i> Delivered</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="cancelModal<?php echo $order->order_id; ?>" tabindex="-1" aria-labelledby="cancelModalLabel<?php echo $order->order_id; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        
                                        <div class="modal-header bg-danger text-white border-0">
                                            <h5 class="modal-title fw-bold" id="cancelModalLabel<?php echo $order->order_id; ?>"><i class="fas fa-exclamation-triangle me-2"></i> Cancel Order #<?php echo $order->order_id; ?></h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <form action="<?php echo URLROOT; ?>/delivery/cancel/<?php echo $order->order_id; ?>" method="post">
                                            <div class="modal-body bg-light p-4">
                                                <p class="text-muted small mb-3">Please specify why this delivery could not be completed. This will be visible to the Admin and the Customer.</p>
                                                
                                                <label class="form-label fw-bold text-dark">Reason for Cancellation:</label>
                                                <select name="cancel_reason" class="form-select border-danger shadow-sm" required>
                                                    <option value="" disabled selected>Select a reason...</option>
                                                    <option value="Customer not reachable / Switch off">Customer not reachable / Switch off</option>
                                                    <option value="Address incorrect / Unlocatable">Address incorrect / Unlocatable</option>
                                                    <option value="Customer refused to accept">Customer refused to accept</option>
                                                    <option value="Customer requested later delivery">Customer requested later delivery</option>
                                                    <option value="Order damaged during transit">Order damaged during transit</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            
                                            <div class="modal-footer border-0 bg-light p-3">
                                                <button type="button" class="btn btn-secondary fw-bold px-4" data-bs-dismiss="modal">Go Back</button>
                                                <button type="submit" class="btn btn-danger fw-bold px-4">Confirm Cancel</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>