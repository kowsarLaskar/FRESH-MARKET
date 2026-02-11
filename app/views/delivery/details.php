<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details - Fresh Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>body { background-color: #f4f7f6; }</style>
</head>
<body>

<div class="d-flex">
    <?php if(file_exists(APPROOT . '/views/includes/delivery_sidebar.php')) require APPROOT . '/views/includes/delivery_sidebar.php'; ?>

    <div class="flex-grow-1 p-4" style="height: 100vh; overflow-y: auto;">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <div>
                <h3 class="fw-bold text-dark mb-0">Order Details #<?php echo $data['order']->order_id; ?></h3>
                <span class="badge bg-<?php echo ($data['order']->order_status == 'delivered') ? 'success' : (($data['order']->order_status == 'processing') ? 'warning text-dark' : 'primary'); ?> mt-2">
                    <?php echo strtoupper(str_replace('_', ' ', $data['order']->order_status)); ?>
                </span>
            </div>
            <a href="javascript:history.back()" class="btn btn-outline-secondary shadow-sm bg-white fw-bold"><i class="fas fa-arrow-left me-2"></i>Back</a>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white py-3 border-bottom"><h6 class="mb-0 fw-bold text-secondary"><i class="fas fa-shopping-bag me-2"></i>Package Contents</h6></div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <?php foreach($data['items'] as $item): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <div>
                                        <div class="fw-bold"><?php echo $item->name; ?></div>
                                        <small class="text-muted"><?php echo $item->unit_value . ' ' . $item->unit_type; ?> x <?php echo $item->quantity; ?></small>
                                    </div>
                                    <span class="fw-bold text-dark">₹<?php echo number_format($item->price * $item->quantity, 2); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between py-3">
                        <span class="fw-bold text-muted">Total Bill</span>
                        <span class="fw-bold fs-5 text-dark">₹<?php echo number_format($data['order']->total_amount, 2); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white py-3 border-bottom"><h6 class="mb-0 fw-bold text-secondary"><i class="fas fa-user me-2"></i>Customer Information</h6></div>
                    <div class="card-body">
                        <h5 class="fw-bold text-dark mb-1"><?php echo $data['order']->full_name; ?></h5>
                        <p class="mb-3"><a href="tel:<?php echo $data['order']->phone; ?>" class="text-decoration-none fw-bold"><i class="fas fa-phone-alt me-2"></i><?php echo $data['order']->phone; ?></a></p>
                        
                        <h6 class="text-muted small text-uppercase fw-bold mb-1">Delivery Address</h6>
                        <p class="text-dark bg-light p-3 rounded border"><i class="fas fa-map-marker-alt text-danger me-2"></i><?php echo nl2br($data['order']->delivery_address); ?></p>
                        
                        <h6 class="text-muted small text-uppercase fw-bold mb-1 mt-3">Payment Method</h6>
                        <?php if($data['order']->payment_mode == 'cod'): ?>
                            <div class="alert alert-danger py-2 fw-bold text-center border-danger border-2"><i class="fas fa-money-bill-wave me-2"></i>Collect Cash: ₹<?php echo $data['order']->total_amount; ?></div>
                        <?php else: ?>
                            <div class="alert alert-success py-2 fw-bold text-center border-success border-2"><i class="fas fa-check-circle me-2"></i>Paid Online</div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($data['order']->order_status == 'processing' && empty($data['order']->delivery_boy_id)): ?>
                    <form action="<?php echo URLROOT; ?>/delivery/accept/<?php echo $data['order']->order_id; ?>" method="post">
                        <button type="submit" class="btn btn-warning w-100 fw-bold py-3 shadow-sm fs-5"><i class="fas fa-hand-holding me-2"></i> ACCEPT THIS ORDER</button>
                    </form>
                <?php elseif(in_array($data['order']->order_status, ['processing', 'out_for_delivery']) && $data['order']->delivery_boy_id == $_SESSION['user_id']): ?>
                    <form action="<?php echo URLROOT; ?>/delivery/complete/<?php echo $data['order']->order_id; ?>" method="post" onsubmit="return confirm('Confirm delivery?');">
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-3 shadow-sm fs-5"><i class="fas fa-check-circle me-2"></i> MARK AS DELIVERED</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
</body>
</html>