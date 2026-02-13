<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order #<?php echo $data['order']->order_id; ?> - Fresh Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* --- 1. SIDEBAR STYLES (Added these to fix the look) --- */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1F4D3C; /* Dark Green */
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding-top: 20px;
            z-index: 1000;
        }
        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 15px 25px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
        }
        .nav-link i { width: 25px; }

        /* --- 2. LAYOUT & SCROLLING --- */
        body { 
            background-color: #FBF9F1; 
            height: 100vh; 
            overflow: hidden; /* Prevent full page scroll */
        }

        /* Wrap main content to push it right of the fixed sidebar */
        .content-wrapper {
            margin-left: 250px; /* Same width as sidebar */
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .main-grid-wrapper {
            flex-grow: 1;
            overflow: hidden; 
            margin-top: 10px;
        }

        .h-100-container {
            height: 100%;
        }

        /* Scrollable Items Table */
        .items-card-body {
            height: calc(100vh - 350px); 
            overflow-y: auto;
            scrollbar-width: thin; 
        }
        
        .items-card-body::-webkit-scrollbar { width: 8px; }
        .items-card-body::-webkit-scrollbar-track { background: #f1f1f1; }
        .items-card-body::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
    </style>
</head>
<body>

<?php require APPROOT . '/views/includes/admin_sidebar.php'; ?>

<div class="content-wrapper">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-shrink-0">
    <div>
        <h3 class="fw-bold mb-0">Order #<?php echo $data['order']->order_id; ?></h3>
        <small class="text-muted">Placed on <?php echo date('M d, Y h:i A', strtotime($data['order']->order_date)); ?></small>
    </div>
    <div>
        <?php if($data['order']->order_status == 'delivered'): ?>
            <a href="<?php echo URLROOT; ?>/adminOrders/invoice/<?php echo $data['order']->order_id; ?>" target="_blank" class="btn btn-dark btn-sm me-2 shadow-sm">
                <i class="fas fa-print me-2"></i>Print Invoice
            </a>
        <?php endif; ?>
        
        <a href="<?php echo URLROOT; ?>/adminOrders" class="btn btn-outline-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>
</div>

    <?php if($data['order']->order_status == 'cancelled'): ?>
        <div class="alert alert-danger shadow-sm border-danger border-2 d-flex align-items-center mb-3 flex-shrink-0">
            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
            <div>
                <h6 class="fw-bold mb-1 text-danger">ORDER CANCELLED</h6>
                <p class="mb-0 small text-dark">
                    <strong>Reason:</strong> 
                    <?php echo !empty($data['order']->cancellation_reason) ? $data['order']->cancellation_reason : 'No reason provided by staff.'; ?>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <div class="container-fluid main-grid-wrapper">
        <div class="row h-100-container">
            
            <div class="col-md-8 d-flex flex-column h-100-container">
                
                <div class="card shadow-sm border-0 p-3 mb-3 flex-shrink-0">
                    <h6 class="border-bottom pb-2 mb-2 text-secondary fw-bold">
                        <i class="fas fa-user me-2"></i>Customer Details
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1 small"><strong>Name:</strong> <?php echo $data['order']->full_name; ?></p>
                            <p class="mb-1 small"><strong>Phone:</strong> <?php echo $data['order']->phone; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1 small"><strong>Address:</strong> <?php echo nl2br($data['order']->delivery_address); ?></p>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 flex-grow-1 overflow-hidden">
                    <div class="card-header bg-white py-2">
                        <h6 class="mb-0 text-secondary fw-bold"><i class="fas fa-shopping-basket me-2"></i>Items Ordered</h6>
                    </div>
                    
                    <div class="card-body p-0 items-card-body"> 
                        <?php if(isset($data['items']) && !empty($data['items'])): ?>
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th class="ps-3">Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th class="text-end pe-3">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data['items'] as $item): ?>
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <?php if(!empty($item->image)): ?>
                                                        <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $item->image; ?>" 
                                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;" class="me-2">
                                                    <?php endif; ?>
                                                    <div>
                                                        <div class="fw-bold small"><?php echo $item->name; ?></div>
                                                        <div class="text-muted" style="font-size: 0.75rem;"><?php echo $item->unit_value . ' ' . $item->unit_type; ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>₹<?php echo $item->price; ?></td>
                                            <td>x <?php echo $item->quantity; ?></td>
                                            <td class="text-end fw-bold pe-3">₹<?php echo number_format($item->price * $item->quantity, 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="p-4 text-center text-muted">No items found.</div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-light text-end">
                        <span class="fw-bold text-dark">Grand Total: </span>
                        <span class="fw-bold text-success fs-5">₹<?php echo number_format($data['order']->total_amount, 2); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                
                <div class="card shadow-sm border-0 p-3 mb-3 bg-white">
                    <h6 class="border-bottom pb-2 mb-3 text-primary fw-bold">
                        <i class="fas fa-motorcycle me-2"></i>Delivery Staff
                    </h6>
                    
                    <?php if($data['order']->order_status == 'delivered'): ?>
                        
                        <div class="alert alert-success py-3 mb-0 text-center">
                            <i class="fas fa-check-double fa-2x mb-2"></i>
                            <h6 class="fw-bold mb-1">Delivered Successfully</h6>
                            <small class="text-muted">Delivered by staff:</small>
                            <div class="fw-bold fs-5 mt-1">
                                <?php echo !empty($data['assigned_boy']->full_name) ? $data['assigned_boy']->full_name : 'Unknown'; ?>
                            </div>
                            <?php if(!empty($data['assigned_boy']->phone)): ?>
                                <small class="text-muted"><?php echo $data['assigned_boy']->phone; ?></small>
                            <?php endif; ?>
                        </div>
                        
                    <?php elseif($data['order']->order_status == 'cancelled' && !empty($data['assigned_boy'])): ?>
                        <div class="alert alert-danger py-2 d-flex align-items-center mb-2">
                            <i class="fas fa-times-circle fs-4 me-3"></i>
                            <div style="line-height: 1.2;">
                                <small class="text-uppercase text-muted" style="font-size: 0.7rem;">Cancelled By</small><br>
                                <strong><?php echo $data['assigned_boy']->full_name; ?></strong>
                            </div>
                        </div>

                    <?php else: ?>

                        <?php if(!empty($data['assigned_boy'])): ?>
                            <div class="alert alert-info py-2 d-flex align-items-center mb-2">
                                <i class="fas fa-check-circle fs-4 me-3"></i>
                                <div style="line-height: 1.2;">
                                    <small class="text-uppercase text-muted" style="font-size: 0.7rem;">Currently Assigned To</small><br>
                                    <strong><?php echo $data['assigned_boy']->full_name; ?></strong>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning py-2 small mb-2">
                                <i class="fas fa-exclamation-triangle me-2"></i>Not Assigned
                            </div>
                        <?php endif; ?>

                        <?php if($data['order']->order_status != 'cancelled'): ?>
                            <form action="<?php echo URLROOT; ?>/adminOrders/show/<?php echo $data['order']->order_id; ?>" method="post">
                                <label class="form-label small text-muted">Assign / Change Staff:</label>
                                <div class="input-group input-group-sm">
                                    <select name="delivery_boy_id" class="form-select" required>
                                        
                                        <option value="broadcast" class="fw-bold text-success" <?php echo empty($data['assigned_boy']) ? 'selected' : ''; ?>>
                                            &#128226; Broadcast to All (Open Pool)
                                        </option>
                                        
                                        <option disabled>----------------</option>
                                        
                                        <?php if(isset($data['delivery_boys'])): ?>
                                            <?php foreach($data['delivery_boys'] as $boy): ?>
                                                <option value="<?php echo $boy->user_id; ?>" 
                                                    <?php echo (isset($data['assigned_boy']->full_name) && $data['assigned_boy']->full_name == $boy->full_name) ? 'selected' : ''; ?>>
                                                    <?php echo $boy->full_name; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        
                                    </select>
                                    <button type="submit" class="btn btn-primary">Assign</button>
                                </div>
                            </form>
                        <?php endif; ?>

                    <?php endif; ?> 
                </div>

                <div class="card shadow-sm border-0 p-3">
                    <h6 class="border-bottom pb-2 mb-3 text-secondary fw-bold">
                        <i class="fas fa-tasks me-2"></i>Admin Actions
                    </h6>
                    
                    <form action="<?php echo URLROOT; ?>/adminOrders/show/<?php echo $data['order']->order_id; ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Set Status:</label>
                            <select name="order_status" class="form-select">
                                <?php $current = $data['order']->order_status; ?>

                                <option value="<?php echo $current; ?>" selected>
                                    <?php echo ucfirst(str_replace('_', ' ', $current)); ?> (Current)
                                </option>

                                <?php if ($current == 'pending'): ?>
                                    <option value="processing">Processing</option>
                                <?php endif; ?>
                                
                                <?php if ($current != 'delivered' && $current != 'cancelled'): ?>
                                    <option value="cancelled" class="text-danger fw-bold">Cancelled</option>
                                <?php endif; ?>
                            </select>
                            
                            <?php if ($current == 'processing'): ?>
                                <div class="form-text text-warning small mt-2">
                                    <i class="fas fa-info-circle"></i> Waiting for Delivery Boy to Pick Up.
                                </div>
                            <?php elseif ($current == 'out_for_delivery'): ?>
                                <div class="form-text text-info small mt-2">
                                    <i class="fas fa-shipping-fast"></i> Order is on the way.
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($current == 'pending' || $current == 'processing'): ?>
                            <button type="submit" class="btn btn-success w-100 fw-bold">Update Status</button>
                        <?php else: ?>
                            <button disabled class="btn btn-secondary w-100">Update Locked</button>
                        <?php endif; ?>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>

</body>
</html>